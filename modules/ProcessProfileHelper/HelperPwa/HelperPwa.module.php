<?php namespace ProcessWire;

class HelperPwa extends ProcessProfileHelper
{
    public static function getModuleInfo()
    {
        return [
            'title' => 'Helper PWA',
            'version' => 1,
            'author' => 'rafaoski',
            'autoload' => false,
            'icon'     => 'file-code-o',
            'requires' => ['ProcessProfileHelper']
        ];
    }

    public function init()
    {
    }
    
    public function loadServiceWorker($event) {

        if(_isAdmin()) return '';

        $value  = $event->return;
        $script = '<!-- Service Worker --><script>if ("serviceWorker" in navigator) { navigator.serviceWorker.register("/pwa_sw"); }</script>';
        $value = str_replace(["</head>","</body>",], ["<link rel='manifest' href='/pwa_manifest'></head>","$script</body>"], $value);
        $event->return = $value;
    }

    public function ready() {
        if(_isAdmin()) return '';

        // Get language prefix for multilingual support
        $prefix = _langPrefix(page());

        wire()->addHook("/{$prefix}pwa_manifest", $this , 'renderManifest');
        wire()->addHook("/{$prefix}pwa_sw", $this, 'renderServiceWorker');
        wire()->addHook("/{$prefix}pwa_offline", $this, 'renderOfflinePage');
        wire()->addHookAfter('Page::render', $this, 'loadServiceWorker');
    }

    public function _getResizedImage($img, $width = '512') {
        if (!$img instanceof PageImage || !$img->basename()) {
            return false;
        }           
        
        if (!in_array($img->ext, ['jpg', 'jpeg', 'png'])) {
            return false;
        }
    
        $options = [
            'quality' => 90,
        ];
        $img = $img->width($width, $options);
    
        return $img?->basename() ? $img : false;
    }
    
    public function _getIcons($img, $sizes = [192, 512]) {
        $icons = [];
        if ($img->ext === 'svg') {
            foreach ($sizes as $size) {
                $aspectRatio = $img->width / $img->height;
                $height = round($size / $aspectRatio);
                $icons[] = [
                    'src' => $img->url,
                    'sizes' => "{$size}x{$height}",
                    'type' => "image/svg+xml"
                ];
            }
        } else {
            foreach ($sizes as $size) {
                $resized = $this->_getResizedImage($img, $size);
                if ($resized) {
                    $icons[] = [
                        'src' => $resized->url, 
                        'sizes' => "{$resized->width}x{$resized->height}", 
                        'type' => "image/png"
                    ];
                }
            }
        }
        return $icons;
    }
    
    public function renderManifest(HookEvent $event) {
        $getIcon = _site()->logo;
        $icons = $this->_getIcons($getIcon);
    
        if (empty($icons)) return false;
    
        header('Content-Type: application/manifest+json');
        header('X-Robots-Tag: noindex, nofollow');
    
        $siteTitle = wire('pages')->get('/')->title;
        $shortName = substr($siteTitle, 0, 12); 
        $manifest = [
            "name" => $siteTitle,
            "short_name" => $shortName,
            "start_url" => "/",
            "display" => "standalone",
            "background_color" => "#ffffff",
            "theme_color" => "#333333",
            "icons" => $icons
        ];
    
        return json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function renderServiceWorker(HookEvent $event)
    {
        header('Content-Type: application/javascript');
        header('X-Robots-Tag: noindex, nofollow');
        header('Service-Worker-Allowed: /'); // Allows SW to run across the entire domain

        return <<<JS
            self.addEventListener("install", (event) => {
                event.waitUntil(
                    caches.open("pwa-cache").then((cache) => {
                        return cache.addAll(["/pwa_offline"]);
                    })
                );
            });
    
            self.addEventListener("fetch", (event) => {
                event.respondWith(
                    caches.match(event.request).then((response) => {
                        return response || fetch(event.request).catch(() => caches.match("/pwa_offline"));
                    })
                );
            });
        JS;
    }

    public function renderOfflinePage(HookEvent $event)
    {
        header('Content-Type: text/html; charset=UTF-8');

        $t_lang = _t('htmlLang');
        $t_offline = _t('sorryOffline');
        $t_contact = _t('contactUs');
        $t_email = _t('email');
        $t_phone = _('phone');

        $siteName = _site()->name;
        $email = _site()->email ?? 'contact@' . wire('config')->httpHost;
        $phone = _site()->phone;
        $logo = Html::img(_site()->logo->url,['lozad' => false,'width' => '50','class' => 'logo']);
       
        // social profiles
        $socialProfiles = _site()->socialProfiles();

        // copyright
        $copyright = _site()->copyright();

        $style = '';
        if(files()->exists(paths()->templates . 'assets/site.min.css')) {
            $style = files()->filegetContents(paths()->templates . 'assets/site.min.css');
        }

        // html
       return <<<HTML
            <!DOCTYPE html>
            <html lang="{$t_lang}">
                <head>
                    <meta charset="UTF-8">
                    <title>{$t_offline}</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="robots" content="noindex, nofollow">
                    <style>
                        {$style}
                    </style>
                </head>
                <body>
                    <header id='header' class='header'>
                        <p class='brand'>
                            <a  class='btn -xl'>
                                {$logo}
                                <span class='h3 site-name'>{$siteName}</span>
                            </a>
                        </p>
                    </header>

                    <main id='main' class='main mw-xl'>
                        <h3>{$t_offline}</h3>
                        <h4>{$t_contact}:</h4>
                        <p>{$t_email}: $email</p>
                        <p>{$t_phone}: $phone</p>
                    </main>
                    <footer id='footer' class='footer'>
                        <hr>
                        <div id='info-links' class='info-links'>
                            {$socialProfiles}
                        </div>
                        {$copyright}
                    </footer>
                </body>
            </html>
        HTML;
    }

    public function ___execute() {}

    public function ___install() {
        parent::___install();
    }

    public function ___uninstall() {
        parent::___uninstall();
    }

    public function getModuleConfigInputfields(InputfieldWrapper $inputfields) { 

    }
}

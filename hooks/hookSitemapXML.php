<?php namespace ProcessWire;

/**
 * Sitemap xml
 * @hook /{$prefix}sitemap.xml
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookSitemapXML(HookEvent $event) {
    // set header
    header('Content-type: application/xml');

    if(cache()->get('sitemapXml')) {
        // cache()->delete("sitemapXml");
        return cache()->get('sitemapXml');
    }

    // cache time
    $cahedTime = 86400; // 1day

    // find pages
    $items = pages()->find("template!=admin,has_parent!=2,status!=hidden");

    // return content
    $out = "<?xml version='1.0' encoding='UTF-8'?>\n";
    $out .= "<urlset xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";
    foreach ($items as $item) {

        if($item->viewable()) {

            $lastMod = date("Y-m-d", $item->modified);
            $out .= "<url>
            <loc>$item->httpUrl</loc>
            <lastmod>$lastMod</lastmod>\n";
            if($item->template == 'blog-post' || $item->template == 'blog' || $item->template == 'home') {
                $out .= "
                <changefreq>weekly</changefreq>
                <priority>1.0</priority>";
            } else {
                $out .= "
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>";
            }
            // if multi language site
            // if( languages() ) {
                //     foreach(languages() as $language) {
                    //         $url = $item->localHttpUrl($language);
                    //         $hreflang = pages()->get('/')->localName($language, 'name');
                    //         if($hreflang == 'home') {
                        //             $hreflang = setting('strLang');
                        //         }
                        //         $out .= "\t<xhtml:link rel='alternate' hreflang='$hreflang' href='$url'/>\n";
                        //     }
                        // }
                $out .= "</url>\n";

            }
        }

    $out .= "</urlset>";
    // https://processwire.com/api/ref/wire-cache/save/
    cache()->save("sitemapXml", $out, $cahedTime);
    // return all content if not cached
    return $out;
}

<?php namespace ProcessWire;

/**
 * Load assets
 */
class Assets {

    // set some basics
    // public function __construct(
    //     public string $helloWorld = '',
    // ) {
    //     $this->helloWorld = 'HelloWorld';
    // }

    /**
     * Load assets with optional settings.
     *
     * This function generates HTML markup for loading various types of assets such as scripts, stylesheets,
     * and fonts based on the provided array of links. It also supports optional settings for customization.
     *
     * @param array $links An associative array where keys represent the link names and values represent the link URLs.
     * @param array $opt Optional settings to customize the asset loading process.
     *                  - 'assetsFolder': The base folder for assets, defaults to the templates' 'assets/' folder.
     *
     * @return string Generated HTML markup for loading the specified links.
     */
    public function load($links, $opt = array()) {

        // if debug mode set prefix
        $ver = config()->debug ? '?ver='.time() : '';

        // nonce token for (CSP)
        $cspNonce = session()->get('cspNonce');

        $defaults = [
            'assetsFolder' => urls()->templates . 'assets/',
            'cspNonce' => $cspNonce ? true : false,
            'dataName' => false,
            'jsDefer' => true,
            'preload' => false,
        ];
        // Merge all with default Options
        $opt = array_merge($defaults, $opt);

        $allItems = '';

        foreach ($links as $link) {

            $preconnectFonts =
        <<<HTML
            <!-- Google Fonts Preconnect -->
            <link data-name='googleapis' rel="preconnect" href="https://fonts.googleapis.com">
            <link data-name='gstatic' rel="preconnect" href="https://fonts.gstatic.com" crossorigin>\n
        HTML;

            $preconnectFonts = $link && strpos($link, "googleapis") !== false ? $preconnectFonts : '';

            // set link for local files from assets folder
            if(strpos($link, 'http://') !== 0 && strpos($link, 'https://') !== 0) {

                // set assets folder
                $link = $opt['assetsFolder'].$link;

                // set file version time
                $pathDir = trim(pathinfo($link,PATHINFO_DIRNAME), '/');
                $filePath = config()->paths->root.$pathDir.DIRECTORY_SEPARATOR.pathinfo($link,PATHINFO_BASENAME);
                if( file_exists($filePath) ) {
                    $fileTime = filemtime($filePath);
                    if(!$ver) {
                        $ver = "?ver=$fileTime";
                    }
                }
            }

            $ext = pathinfo($link,PATHINFO_EXTENSION);
            $linkName = "<!-- "._baseName($link). " -->";

            // set nonce
            $nonce = ' ';
            if($opt['cspNonce']) {
                $nonce = " nonce='{$cspNonce}' ";
            }

            // set data name
            $dataName = '';
            if($opt['dataName']) {
                $dataName = pathinfo($link,PATHINFO_FILENAME);
                if (substr($dataName, 0, strlen('_')) == '_') {
                    $dataName = substr($dataName, strlen('_'));
                }
                $dataName = " data-name='{$dataName}' ";
            }

            $defer = $opt['jsDefer'] ? 'defer' : '';

            $js = "<script{$dataName}{$nonce}{$defer} src='{$link}{$ver}'></script>";
            $css = "<link{$dataName}{$nonce}rel='stylesheet' type='text/css' href='{$link}{$ver}' />";
            $font = "<link{$dataName}{$nonce}href='{$link}' rel='stylesheet'>";

            if ($opt['preload']) {
                // Preload dla JS
                $preloadJs = "<link rel='preload'{$nonce}as='script' href='{$link}{$ver}'>";
                $js = $preloadJs . "\n" . $js;

                // Preload dla CSS
                $preloadCss = "<link rel='preload'{$nonce}as='style' href='{$link}{$ver}' onload=\"this.rel='stylesheet'\">";
                $css = $preloadCss . "\n" . $css;

                // Preload dla Font
                $preloadFont = "<link rel='preload'{$nonce}as='font' href='{$link}' crossorigin='anonymous'>";
                $font = $preloadFont . "\n" . $font;
            }

            $link = match ($ext) {
                'js' => $js,
                'css' => $css,
                'localfont' => "<link {$dataName}{$nonce}rel='preload' href='{$link}{$ver}' crossorigin='anonymous' as='font' type='font/{$ext}'>",
                'font' => $font,
                default => '',
            };

            $allItems .= "{$preconnectFonts}\n{$linkName}\n$link\n";
        }

        return $allItems;
    }

    /**
     * Retrieves and combines content from multiple URLs into a single file (CSS or JS).
     *
     * This function fetches content from URLs or local file paths, combines them into one file,
     * and optionally minifies the output if specified.
     *
     * @param array $itemList List of item URLs or file paths to retrieve content from.
     * @param string $outputFile The name of the output file (CSS or JS).
     * @param array $opt Optional settings:
     *     - 'itemsPath' (string): The base path for local files (default: 'templates/assets/').
     *     - 'filePathCompiled' (string): The directory where the output file will be saved (default: 'templates/assets/').
     *     - 'dfOnce' (bool): If true, downloads and compiles files only once unless in debug mode (default: true).
     *     - 'minifyFile' (bool): If true, minifies the output file. In production, minifies only if the file doesn't exist (default: true).
     *
     * @return string The name of the output file if successful, or an error message on failure.
     */
    public function getFilesContent($itemList, $outputFile, $opt = array()) {
        $defaults = [
            'itemsPath' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR,
            'filePathCompiled' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR,
            'dfOnce' => config()->debug ? false : true,
            'minifyFile' => true,
        ];
        // Merge all with default Options
        $opt = array_merge($defaults, $opt);

        // set file path
        $filePath = $opt['filePathCompiled'] . $outputFile;

        // Get extension of file
        $ext = pathinfo($outputFile,PATHINFO_EXTENSION);

        if(!$ext) return '';

        // return minify css for production
        if(config()->debug == false && $opt['minifyFile'] == true) {

            $outputMinFileName = pathinfo($filePath,PATHINFO_FILENAME) . ".min.$ext";
            $checkFile = $opt['filePathCompiled'].$outputMinFileName;

            if(!files()->exists($checkFile)) {
                // minify files
                match ($ext) {
                    'css' => $this->minifyCSS($outputFile,['path' => $opt['filePathCompiled']]),
                    'js' => $this->minifyJS($outputFile,['path' => $opt['filePathCompiled']]),
                    default => null,
                };
            }

            if(files()->exists($checkFile)) {
                return $outputMinFileName;
            }
        }

        if (($opt['dfOnce'] == true) && files()->exists($filePath)) {
            // Output file already exists, return its name
            return $outputFile;
        }

        // Check if file path exists
        $path = pathinfo($filePath,PATHINFO_DIRNAME);

        if( !files()->exists($path, 'writable dir') ) {
            files()->mkdir($path);
        }

        try {
            $fileContentArray = [];

            foreach ($itemList as $itemUrl) {

                // check if is not a url
                if( strpos($itemUrl, 'http://') !== 0 && strpos($itemUrl, 'https://') !== 0 ) {

                    $itemUrl = $opt['itemsPath'].$itemUrl;

                    // find items in the folder
                    if(str_contains($itemUrl, '/*')) {
                        $folderWithFiles = str_replace('*','',$itemUrl);
                        $findItems = files()->find($folderWithFiles);

                        foreach ($findItems as $item) {
                            $fileContentArray[] = files()->fileGetContents($item);
                        }
                        // set empty item
                        $itemUrl = '';
                    }

                    if(!files()->exists($itemUrl)) {
                        $createdFilePath = pathinfo($itemUrl,PATHINFO_DIRNAME);
                        $createdFileName = pathinfo($itemUrl,PATHINFO_BASENAME);

                        $mkDir = files()->mkdir($createdFilePath,['recursive' => true]);

                        if($mkDir) {
                            files()->filePutContents($createdFilePath.DIRECTORY_SEPARATOR.$createdFileName, "");
                        }
                    }
                }

                if($itemUrl) {
                    $fileContentArray[] = files()->fileGetContents($itemUrl);
                }
            }

            // all content
            $combinedContent = implode("\n", $fileContentArray);

            // Save the combined files content to the specified output file
            files()->filePutContents($filePath, $combinedContent);

            // Minify files && overwrite for development
            if(config()->debug == true && $opt['minifyFile'] == true) {
                match ($ext) {
                    'css' => $this->minifyCSS($outputFile, [
                        'path' => $opt['filePathCompiled'],
                        'overwrite' => true,
                    ]),

                    'js' => $this->minifyJS($outputFile, [
                        'path' => $opt['filePathCompiled'],
                        'overwrite' => true,
                    ]),
                    default => null,
                };
            }

            // Return the name of the output CSS file
            return $outputFile;

        } catch (\Exception $e) {
            // Return an error message if an exception occurs
            return 'Error importing styles: ' . $e->getMessage() . "\n";
        }
    }

    /**
     * Minify CSS function
     *
     * Minifies the content of a CSS file by removing comments, extra spaces, and spaces around certain CSS symbols.
     *
     * @param string $cssFileName - The name of the CSS file to minify.
     * @param array $opt - An array of options:
     *   - 'path' (string): The base path where the CSS file is located. Default is 'paths()->templates . 'assets/'.
     *   - 'overwrite' (bool): If true, overwrites the original CSS file with the minified content. Default is false.
     *
     * @return string|int - Returns the minified CSS content as a string if successful, or an error message as a string if the file does not exist.
     */
    public function minifyCSS($cssFileName, $opt = array()) {
        // Set default attributes
        $default = [
            'path' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR,
            'overwrite' => false,
        ];
        // Merge options with default attributes
        $opt = array_merge($default, $opt);

        $filePath = $opt['path'].$cssFileName;
        if (!files()->exists($filePath)) {
            return "No file exists ( $filePath ) !!!";
        }

        // get file content
        $cssContent = files()->fileGetContents($filePath);

        // Remove comments
        $css = preg_replace('/\/\*.*?\*\//s', '', $cssContent);

        // Replace multiple spaces with a single space
        $css = preg_replace('/\s+/', ' ', $css);

        $cssFilePath = pathinfo($filePath, PATHINFO_FILENAME) . ".min.css";
        $cssFilePath = $opt['path'].$cssFilePath;

        // Write the minified content
        if ($opt['overwrite'] == true) {
            return files()->filePutContents($cssFilePath, $css);
        }

        // Write file if it doesn't already exist
        if (!files()->exists($cssFilePath)) {
            return files()->filePutContents($cssFilePath, $css);
        }
    }

    /**
     * Minify JS function
     *
     * Minifies the content of a JavaScript file by removing comments, extra spaces, and spaces around certain JS symbols.
     *
     * @param string $jsFileName - The name of the JS file to minify.
     * @param array $opt - An array of options:
     *   - 'path' (string): The base path where the JS file is located. Default is 'paths()->templates . 'assets/'.
     *   - 'overwrite' (bool): If true, overwrites the original JS file with the minified content. Default is false.
     *
     * @return string|int - Returns the minified JS content as a string if successful, or an error message as a string if the file does not exist.
     */
    public function minifyJS($jsFileName, $opt = array()) {

        // Set default attributes
        $default = [
            'path' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR,
            'overwrite' => false,
        ];
        // Merge options with default attributes
        $opt = array_merge($default, $opt);

        $filePath = $opt['path'].$jsFileName;
        if( !files()->exists($filePath) ) {
            return "No file exists ( $filePath ) !!!";
        }

        $jsContent = files()->fileGetContents($filePath);

        // Cleans up whitespace in JavaScript code.
        $js = preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $jsContent);

        $jsFilePath = $filePath;
        $jsFilePath = pathinfo($jsFilePath,PATHINFO_FILENAME) . ".min.js";
        $jsFilePath = $opt['path'].$jsFilePath;

        // Put contents if file exists
        if($opt['overwrite'] == true) {
            return files()->filePutContents($jsFilePath,$js);
        }

        // Put files
        if( !files()->exists($jsFilePath) ) {
            return files()->filePutContents($jsFilePath,$js);
        }
    }
}

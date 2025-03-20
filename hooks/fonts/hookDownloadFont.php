<?php namespace ProcessWire;

function hookDownloadFont(HookEvent $event) {

    // Download the WireHttp instance
    $http = new WireHttp();
    $url = './list-fonts';

    $strSetVariants = __('Set variants');
    $strSetSubsets = __('Set subsets');
    $strSavedZip = __("The ZIP file for the font with ID %s has been downloaded and saved in the 'assets' folder.");
    $strCleanZip = __("The ZIP file was extracted to the `%s` folder and was successfully deleted.");
    $strZipError = __("Error downloading ZIP file for font ID %s.");
    $strShow = __("Show saved Fonts.");

    if( $event->fontID ) {

        $fontID = $event->fontID;

        $variants = input()->get('variants');
        $subsets = input()->get('subsets');

        if($variants) {
            $variants = sanitizer()->text(implode(',',$variants));
        } else {
            return $strSetVariants;
        }

        if($subsets) {
            $subsets = sanitizer()->text(implode(',',$subsets));
        } else {
            return $strSetSubsets;
        }

        // Create a URL to download the font in ZIP format
        $downloadUrl = "https://gwfh.mranftl.com/api/fonts/$fontID?download=zip&subsets=$subsets&formats=woff2&variants=$variants";

        // Specify the local file path where you want to save the downloaded file
        $fontsPath = paths()->templates . "assets/fonts";
        $localFilePath = "$fontsPath/$fontID.zip";

        // Download the contents of the ZIP file and save locally
        $download = $http->download($downloadUrl, $localFilePath);

        // Check if the file has been successfully downloaded
        if ($download && files()->exists($localFilePath)) {
            $txt = sprintf($strSavedZip,$fontID) . '<br>';

            $unzip = files()->unzip($localFilePath, $fontsPath);

            if(count($unzip)) {
                // remove old file
                $rm = files()->unlink($localFilePath);
                if($rm) {
                    $txt .= sprintf($strCleanZip,$fontsPath);
                }
            }

            $messageContent =
            <<<HTML
                <div class="uk-alert-success" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p>$txt</p>
                    <a href='$url'>$strShow</a>
                </div>
            HTML;

        } else {

            $txt = sprintf($strZipError,$fontID);

            $messageContent =
            <<<HTML
                <div class="uk-alert-warning" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p>$txt</p>
                </div>
            HTML;

        }

        return $messageContent;
    }
}
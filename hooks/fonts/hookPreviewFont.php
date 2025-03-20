<?php namespace ProcessWire;

function hookPreviewFont(HookEvent $event) {

$strFamily = __('Font Family');
$strCategory = __('Category');
$strVariants = __('Variants');
$strSubsets = __('Subsets');
$strChooseVarinats = sprintf(__('Choose a %s'),$strVariants);
$strChooseSubsets = sprintf(__('Choose a %s'),$strSubsets);
$strPreview = __('Google Fonts Preview');
$strDownload = __('Download Font');
$fontID = $event->fontID;

    if ($fontID) {
        // Font URL
        $fontUrl = "https://gwfh.mranftl.com/api/fonts/$fontID";

        // Download the WireHttp instance
        $http = new WireHttp();

        // Send a GET request to get font options
        $response = $http->get($fontUrl);

        // Check if the query was successful
        if ($response !== false) {
            // Parse the JSON response
            $font = json_decode($response, true);
            $preview = (new Fonts)->preview($font['family']);
            $variants = array_column($font['variants'], 'id');
            $subsets = $font['subsets'];

            // Get information about variants and subsets
            $implVariants = sanitizer()->text(implode(', ', $variants));
            $implSubsets = sanitizer()->text(implode(', ', $subsets));

            $item =
            <<<HTML
                <ul>
                    <li>$strFamily: $font[family]</li>
                    <li>$strCategory: $font[category]</li>
                    <li>$strVariants: $implVariants</li>
                    <li>$strSubsets: $implSubsets</li>
                </ul>
            HTML;

            $optVariants = '';
            foreach ($variants as $variant) {
                if($variant == 'regular') {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
                $optVariants .= "<option value='$variant'{$selected}>$variant</option>\n";
            }

            $optSubsets = '';
            foreach ($subsets as $subset) {
                if($subset == 'latin' || $subset == 'latin-ext') {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }
                $optSubsets .= "<option value='$subset'{$selected}>$subset</option>\n";
            }

            // Create a form
            $form =
            <<<HTML
                <form
                    hx-get='./list-fonts/download-font/$font[id]'
                    hx-target='#hx-$font[id]'
                    hx-swap='innerHTML'
                >
                    <p>
                        <label class='uk-label'>$strChooseVarinats</label>
                        <select class='uk-select' name="variants[]" id="variants" multiple>
                            {$optVariants}
                        </select>
                    </p>
                    <p>
                        <label class='uk-label'>$strChooseSubsets</label>
                        <select class='uk-select' name="subsets[]" id="subsets" multiple>
                            {$optSubsets}
                        </select>
                    </p>

                    $preview

                    <a class='uk-margin' target='_blank' uk-icon="icon: link-external" href='https://fonts.google.com/?query=$font[family]'>$strPreview</a><br>

                    <button class='uk-button uk-button-primary' type='submit'>$strDownload</button>
                </form>
                <div id='hx-$font[id]'>-----------------------------</div><br><br>
            HTML;

            return $item . $form;
        }
    }
}

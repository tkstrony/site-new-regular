<?php namespace ProcessWire;

function hookListFonts(HookEvent $event) {

$strPreview = __('Preview Font.');
$strFoundFonts = __('Found %s Font/s');
$strBackList = __('Back To list fonts');
$strErrorList = __('Error retrieving font list.');
$strListSaved = __('List your saved fonts');
$strLabelSearch = __('Search fonts');
$strSearch = __('Search fonts');
$strSearchInfo = sprintf(__('Paste %s all %s to search for all fonts or something like %s Shojumaru,Montserrat Alternates %s to search for your preferred fonts.'),'<code>','</code>','<code>','</code>');
$strBack = __('Back To home');

 // Download the WireHttp instance
$http = new WireHttp();
$url = basename(input()->url());

$fontsHead = <<<HTML
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
HTML;
$fontsHead .= (new Fonts)->render();

// load style via htmx ( like lazy load )
if( $event->urlSegment ) {
    $urlSegment = $event->urlSegment;
    // Import css family stylesheet
    if($urlSegment == 'link') {
        $family = input()->get('family');
        return "@import url('https://fonts.googleapis.com/css2?family=$family&display=swap');";
    }
}

// If the form has been submitted
if (input()->post('search_query')) {

    // Download the inquiry from the form
    $searchQuery = input()->post('search_query','text,entities');

    // Create a URL to download the font list
    $fontsListUrl = 'https://gwfh.mranftl.com/api/fonts';

    // Send a GET request to get a list of fonts
    $response = $http->get($fontsListUrl);

    // Check if the query was successful
    if ($response !== false) {
        // Parse the JSON response
        $fontsList = json_decode($response, true);

        // Filter the font list based on the user's query
        if($searchQuery != 'all') {
            $filteredFonts = array_filter($fontsList, function ($font) use ($searchQuery) {
                // Divide the user's query into phrases
                $searchTerms = explode(',', $searchQuery);

                // Check if any phrase matches the 'family' field
                foreach ($searchTerms as $term) {
                    if (stripos($font['family'], trim($term)) !== false) {
                        return true;
                    }
                }

                return false;
            });
        } else {
            $filteredFonts = $fontsList;
        }

        // Variable to store the result
        $items = '';

        // View the list of filtered fonts
        foreach ($filteredFonts as $font) {
            $item =
            <<<HTML
                <h3 class='font-heading' style='font-family: $font[family]; font-size: xxx-large;'>
                    $font[family]
                </h3>
            HTML;

            $items .=
            <<<HTML
                <!-- https://htmx.org/examples/infinite-scroll/ -->
                <style id='fontStyle-$font[id]'></style>
                <div
                    class='uk-card uk-card-default uk-card-body uk-margin-bottom'
                    hx-get="{$url}/link?family=$font[family]"
                    hx-trigger="intersect once"
                    hx-target='#fontStyle-$font[id]'
                    hx-swap="innerHTML"
                >

                    {$item}

                    <button
                        hx-trigger="click once"
                        hx-get="{$url}/preview-font/$font[id]"
                        hx-target="this"
                        hx-swap="outerHTML"
                        class='uk-button uk-button-primary'
                    >
                        $strPreview
                    </button>

                </div>
            HTML;
        }

        $beforeContentFonts = Html::a("./$url",$strBackList,['class' => 'uk-button uk-button-primary uk-margin']);

        // Return the result
        return Html::content(Html::h3(sprintf($strFoundFonts,count($filteredFonts))) . $beforeContentFonts . $items, [
            'customHead' => $fontsHead,
            'uikit' => true
        ]);

    } else {
        return Html::p($strErrorList);
    }
}

    // View search form
    $content =
    <<<HTML
        <a class='uk-button uk-button-primary uk-margin-medium' href='./'>$strBack</a><br>
        <form
            hx-post=''
            hx-target='#main'
            hx-swap='outerHTML'
        >
            <p>
                <label class='uk-label' for="search_query">$strLabelSearch</label>
                <p>{$strSearchInfo}</p>
                <input class='uk-input uk-form-width-large' type="search" name="search_query" id="search_query" required>
            </p>

            <button class='uk-button uk-button-primary' type='submit'>$strSearch</button>
        </form><br>
    HTML;

    $content .= Html::h1($strListSaved,['class' => 'uk-heading-medium uk-heading-bullet uk-margin-medium']) . (new Fonts)->render([],['renderFonts' => true, 'canDeleted' => true]);
    return Html::content($content, ['customHead' => $fontsHead, 'uikit' => true]);
}

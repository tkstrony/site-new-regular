<?php namespace ProcessWire;

/**
* Name _contactForm
* @var string $id
* @var string $name
* @var string $class
* @var string $itemClassName
*/

if(_site()->disableContactForm == true) return '';
if(!_site()->email) return Html::p(_t('companyEmailWarning'),['class' => 'alert -warning']);

$tLegend = _t('formLegend');
$tSubmit = _t('submit');
$cssError = '';
$f_pdChecked = '';
$hxUrl = _setURL('_processForm');
$pageID = input()->get('pageID','int') ?: page()->id;

// render csrf
$csrfInput = "{CSRF_TOKEN}"; // Placeholder will be replaced by _renderCSRF() inside hookPageRender()

if(_isHxRequest()) {
    $csrfInput = _renderCSRF();
}

// labels
$l_formLegend = _t('formLegend');
$l_name = _t('name');
$l_email = _t('email');
$l_message = _t('message');
$l_submit = _t('submit');

// placeholders
$p_name = _t('placeholderName');
$p_email = _t('placeholderEmail');
$p_message = _t('placeholderMessage');
$p_pd = _t('personalDataAccept');
$p_submit = _t('placeholderSubmit');

// get personal data page
$personalData = _site()->personalDataPage;
$personalDataLink = _htmx([
    'modal' => true,
    'elType' => 'a',
    'href' => '#',
    'text' => _icon('link',['size' => 'sm']),
    'class' => 'btn -icon',
])->getPage($personalData->id, 'body');

// if errors
if( isset($errors) ) {
    $l_formLegend = $errors;
    $f_name = isset($f_name) ? $f_name : '';
    $f_email = isset($f_email) ? $f_email : '';
    $f_message = isset($f_message) ? $f_message : '';
    $f_pd = isset($f_pd) ? 'f_pd' : '';
    $f_pdChecked = $f_pd ? 'checked' : '';

    // set errors if visible placeholders ( not filled input )
    $cssError = <<<CSS
        :has(input:placeholder-shown, textarea:placeholder-shown) {
            --outline-color: var(--color-red);
            .outline {
                color: --outline-color;
            }
        }
        input:placeholder-shown, 
        textarea:placeholder-shown {
            border: var(--sp-5xs) dashed var(--color-red);
        }
    CSS;

} else {
    $f_name = $f_email = $f_message = $f_pd = '';
}

// content
echo <<<HTML
<form id='{$id}' class='{$class} mw-4xs' hx-swap='outerHTML' hx-post='{$hxUrl}'>
    <fieldset>
        <legend class='glowing-corners'>{$l_formLegend}</legend>

        {$csrfInput}

        <input type="hidden" name="page_id" value='{$pageID}'>

        <label class='required' for="f_name">{$l_name}</label>
        <input type="text" name="f_name" value='{$f_name}' placeholder='{$p_name}' id="f_name" class='item-{$f_name}' maxlength="130" required>

        <label class='required' for="f_email">{$l_email}</label>
        <input type="email" name="f_email" value='{$f_email}' placeholder='{$p_email}' id="f_email" class='item-{$f_email}' maxlength="130" required>

        <label class='required' for="f_pd">{$p_pd} {$personalDataLink} <br>
        <input type="checkbox" name="f_pd" id="f_pd" class='item-{$f_pd}' required {$f_pdChecked}></label>

        <label class='required' for="f_message">{$l_message}</label>
        <textarea name="f_message" placeholder='{$p_message}' id="f_message" class='item-{$f_message}' maxlength="1400" required>{$f_message}</textarea>

        <button class='submit' type='submit'>{$l_submit}</button>
    </fieldset>
</form>
HTML;

$style = <<<CSS
.{$itemClassName} {
    :has(input:placeholder-shown, textarea:placeholder-shown, input[type="checkbox"]:not(:checked)) {
        .submit {
            opacity: 0.6;
            pointer-events: none;
            user-select: none;
            cursor: not-allowed;
            position: relative;
            color: transparent;
            &::before {
                content: "🚫";
                position: absolute;
                color: red;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            &::after {
                content: "{$p_submit}";
                color: var(--color-warning);
                position: absolute;
                left: 99px;
                top: -5px;
                width: 200%;
                font-size: var(--fs-3xs);
                
            }
        }
    }
    
    {$cssError}
}
CSS;

// set region
echo _globalRegion($itemClassName, Html::styleTag($style));

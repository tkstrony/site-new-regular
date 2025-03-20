<?php namespace ProcessWire;

// Template file for pages using the “contact” template
?>

<div id="content-body" pw-append>
    <?= _pageBlocks(page()) ?>

    <div class='contact-wrap'>
        <?= _site()->contactInfo(); ?>

        <?php
            $contactForm = _partial('_contactForm');
            if(_isEnabledFilesBooster()) {
                $contactForm = _htmx([
                    'elType' => 'div',
                    'text' => '',
                    'class' => '',
                    'hx-trigger' => 'intersect once',
                    'hx-swap' => 'outerHTML',
                ])->getPartial('_contactForm');
            }
        ?>
        <?= $contactForm; ?>
    </div>

    <?= _partial('_companyMap'); ?>
</div>

<?php
// Set CSS for contact form
$css = !_site()->disableContactForm ? 
<<<CSS
    @media (min-width: 48rem) {
        columns: 2;
        column-width: auto;
        column-gap: var(--sp-5xl);
        column-rule: var(--sp-5xs) dashed var(--color-contrast-80);
        .contactInfo {
            break-inside: avoid;
            margin-top: 15%;
        }
        .partial_contactForm, .formMessages {
            break-inside: avoid;
        }
    }
CSS : '';

// Set CSS region style (#bottom-style) 
echo <<<HTML
    <style id='bottom-style' pw-append>
        .contact-wrap {
            align-content: center;
            margin-top: var(--sp-4xl);
            .partial_contactForm {
                margin-top: var(--sp-4xl);
            }
            {$css}
        }
    </style>
HTML;

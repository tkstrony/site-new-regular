<?php namespace ProcessWire;

/**
 * CookieConsent
 * @link https://cookieconsent.orestbida.com/
 * 
 * Basic usage:
 * echo (new CookieConsent)->render(); // render cookie consent config, styles, scripts
 * 
 */
class CookieConsent {

    /**
     * Constructor for the CookieConsent class.
     *
     * @param string $lang The language of the cookie consent messages.
     */
    public function __construct(
        public string $lang = '',
    ) {
        $this->lang = _t('htmlLang');
    }

    // render all content
    public function render() {
        return $this->btn() . $this->config() . $this->style();
    }

    /**
     * Render cookie button
     */
    public function btn() {
        $iconCookie = _icon('cookie');
        $btn = <<<HTML
            <button id='btnCookie' class='btnCookie btn -icon' type="button" aria-label="Cookie button" data-cc="show-preferencesModal">
                {$iconCookie}
            </button>
        HTML;

        // return button
        return $btn;
    }

    public function config() {
        // get lang
        $lang = $this->lang;

        // personal data page
        $personalData = _site()->personalDataPage;
        $personalDataLink = Html::a($personalData->url, $personalData->title);

        // contact page
        $contactPage = _site()->contactPage;
        $contactPageLink = Html::a($contactPage->url, $contactPage->title);

        // get strings
        $strAcceptAll = __('Accept all');
        $strRejectAll = __('Reject all');
        $strConsentModal = [
            'title' => __('We use cookies'),
            'description' => __('Cookies are necessary for the correct functionality of our website.'),
            'showPreferencesBtn' => __('Manage Individual preferences'),
        ];
        $strPreferencesModal = [
            'title' => __('Manage cookie preferences'),
            'savePreferencesBtn' => __('Accept current selection'),
            'closeIconLabel' => __('Close modal'),
        ];
        $strFirstSection = [
            'title' => __('Somebody said ... cookies?'),
            'description' => __('I want one!'),
        ];
        $strNecessarySection = [
            'title' => __('Strictly Necessary cookies'),
            'description' => __('These cookies are essential for the proper functioning of the website and cannot be disabled.'),
            // 'linkedCategory' => 'necessary',
        ];
        $strPerformanceSection = [
            'title' => __('Performance and Analytics'),
            'description' => __('These cookies collect information about how you use our website. All of the data is anonymized and cannot be used to identify you.'),
            // 'linkedCategory' => 'analytics',
        ];
        $strInformationSection = [
            'title' => __('More information'),
            'description' => __('For any queries about our cookie policy, your choices, or how we handle your personal data, please see our %s Policy or feel free to %s.'),
        ];
        $strInformationSectionDescription = sprintf($strInformationSection['description'], $personalDataLink, $contactPageLink);

        // get js file
        $cookieConsentJS = 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.umd.js';
        if(files()->exists(paths()->templates . 'assets/cookieconsent/cookieconsent.umd.js')) {
            $cookieConsentJS = '/site/templates/assets/cookieconsent/cookieconsent.umd.js';
        }

        /**
        * All config. options available here:
        * https://cookieconsent.orestbida.com/reference/configuration-reference.html
        */
        $config = <<<JS
            CookieConsent.run({
                guiOptions: {
                    consentModal: {
                        position: 'bottom left',
                    }
                },
                autoShow: true,
                categories: {
                    necessary: {
                        enabled: true,  // this category is enabled by default
                        readOnly: true  // this category cannot be disabled
                    },
                    analytics: {
                        enabled: true,
                    }
                },
                language: {
                    default: '{$lang}',
                    translations: {
                        {$lang}: {
                            consentModal: {
                                title: '{$strConsentModal['title']}',
                                description: '{$strConsentModal['description']}',
                                acceptAllBtn: '{$strAcceptAll}',
                                acceptNecessaryBtn: '{$strRejectAll}',
                                showPreferencesBtn: '{$strConsentModal['showPreferencesBtn']}'
                            },
                            preferencesModal: {
                                title: '{$strPreferencesModal['title']}',
                                acceptAllBtn: '{$strAcceptAll}',
                                acceptNecessaryBtn: '{$strRejectAll}',
                                savePreferencesBtn: '{$strPreferencesModal['savePreferencesBtn']}',
                                closeIconLabel: '{$strPreferencesModal['closeIconLabel']}',
                                sections: [
                                    {
                                        title: '{$strFirstSection['title']}',
                                        description: '{$strFirstSection['description']}'
                                    },
                                    {
                                        title: '{$strNecessarySection['title']}',
                                        description: '{$strNecessarySection['description']}',

                                        //this field will generate a toggle linked to the 'necessary' category
                                        linkedCategory: 'necessary'
                                    },
                                    {
                                        title: '{$strPerformanceSection['title']}',
                                        description: '{$strPerformanceSection['description']}',
                                        linkedCategory: 'analytics'
                                    },
                                    {
                                        title: '{$strInformationSection['title']}',
                                        description: '{$strInformationSectionDescription}'
                                    }
                                ]
                            }
                        }
                    }
                }
            });
        JS;

        // return all
        return Html::scriptTag(
            <<<JS
                import '{$cookieConsentJS}';
                $config

                window.addEventListener('load', () => {
                    toggleClassOnView('#cc-main', '#bottom-region', 'set-position');
                });
            JS
        ,['type' => 'module']);
    }

    public function style() {
        $cookieConsentStyle = 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.css';
        if(files()->exists(paths()->templates . 'assets/cookieconsent/cookieconsent.css')) {
            $cookieConsentStyle =  '/site/templates/assets/cookieconsent/cookieconsent.css';
        }
        $link =  Html::linkStylesheetTag($cookieConsentStyle);

        // set custom css
        $style = Html::styleTag(<<<CSS
            #cc-main {
                --cc-bg: var(--bg-color);
                --cc-text: var(--text-color);

                font-family: var(--font-primary) !important;
                font-size: var(--fs-sm) !important;
                z-index: 100 !important;

                * {
                    font-weight: normal !important;
                    letter-spacing: var(--sp-6xs) !important;
                }

                .cm--box {
                    border: var(--sp-4xs) solid !important;
                    padding: var(--sp-xs);
                    .cm__texts, .cm__title, .cm__desc, .cm__btns {
                        background-color: var(--cc-bg) !important;
                        color: var(--cc-text) !important;
                    }
                }
                .pm__header, .pm__body, .pm__section,
                .pm__section-title, .pm__footer, .section__toggle {
                    background-color: var(--cc-bg) !important;
                    color: var(--cc-text) !important;

                    .pm__section-desc {
                        color: var(--cc-text) !important;
                        a {
                            color: var(--link-color);
                        }
                    }

                    .pm__btn, .pm__btn-secondary {
                        background-color: var(--color-blue);
                        color: var(--color-white);
                        border: none;
                    }
                }

                .cm__btn {
                    background-color: var(--color-violet) !important;
                    color: var(--color-white) !important;
                }
                .cm__btn.cm__btn--secondary {
                    background-color: var(--color-blue) !important;
                    color: var(--color-white) !important;
                }

            }

            /* hide cookie button */
            .show--consent {
                .btnCookie {
                    display: none;
                }
            }

            @media (max-width: 72rem) {
                /* set custom position if footer is visible  */
                .show--consent {
                    #cc-main.set-position {
                        margin-top: var(--sp-3xl);
                        position: absolute;
                        .cc--anim .cm {
                            position: relative;
                        }
                    }
                }
            }
            .show--preferences #cc-main {
                z-index: 9999 !important;
            }

            .show--preferences .scroll-top {
                display: none !important;
            }
        CSS);

        return "$link \n $style";
    }
}

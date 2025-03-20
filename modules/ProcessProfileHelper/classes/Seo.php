<?php namespace ProcessWire;

/**
 * Seo class for managing SEO meta tags
 *
 * This class handles the generation of SEO meta tags, including Open Graph tags,
 * canonical links, and other essential meta tags for better search engine optimization
 * and social media sharing.
 */
class Seo {

    /**
     * Constructor for the Seo class
     *
     * Initializes the SEO properties based on site settings and page-specific data.
     * These properties include meta tags for Open Graph, canonical links, and other
     * essential elements used for SEO and social media optimization.
     *
     * @param bool $noindexFollow - Determines whether to add a 'noindex, follow' meta tag. Defaults to false.
     * @param string $siteName - The name of the website. Defaults to an empty string.
     * @param string $ogLocale - The locale used for Open Graph tags. Defaults to an empty string.
     * @param string $title - The title of the page for SEO. Defaults to an empty string or page title.
     * @param string $description - The meta description of the page. Defaults to an empty string or page description.
     * @param string $pageUrl - The canonical URL of the page. Defaults to an empty string or the current page URL.
     * @param string $ogType - The Open Graph type (e.g., 'website', 'article'). Defaults to 'website'.
     * @param ?PageImage $img - The image object for Open Graph tags. Defaults to null.
     * @param string $logo - The URL of the website's logo. Defaults to an empty string.
     */
    public function __construct(
        public bool $noindexFollow = false,
        public string $siteName = '',
        public string $ogLocale = '',
        public string $title = '',
        public string $description = '',
        public string $pageUrl = '',
        public string $ogType = 'website',
        public ?PageImage $img = null,
        public string $logo = ''
    ) {
        $this->noindexFollow = setting('noindexFollow') || input()->pageNum > 1 ? true : '';
        $this->siteName = _site()->name ?: $siteName;
        $this->ogLocale = _t('ogLocale') ?: $ogLocale;
        $this->title = page()->seo?->titleTag ?: page()->title;
        $this->description = page()->seo?->metaDescription ?: $description;
        $this->pageUrl = page()->httpUrl ?: '';
        $this->ogType = setting('ogType') ?: $ogType;
        $this->img = page()?->images?->count ? page()->images->first : $this->img;
        $this->logo = _site()->logo?->url ?: $logo;
    }

    /**
     * Generate SEO meta tags for a page.
     *
     * This function generates SEO meta tags, including Open Graph tags, canonical link,
     * and other essential meta tags for better search engine optimization and social media sharing.
     *
     * @param Page $item - The Page object for which to generate SEO meta tags.
     * @param array $opt - Default options
     * @link https://css-tricks.com/essential-meta-tags-social-media/
     * @link https://processwire.com/blog/posts/processwire-2.6.18-updates-pagination-and-seo/
     * @link https://weekly.pw/issue/222/
     * @return string - The HTML markup containing SEO meta tags.
     */
    public function render($item, $opt = []): string {

        if (!$item instanceof Page) return '';

        // Check if the current page is a 404 error or if the 'seo' field is missing
        if ($item->is('http404') || !$item->hasField('seo')) {
            return Html::title($item->title);
        }

        $defaults = [
            'canonicalEnabled' => true,      // Enable the canonical tag
            'canonicalForceHttps' => true,  // Enforce canonical HTTPS
            'canonicalRequireWww' => false, // Enforce canonical the absence of "www"
        ];
        $opt = array_merge($defaults, $opt);

        $ogTags = '';
        $bTags = '';
        $datePublished = date('c', $item->published);
        $dateModified = date('c', $item->modified);
        $space = "\t\t";

        // Handle canonical link generation
        if ($opt['canonicalEnabled']) {
            // By default, generate the canonical tag
            $bTags = "<link rel='canonical' href='{$this->pageUrl}'>\n";

            $isHttps = str_starts_with($this->pageUrl, 'https://');
            $hasWww = strpos(parse_url($this->pageUrl, PHP_URL_HOST), 'www.') === 0;

            // Check for HTTPS enforcement
            if ($opt['canonicalForceHttps'] && !$isHttps) {
                $bTags = ''; // Remove the tag if HTTPS is required but the URL is not secure
            }

            // Check for "www" enforcement
            if ($opt['canonicalRequireWww'] && !$hasWww) {
                $bTags = ''; // Remove the tag if "www" is required but missing
            }

            if (!$opt['canonicalRequireWww'] && $hasWww) {
                $bTags = ''; // Remove the tag if "www" is not allowed but present
            }
        }

        $bTags .= config()->pagerHeadTags ? "\t" . config()->pagerHeadTags . "\n" : '';
        $bTags .= $this->noindexFollow ? "\t" . Html::meta('robots', 'noindex,follow') . "\n" : null;
        $bTags .= $space . Html::title($this->title) . "\n";
        $bTags .= $this->description ? "\t" . Html::meta('description', $this->description) . "\n" : null;

        // Open Graph meta tags
        $og = [
            'og:site_name' => $this->siteName,
            'og:locale' => $this->ogLocale,
            'og:title' => $this->title,
            'og:description' => $this->description,
            'og:url' => $this->pageUrl,
            'og:type' => $this->ogType,
        ];

        if ($og['og:type'] == 'article') {
            $og['article:published_time'] = $datePublished;
            $og['article:modified_time'] = $dateModified;
            $og['article:updated_time'] = $dateModified;
        }

        // Set image for Open Graph
        if ($this->img) {
            $img = $this->img;
            $imgDescription = $img->description ?: $this->title;
            $og['og:image'] = $img->httpUrl;
            $og['og:image:type'] = "image/{$img->ext}";
            $og['og:image:width'] = $img->width;
            $og['og:image:height'] = $img->height;
            $og['og:image:alt'] = $imgDescription;
            $ogTags .= $space . Html::meta('twitter:card', 'summary_large_image') . "\n";
            $ogTags .= $space . Html::meta('twitter:image:alt', $imgDescription) . "\n";
        }

        $og = array_filter($og);

        foreach ($og as $key => $value) {
            $ogTags .= $space . Html::meta($key, $value, ['property' => true]) . "\n";
        }

        // Generate structured data (schema.org) for a page.
        $structuredData = $this->generateStructuredData($item);

        // Return all data
        return "<!-- Basic SEO -->\n{$space}{$bTags}{$ogTags}\n{$structuredData}";
    }


    /**
     * Generate structured data (schema.org) for a page.
     *
     * This function generates structured data for the page to enhance search engine understanding
     * and support rich snippets in search results.
     *
     * @param Page $item - The Page object for which to generate structured data.
     * @return string - The JSON-LD structured data script.
     */
    private function generateStructuredData(Page $item): string {
        $structuredData = [
            "@context" => "https://schema.org",
            "@type" => $this->ogType === 'article' ? "Article" : "WebPage",
            "url" => $this->pageUrl,
            "name" => $this->title,
            "description" => $this->description,
            "inLanguage" => $this->ogLocale,
            "image" => $this->img ? $this->img->httpUrl : null,
            "datePublished" => date('c', $item->published),
            "dateModified" => date('c', $item->modified),
        ];

        if ($this->ogType == 'article') {
            $structuredData["articleSection"] = 'Blog';
            $structuredData["author"] = $item->createdUser->txt_1 ?? $item->createdUser->name;
            $structuredData["publisher"] = [
                "@type" => "Organization",
                "name" => $this->siteName,
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => $this->logo,
                ]
            ];
        }

        $structuredData = array_filter($structuredData);

        return '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}

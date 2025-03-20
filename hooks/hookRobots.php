<?php namespace ProcessWire;

/**
 * Hook for dynamically generating the robots.txt file.
 * 
 * This hook ensures that a valid `robots.txt` file is served dynamically 
 * without the need for a static file. It sets appropriate headers and 
 * provides directives for web crawlers. The `Sitemap` directive points 
 * to the dynamically generated sitemap.
 * 
 * @hook /{$prefix}robots.txt
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

 function hookRobots(HookEvent $event) { 

    // set multilingual prefix
    $prefix = _langPrefix(page());

    // Set the content type to plain text (robots.txt format)
    header("Content-Type: text/plain");

    // Respond with HTTP 200 OK status
    http_response_code(200);

    // Generate the absolute URL for the sitemap.xml file
    $sitemapURL = _home()->httpUrl . "{$prefix}sitemap.xml";

    // Return the contents of robots.txt with basic directives
    return
    <<<TEXT
        User-agent: *
        Allow: /
        Sitemap: {$sitemapURL}
    TEXT;
}

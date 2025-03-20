<?php namespace ProcessWire;

/**
 * Custom hook to serve the site's favicon dynamically.
 *
 * This hook allows ProcessWire to serve different favicon formats (ICO, PNG, SVG, JPG) 
 * based on the requested file extension. If the requested favicon exists, 
 * it is served with the correct MIME type; otherwise, a 404 response is returned.
 *
 * @param HookEvent $event ProcessWire hook event object
 */

function hookFavicon(HookEvent $event) { 
    // Get the requested file extension from the URL
    $ext = $event->arguments('ext');

    // Retrieve the favicon file from the site settings
    $favicon = _site()->favicon;

    // Check if the stored favicon has the requested extension
    if ($favicon->ext === $ext) {
        // Define the correct MIME types for different favicon formats
        $mimeTypes = [
            'ico'  => 'image/x-icon',
            'png'  => 'image/png',
            'svg'  => 'image/svg+xml',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg'
        ];

        // Security header to prevent MIME type sniffing for SVG files
        if ($ext === 'svg') {

            /** @var FileValidatorSvgSanitizer $validator - SVG file validator. */
            $validator = modules()->get('FileValidatorSvgSanitizer');

            // Check if the file is a valid SVG.
            if (!$validator->isValidFile($favicon->filename)) {
                return sprintf(__('File is not a valid SVG / %s'), $favicon->filename);
            }

            header("X-Content-Type-Options: nosniff");
        }

        // Set the correct Content-Type header for the response
        header("Content-Type: " . ($mimeTypes[$ext] ?? 'application/octet-stream'));

        // Ensure the favicon is displayed in the browser instead of being downloaded
        header("Content-Disposition: inline; filename=favicon.{$ext}");

        // Check if the favicon file exists on the server and serve it
        if (file_exists($favicon->filename)) {
            readfile($favicon->filename);
        } else {
            // If the file does not exist, redirect to its URL (useful for remote storage)
            header("Location: {$favicon->url}", true, 301);
        }
        exit;
    }

    // If no matching favicon is found, return a 404 response
    http_response_code(404);
    return "The requested favicon was not found.";
}

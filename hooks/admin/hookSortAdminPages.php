<?php namespace ProcessWire;

 /**
 * This hook customizes the sorting of child pages in the ProcessWire admin for a specific parent page (blog).
 * It ensures that pages with the 'categories' template are listed first, followed by 'blog-post' pages.
 * Additionally, 'blog-post' pages are sorted by their publication date in descending order (newest first).
 * This applies specifically to the children of the blog page (ID 1047).
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookSortAdminPages(HookEvent $event) {

    // Get the object the event occurred on, if needed
	// $ProcessPageList = $event->object;

	// Get values of arguments sent to the hook
	$selectorString = $event->arguments(0); // The selector string that will be used for finding pages
	$page = $event->arguments(1);           // The parent page from which we are finding child pages

	// Check if the parent page is the blog page (ID 1047)
	if($page->id == 1047) {
		// Modify the selector string to sort by template and publication date
		// First, it selects pages with either the 'categories' or 'blog-post' template
		// Then, it sorts first by template (categories first, blog-post second)
		// After that, blog-post pages are sorted by the published date in descending order (newest to oldest)
		$selectorString .= ",template=categories|blog-post, sort=-template|-published";
	}

	// Update the modified selector string back into the arguments to be used for the query
	$event->arguments(0, $selectorString);
}

<?php namespace ProcessWire;

	/**
	 * Hook for processing like button clicks.
	 *
	 * This hook handles the logic for updating the like count of a page when the like button is clicked.
	 * It listens for a request on the custom URL pattern "/{$prefix}_likes/{pageID}", retrieves the page by ID,
	 * and increments the 'likes' field (which stores the like count) if the page uses an allowed template.
	 *
	 * Only pages with templates listed in the `$allowedTemplates` array will have their like counts processed.
	 * After updating the like count, the new value is saved and returned.
	 *
	 * @param HookEvent $event The ProcessWire hook event that provides the pageID.
	 * @return int The updated like count for the page.
	 */
	function hookLikes(HookEvent $event) {

		if(!$event->pageID) return '';
		$page = pages()->get($event->pageID);

		// Define which templates are allowed for the like feature
		$allowedTemplates = ['blog-post'];

		// Check if the page exists and has an allowed template
		if($page->id && in_array($page->template, $allowedTemplates)) {

			// return count likes
			if(input()->get('get_count_likes')) {
				return $page->likes;
			}

			// Increment the like count
			$likes = $page->likes ? $page->likes + 1 : 1;
			// Save the updated likes count to the 'likes' field and return the new value
			$page->setAndSave('likes', $likes);
			return $page->likes;
		}
	}
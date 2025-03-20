<?php namespace ProcessWire;

/** 
 * Hooks for admin area
 * 
 * @var ProcessWire $wire 
 */

// hide select_pages field from guest_notification field
wire()->addHookAfter('Page::render', null, 'hookGuestNotification');

// Set the publication status when the field date on the post page changes
wire()->addHookAfter("Pages::saved", null, 'hookPublicationStatus');

// Customize the sorting of child pages in the ProcessWire admin for a specific parent page (blog).
// $wire->addHookBefore('ProcessPageList::find', null, 'hookSortAdminPages');

//  Show related pages list on the home page
// wire()->addHookAfter("ProcessPageEdit::buildForm", null, 'hookAdminBuildForm');

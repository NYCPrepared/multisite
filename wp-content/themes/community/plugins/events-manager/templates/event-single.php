<?php
/* 
 * Remember that this file is only used if you have chosen to override event pages with formats in your event settings!
 * You can also override the single event page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
 * Your file would be named single-event.php
 */
/*
 * This page displays a single event, called during the the_content filter if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output() 
 */
global $EM_Event;
/* @var $EM_Event EM_Event */
echo $EM_Event->output_single(array(
	'format'=>'
	<section class="event-details">
		<div class="date-time">
			<span class="event-day">#l</span>
			<span class="event-date">#F #j, #Y</span>
			<span class="event-time">#g:#i#a - #@g:#@i#@a</span>
		</div>
		<div class="location">#_LOCATIONLINK</div>
		{has_location}<div class="tools"><a href="#_LOCATIONICALURL" class="add-to-calendar button">Add to Calendar</a></div>{/has_location}
	</section>
	{has_image}<section class="event-image">#_EVENTIMAGE</section>{/has_image}
	{has_location}<section class="event-map">#_MAP</section>{/has_location}
	<section class="event-description">#_EVENTNOTES</section>
	<footer class="event-footer">
		<div class="meta categories">#_EVENTCATEGORIES</div>
		<div class="share"></div>
	</footer>
	'
	));
?>
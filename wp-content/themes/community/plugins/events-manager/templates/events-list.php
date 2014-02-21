<?php
/*
 * Default Events List Template
 * This page displays a list of events, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output()
 * 
 */
$args = apply_filters('em_content_events_args', $args);

$args['format_header'] = '
<header class="event-list-header">
	<div class="event-list-date">Date</div>
	<div class="event-list-name">Name</div>
	<div class="event-list-description">Description</div>
</header>
';

$args['format'] = '
<article id="event-list" class="events">
	<header class="post-header event-header">
		<div class="meta">
			<div class="event-day">#l</div>
			<div class="event-date">#F #j</div>
			<div class="event-time">#g:#i#a</div>
		</div>
	</header>
	<section class="post-body event-content">
		<h3 class="post-title event-title">#_EVENTLINK</h3>
		<div class="event-location">{has_location}
		<p class="event-location-name">#_LOCATIONNAME</p>
		<p class="event-location-street">#_LOCATIONADDRESS</p>
		<p class="event-location-city">#_LOCATIONTOWN #_LOCATIONSTATE</p>
		{/has_location}</div>
		<div class="post-excerpt event-description">#_EVENTEXCERPT{25,...}</div>
		<div class="post-image event-image">{has_image}#_EVENTIMAGE{/has_image}</div>
	</section>
</article>
';

if( get_option('dbem_css_evlist') ) echo "<div class='css-events-list'>";

echo EM_Events::output( $args );

if( get_option('dbem_css_evlist') ) echo "</div>";

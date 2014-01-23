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

if( get_option('dbem_css_evlist') ) 
	echo "<div class='css-events-list events'>";
	print<<<_HTML_
	<table class="events events-table">
		<thead>
			<tr>
				<th>Date/Time</th>
				<th>Event Title</th>
				<th>Event Description</th>
			</tr>
		</thead>
		<tbody>
_HTML_;


$events = EM_Events::output(array( 
	'format'=>
			'<tr>
				<td>
				    <h6 class="event-start">
				        <time class="event-day" datetime="#l">#l</time>
				        <time class="event-date" datetime="#F #j">#F #j</time>
				        <time class="event-time" datetime="#g:#i#a">#g:#i#a</time>
					</h6>
				</td>
				<td>
					<h3 class="event-title post-title">#_EVENTLINK</h3>
					{has_location}
						<p class="location-name">#_LOCATIONNAME</p>
						<p class="location-address">#_LOCATIONADDRESS</p>
						<p class="location-city-state">#_LOCATIONTOWN #_LOCATIONSTATE</p>
					{/has_location}
				</td>
				<td>#_EVENTEXCERPT{20,...}</td>
			</tr>'
	));
echo $events;

// echo EM_Events::output( $args );

if( get_option('dbem_css_evlist') ) echo "</tbody></table></div>";

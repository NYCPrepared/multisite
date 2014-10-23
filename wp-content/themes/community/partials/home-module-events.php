<?php // Check to see if Events Manager is active. If not don't display this module.
if ( is_plugin_active('events-manager/events-manager.php') ) { ?>
<article id="events-module" class="module row events">
	<h2 class="module-heading"><a href="/events/">Events</a></h2>
	<ul class="events-list">
		<?php
		$events = EM_Events::output(array(
			'limit'=>7,
			'scope'=>'future',
			'format'=>'<li>
			<h6 class="event-start">
		        <time class="event-month" datetime="#M">#M</time>
		        <time class="event-date" datetime="#j">#j</time>
		        <time class="event-day" datetime="#D">#D</time>
			</h6>
			<h3 class="post-title event-title">#_EVENTLINK</h3>
			</li>'));?>
		<?php echo $events; ?>
		<li class="event-promo"><h3 class="promo-title"><a href="/events" title="Calendar">View all events</a></h3></li>
	</ul>
</article>
<?php } ?>

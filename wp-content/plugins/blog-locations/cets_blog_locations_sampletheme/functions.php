<?php 
/* ****************************************************************************************************************************
* Generate FYI Topics RSS feeds for browsers that support alternate feeds in the header
* ****************************************************************************************************************************
*/
function get_fyiTopicRSSforHead() {
// check to see if there's content in a topic. If so, create an alternate rss view for that topic
	if (function_exists('cets_get_used_topics')){
		$topics = cets_get_used_topics();
		if (sizeOf($topics) >= 1){
			foreach($topics as $topic) {
				echo('<link rel="alternate" type="application/rss+xml" title="' . $topic->slug . ' RSS Feed" href="/topic/' . strtolower($topic->slug) . '/feed" />');
			}
		  }	
		}
}

/* ****************************************************************************************************************************
 * Assign class names for the body tag of certain template pages.
 * ****************************************************************************************************************************
 */
function get_fyiBodyClass() {
	global $wp_query;
	// find out what page template is being called
	// and set class names to be displayed in the <body> tag
	
	if (isset($wp_query->query_vars['topic'])) {
		echo "topic twoCol";
	}	
	else if (isset($wp_query->query_vars['sitelist'])) {
		echo "sites oneCol";
	}
	else if (is_home()) {
		echo "home twoCol";
	}
}

function truncate ($str, $length=10, $trailing='...')
{
/*
** $str -String to truncate
** $length - length to truncate
** $trailing - the trailing character, default: "..."
*/
	
	  // strip tags so we don't blow up xhtml
	  $str = strip_tags($str);	
	  // take off chars for the trailing
	  $length-=strlen($trailing);
	  $length = checkForSpace($str, $length);
	  if (strlen($str)> $length)
	  {
		 // string exceeded length, truncate and add trailing dots
		 // find next space
		 
		 return substr($str,0,$length).$trailing;
	  }
	  else
	  {
		 // string was already short enough, return the string
		 $res = $str;
	  }
	  return $res;
}

function checkForSpace($str, $pos) {
	if (substr($str, $pos, 1) == ' '){
		return $pos;
	}
	else {
		if ($pos < strlen($str)){
			return checkForSpace($str, $pos + 1);
		}
		else {
			return $pos;
		}
		
	}
}

function add_image_page() {
add_theme_page('Custom Images',  'Custom Images',  'edit_themes', 'customimages', 'custom_image_utility');
}
add_action('admin_menu', 'add_image_page');

function custom_image_utility(){
// get the topics
global $cets_wpmubt;

$topics = $cets_wpmubt->get_topics();
foreach ($topics as $topic) {
?>
<h1>Custom Images</h1>
<div class="customimage_admin">
<h2>Images for <?php echo $topic->topic_name; ?> </h2>
<form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
Header: <input type="file" name="banner" size="50" /> <br />
Thumbnail: <input type="file" name="thumbnail" size="50" />
<input type="submit" name="upload" value="Upload" />
</form>
<hr />
</div>

<?php
	
	} // end foreach
	
} // end function





/* ****************************************************************************************************************************
 * Helper functions for Custom Images admin screens
 * ****************************************************************************************************************************
 */
 
function js_2() { ?>
<script type="text/javascript">
	function onEndCrop( coords, dimensions ) {
		$( 'x1' ).value = coords.x1;
		$( 'y1' ).value = coords.y1;
		$( 'x2' ).value = coords.x2;
		$( 'y2' ).value = coords.y2;
		$( 'width' ).value = dimensions.width;
		$( 'height' ).value = dimensions.height;
	}

	// with a supplied ratio
	Event.observe(
		window,
		'load',
		function() {
			var xinit = <?php echo HEADER_IMAGE_WIDTH; ?>;
			var yinit = <?php echo HEADER_IMAGE_HEIGHT; ?>;
			var ratio = xinit / yinit;
			var ximg = $('upload').width;
			var yimg = $('upload').height;
			if ( yimg < yinit || ximg < xinit ) {
				if ( ximg / yimg > ratio ) {
					yinit = yimg;
					xinit = yinit * ratio;
				} else {
					xinit = ximg;
					yinit = xinit / ratio;
				}
			}
			new Cropper.Img(
				'upload',
				{
					ratioDim: { x: xinit, y: yinit },
					displayOnInit: true,
					onEndCrop: onEndCrop
				}
			)
		}
	);
</script>
<?php
	}
	// walk through the steps of uploading and cropping
	function step() {
		$step = (int) @$_GET['step'];
		if ( $step < 1 || 3 < $step )
			$step = 1;
		return $step;
	}
	
	// figure out which js to include
	function js_includes() {
		$step = $this->step();
		if ( 2 == $step )	
			wp_enqueue_script('cropper');
	}
	
	// take appropriate actions based on user's input
	function take_action() {
		if ( isset( $_POST['textcolor'] ) ) {
			check_admin_referer('custom-header');
			if ( 'blank' == $_POST['textcolor'] ) {
				set_theme_mod('header_textcolor', 'blank');
			} else {
				$color = preg_replace('/[^0-9a-fA-F]/', '', $_POST['textcolor']);
				if ( strlen($color) == 6 || strlen($color) == 3 )
					set_theme_mod('header_textcolor', $color);
			}
		}
		if ( isset($_POST['resetheader']) ) {
			check_admin_referer('custom-header');
			remove_theme_mods();
		}
	}
	
	// include the appropriate js
	function js() {
		$step = $this->step();
		if ( 2 == $step )
			$this->js_2();
	}
	
	// This is the first page of the admin screen
	function step_1() {
		if ( $_GET['updated'] ) { ?>
		<div id="message" class="updated fade">
		<p><?php _e('Custom Image updated.') ?></p>
		</div>
				<?php } ?>
		
		<div class="wrap">
		<h2><?php _e('Topic Header Image'); ?></h2>
		<p><?php _e('This is your topic header image. You can upload and crop a new image.'); ?></p>
		
		<div id="headimg" style="background-image: url(<?php clean_url(header_image()) ?>);"></div>
		
		</div>
		<div class="wrap">
		<h2><?php _e('Upload New Topic Header Image'); ?></h2><p><?php _e('Here you can upload a custom topic header image to be shown at the top of your blog on the topic page. On the next screen you will be able to crop the image.'); ?></p>
		<p><?php printf(__('Images of exactly <strong>%1$d x %2$d pixels</strong> will be used as-is.'), TOPIC_HEADER_IMAGE_WIDTH, TOPIC_HEADER_IMAGE_HEIGHT); ?></p>
		
		<form enctype="multipart/form-data" id="uploadForm" method="POST" action="<?php echo attribute_escape(add_query_arg('step', 2)) ?>" style="margin: auto; width: 50%;">
		<label for="upload"><?php _e('Choose an image from your computer:'); ?></label><br /><input type="file" id="upload" name="import" />
		<input type="hidden" name="action" value="save" />
		<?php wp_nonce_field('custom-header') ?>
		<p class="submit">
		<input type="submit" value="<?php _e('Upload'); ?>" />
		</p>
		</form>
		
		</div>
		
				
		<?php 
		}


/* ***********************************************************
 * Register Sidebar widgets
 * ***********************************************************
 */

	if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Main Widgets',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	
	if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar Widgets',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));

/* ***********************************************************
 * Default Widgets
 * ***********************************************************
 */

register_sidebar_widget(__('Tag Cloud'), 'cets_tag_cloud', null, 'tagcloud');
unregister_widget_control('cets_tag_cloud');


//include the rewrites
include_once dirname(__FILE__) . '/rewrites.php';

?>
<?php
/**
 * RSS2 Feed Template for displaying RSS2 feed of topics.
 *
 * @package WordPress
 */

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
$more = 1;

?>
<?php echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom">
		
<?php if (sizeOf($posts) > 0) { ?>
<channel>
	<title>Latest Posts in the <?php echo $topic->topic_name ?> topic.</title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></pubDate>
	<?php the_generator( 'rss2' ); ?>
	<language><?php echo get_option('rss_language'); ?></language>

<?php
	
	foreach ($posts as $post) {
		$link = get_blog_permalink( $post->blogid, $post->id );
		$post->post_date = mysql2date('D, d M Y H:i:s +0000', $post->post_date, false);  // Format the date
		echo ("<item>");
		echo ("<title><![CDATA[" . $post->post_title . "]]></title>");
		echo ('<link>' . $link . '</link>');
		echo ('<description><![CDATA[' . strip_shortcodes($post->post_content) . ']]></description>');
		echo ("<pubDate>" . $post->post_date . "</pubDate>");
		echo ("<dc:creator></dc:creator>");
		echo ('<guid isPermaLink="false">' . $link .  ' </guid>');
		echo ("</item>");
	
		
	}

	}
?>


</channel>
</rss>

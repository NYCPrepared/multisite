<?php

/*
Plugin Name: Network Recent Posts
Plugin URI: http://glocal.coop
Description: Retrieves a list of the most recent posts in a WordPress Multisite installation.
Author: Pea
Author URI: http://glocal.coop
*/

/*
This plug includes almost no markup. It simply returns an array of posts, organized by post_date (DESC), that you can use in your template file. Here is a sample of what is returned:

[http://web.net/?p=553] => WP_Post Object
(
    [ID] => 553
    [post_author] => 50
    [post_date] => 2013-06-28 18:36:27
    [post_date_gmt] => 2013-06-28 18:36:27
    [post_content] => 
    [post_title] => The Good, The Bad, & The Ugly
    [post_excerpt] => 
    [post_status] => publish
    [comment_status] => open
    [ping_status] => open
    [post_password] => 
    [post_name] => the-good-the-bad-the-ugly-week-of-6242013
    [to_ping] => 
    [pinged] => 
    [post_modified] => 2013-06-28 18:36:27
    [post_modified_gmt] => 2013-06-28 18:36:27
    [post_content_filtered] => 
    [post_parent] => 0
    [guid] => http://web.net/?p=553
    [menu_order] => 0
    [post_type] => post
    [post_mime_type] => 
    [comment_count] => 0
    [filter] => raw
    [post_url] => http://web.net/2013/06/28/the-good-the-bad-the-ugly-week-of-6242013/
    [blog_id] => 4
    [post_thumbnail] =>  
    [post_categories] => Array
        (
            [advocacy-engagement] => Array
                (
                    [slug] => advocacy-engagement
                    [name] => Advocacy &amp; Engagement
                    [id] => 5
                    [url] => http://web.net/web/occuevolve/blog/category/advocacy-engagement/
                    [nice_link] => <a href="http://web.net/web/occuevolve/blog/category/advocacy-engagement/" title="Advocacy &amp; Engagement" class="category-advocacy-engagement" rel="tag">Advocacy &amp; Engagement</a>
                )
            [statements] => Array
                (
                    [slug] => statements
                    [name] => Statements
                    [id] => 59
                    [url] => http://web.net/web/occuevolve/blog/category/statements/
                    [nice_link] => <a href="http://web.net/web/occuevolve/blog/category/statements/" title="Statements" class="category-statements" rel="tag">Statements</a>
                )
        )
    [post_tags] => Array
        (
            [financial-literacy] => Array
                (
                    [slug] => financial-literacy
                    [name] => financial literacy
                    [url] => http://web.net/web/occuevolve/blog/tag/financial-literacy/
                    [nice_link] => <a href="http://web.occupy.net/web/occuevolve/blog/tag/financial-literacy/" title="financial literacy" class="tag-financial-literacy label success radius" rel="tag">financial literacy</a>
                )
        )
    [post_format] => aside 
)

Note: If the post format is set to standard, no value will be returned.

Sample call: $recent_posts = recent_network_posts(20, 3)  get a total of 20 posts, get 3 posts per blog

LIST OF PARAMETERS
* @numberposts             : Specifies total number of posts to display
* @postsperblog            : Specifies number of posts per blog to display
* @postcat                 : Specifies category to get posts from
* @excludepostcat          : Specifies category from which to exclude posts
* @imagesize               : Specifies image size to use for post thumbnail

*/


function recent_network_posts($numberposts = '25', $postsperblog = '3', $postcat = null, $excludepostcat = null, $imagesize ='thumbnail') { //Start Function

    global $wpdb;

    $blogs = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs WHERE blog_id != '1' AND
        public = '1' AND archived = '0' AND spam = '0' AND deleted = '0' 
        ORDER BY last_updated DESC");

    if( $blogs ) {
        // Count blogs found
        $count_blogs = count($blogs);
        // Dig into each blog

        foreach( $blogs as $blog_key ) {
            // Options: Site URL, Blog Name, Date Format
            ${'blog_url_'.$blog_key} = get_blog_option($blog_key,'siteurl');
            ${'blog_name_'.$blog_key} = get_blog_option($blog_key,'blogname');
            ${'date_format_'.$blog_key} = get_blog_option($blog_key,'date_format');

            // Switch to the blog
            switch_to_blog($blog_key);

            $cat_id = get_cat_ID($postcat);
            $exclude_cat_id = '-' . get_cat_ID($excludepostcat);

            if(isset($postcat) && isset($excludepostcat)) {
                $postargs = array(
                    'numberposts' => $postsperblog,
                    'category' => $cat_id . ',' . $exclude_cat_id,
                );
            } elseif (isset($postcat)) {
                $postargs = array(
                    'numberposts' => $postsperblog,
                    'category' => $cat_id,
                );
            } elseif (isset($excludepostcat)) {
                $postargs = array(
                    'numberposts' => $postsperblog,
                    'category' => $exclude_cat_id,
                );
            } else {
                $postargs = array(
                    'numberposts' => $postsperblog,
                );
            }
            
            // ${'posts_'.$blog_key} = get_posts('numberposts='.$postsperblog);
            ${'posts_'.$blog_key} = get_posts($postargs);

            // Check if posts with the defined criteria were found
            if( empty(${'posts_'.$blog_key}) ) {
                /* If no posts matching the criteria were found then
                 * move to the next blog
                 */
                next($blogs);
            }

            // Put everything inside an array for sorting purposes
            foreach( ${'posts_'.$blog_key} as $post ) {

                // Access all post data
                setup_postdata($post);


                $all_posts[$post->post_date] = $post;

                // The guid is the only value which can differenciate a post from
                // others in the whole network
                $all_permalinks[$post->guid] = get_blog_permalink($blog_key, $post->ID);
                $all_blogkeys[$post->guid] = $blog_key;

                $blog_url = get_blog_details($blog_key)->path;

                if(has_post_thumbnail($post->ID)) {
                    $all_thumbnails[$post->guid] = get_the_post_thumbnail($post->ID, $imagesize);
                } 
                else {
                    $all_thumbnails[$post->guid] = '';   
                }

                $post_metas = get_post_meta($post->ID);
                $all_meta[$post->guid] = array();
                foreach($post_metas as $metakey => $metavalue) {
                    $all_meta[$post->guid][$metakey] = $metakey;
                    foreach ($metavalue as $meta) {
                        $all_meta[$post->guid][$metakey] = $meta;
                    }
                }

                // Get categories for each post and put into $all_categories array
                $post_categories = wp_get_post_categories($post->ID);
                $all_categories[$post->guid] = array();
                foreach ($post_categories as $post_category) {
                    $cat = get_category($post_category);
                    $cat_id = get_cat_ID($cat->name);
                    $cat_link = get_category_link($cat_id);
                    $all_categories[$post->guid][$cat->slug]['slug'] = $cat->slug;
                    $all_categories[$post->guid][$cat->slug]['name'] = $cat->name;
                    $all_categories[$post->guid][$cat->slug]['id'] = $cat_id;
                    $all_categories[$post->guid][$cat->slug]['url'] = $cat_link;
                    $all_categories[$post->guid][$cat->slug]['nice_link'] = '<a href="' . $cat_link . '" title="' . $cat->name . '" class="category-' . $cat->slug . '" rel="tag">' . $cat->name . '</a>';
                }

                // Get tags for each post and put into $all_tags array
                $post_tags = wp_get_post_tags($post->ID);
                // $post_tags = get_the_tags($post->ID);
                $all_tags[$post->guid] = array();
                foreach ($post_tags as $post_tag) {
                    $tag_id = $post_tag->term_id;
                    $tag_link = get_tag_link($tag_id);
                    $all_tags[$post->guid][$post_tag->slug]['slug'] = $post_tag->slug;
                    $all_tags[$post->guid][$post_tag->slug]['name'] = $post_tag->name;
                    $all_tags[$post->guid][$post_tag->slug]['url'] = $tag_link;
                    $all_tags[$post->guid][$post_tag->slug]['nice_link'] = '<a href="' . $tag_link . '" title="' . $post_tag->name . '" class="tag-' . $post_tag->slug . ' label success radius" rel="tag">' . $post_tag->name . '</a>';
                }

                $meta = get_post_meta($post->ID, 'syndication_permalink', true);
                if($meta) {
                    $all_syndication_details[$post->guid] = $meta;
                } else {
                    $all_syndication_details[$post->guid] = '';
                }

                // $post_format = get_post_format($post->ID);
                $all_post_formats[$post->guid] = get_post_format($post->ID);

            }

        // Back the current blog
        restore_current_blog();

        }

        // Sort by date
        @krsort($all_posts);

    }
        
    // Count the number of posts
    $post_count = count($all_posts);

    // If the number of posts is less then the number of posts selected to display, change the limit to total number minus offset
    if($post_count < $numberposts) {
        $limit = $post_count;
    } else {
        $limit = $numberposts;
    }
    
    $i = 0;
    foreach ($all_posts as $wp_post) {
        if($i==$limit) break;

            $wp_post->post_url = $all_permalinks[$wp_post->guid];
            $wp_post->blog_id = $all_blogkeys[$wp_post->guid];
            $wp_post->post_thumbnail = $all_thumbnails[$wp_post->guid];
            $wp_post->post_categories = $all_categories[$wp_post->guid];
            $wp_post->post_tags = $all_tags[$wp_post->guid];
            $wp_post->post_format = $all_post_formats[$wp_post->guid];
            // $wp_post->syndication_link = $all_syndication_details[$wp_post->guid];
            $wp_post->meta = $all_meta[$wp_post->guid];
            $blog_posts[$wp_post->guid] = $wp_post;

        $i++;
    }
// Debuggin...
// echo '<pre>';print_r($blog_posts);echo '</pre>';
return $blog_posts;

} // End Function


// Accepted arguments: $count (default 5), $content, $permalink, $excerpt_trail (default 'Read More')
function recent_posts_excerpt($count = 55, $content, $permalink, $excerpt_trail = 'Read More'){
    $content = preg_replace("/\[(.*?)\]/i", '', $content);
    $content = strip_tags($content);
    // Get the words
    $words = explode(' ', $content, $count + 1);
    // Pop everything
    array_pop($words);
    // Add trailing dots
    // array_push($words, '...');
    // Add white spaces
    $content = implode(' ', $words);
    // Add the trail
    $content = $content.'<a href="'.$permalink.'" target="_blank" class="read-more">'.$excerpt_trail.'</a>';
    // Return the excerpt
    return $content;
}


?>
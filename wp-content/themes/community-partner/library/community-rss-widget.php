<?php
/*
Plugin Name: Community RSS Feed
Description: This plugin will display a customized RSS feed.
Version: 1
Author: Pea, Glocal
Author URI: http://glocal.coop
Text Domain: community-rss-widget
  
*/

/**
 * CommunityRSSWidget Class
 */
class CommunityRSSWidget extends WP_Widget {
    /** constructor */
    function CommunityRSSWidget() {
        parent::WP_Widget(false, $name = 'Community RSS Widget');  
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) { 	
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $url = $instance['url'];
        $number = $instance['numberposts'];
        if($number) {
            $numberposts = $number;
        } else {
            $numberposts = 10;
        }
        ?>

        <header class="page-header">
            <h2 class="page-title"><?php _e( $title, 'community-rss-widget' ); ?></h2>
        </header>

        <?php // Get RSS Feed(s)
        include_once( ABSPATH . WPINC . '/feed.php' );

        // Get a SimplePie feed object from the specified feed source.
        $rss = fetch_feed($url);

        if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
            // Figure out how many total items there are, but limit it to 5. 
            $maxitems = $rss->get_item_quantity( $numberposts ); 
            // Build an array of all the items, starting with element 0 (first element).
            $rss_items = $rss->get_items( 0, $maxitems );
        endif;
        ?>

        
        <?php echo $before_widget; ?>
            <?php if ( $maxitems == 0 ) : ?>
                <article id="partner-page" class="partner post news">
                    <?php _e( 'No items', 'community-rss-widget' ); ?>
                </article>
            <?php else : ?>
            <?php foreach ( $rss_items as $item ) : ?>

                <?php
                $content = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $item->get_content(), ENT_QUOTES, get_option('blog_charset') ) ) ) );
                $excerpt = wp_html_excerpt( $content, 320 );
                ?>

                <article class="partner post news">

                    <header class="post-header">
                        <div class="meta post-date"><?php echo date_i18n(get_option('date_format'),strtotime($item->get_date()));?></div>
                    </header>
                    <section class="post-body">
                        <h3 class="post-title"><a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                            title="<?php printf( __( 'Posted %s', 'community-rss-widget' ), $item->get_date('j F Y | g:i a') ); ?>">
                            <?php echo esc_html( $item->get_title() ); ?>
                        </a></h3>
                        <div class="post-excerpt"><?php echo $excerpt; ?> <a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">...</a></div>
                    </section>

                </article>

                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php echo $after_widget; ?>

        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) { 			
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {  			
        $title = esc_attr($instance['title']);
        $url = esc_url($instance['url']);
        $numberposts = esc_attr($instance['numberposts']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="url" value="<?php echo $url; ?>" required /></label></p>
            <p><label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of Posts:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" type="number" value="<?php echo $numberposts; ?>" required /></label></p>

    <?php 
    }

} // class CommunityRSSWidget
// register CommunityRSSWidget widget
add_action('widgets_init', create_function('', 'return register_widget("CommunityRSSWidget");'));

?>
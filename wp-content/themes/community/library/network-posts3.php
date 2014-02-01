<?php

function recent_mu_posts( $howMany = 20, $network = '' ) {

  global $wpdb;
  global $table_prefix;

  // get an array of the table names that our posts will be in
  // we do this by first getting all of our blog ids and then forming the name of the 
  // table and putting it into an array
    $network_sites = get_post_meta($network, '_community_network_sites');
    $blogs = implode(",", $network_sites);

    $rows = $wpdb->get_results( "SELECT blog_id from $wpdb->blogs WHERE blog_id != '1' AND blog_id = '$blogs' AND
    public = '1' AND archived = '0' AND spam = '0' AND deleted = '0';" );

    // echo "<pre>";
    // var_dump($blogs);
    // echo "</pre>";

  if ( $rows ) :

    $blogPostTableNames = array();
    foreach ( $rows as $row ) :
    
      $blogPostTableNames[$row->blog_id] = $wpdb->get_blog_prefix( $row->blog_id ) . 'posts';

    endforeach;
    # print_r($blogPostTableNames); # debugging code

    // now we need to do a query to get all the posts from all our blogs
    // with limits applied
    if ( count( $blogPostTableNames ) > 0 ) :

      $query = '';
      $i = 0;

      foreach ( $blogPostTableNames as $blogId => $tableName ) :

        if ( $i > 0 ) :
        $query.= ' UNION ';
        endif;

        $query.= " (SELECT ID, post_date, $blogId as `blog_id` FROM $tableName WHERE post_status = 'publish' AND post_type = 'post')";
        $i++;

      endforeach;

      $query.= " ORDER BY post_date DESC LIMIT 0,$howMany;";
      # echo $query; # debugging code
      $rows = $wpdb->get_results( $query );

      // now we need to get each of our posts into an array and return them
      if ( $rows ) :

        $posts = array();
        foreach ( $rows as $row ) :
        $posts[] = get_blog_post( $row->blog_id, $row->ID );
        endforeach;
        # echo "<pre>"; print_r($posts); echo "</pre>"; exit; # debugging code
        return $posts;

      else:

        return "Error: No Posts found";

      endif;

    else:

       return "Error: Could not find blogs in the database";

    endif;
  
  else:

    return "Error: Could not find blogs";
    
  endif;
}
    ?>
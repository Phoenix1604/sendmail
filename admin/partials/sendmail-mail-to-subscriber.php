<?php

function sb_sendmail_mailsend($email) {

    $number_of_posts = get_option('sb_sendmail_options');
    $site_title = get_bloginfo( 'name' );
    $subject = $site_title . " - Latest " . $number_of_posts['no-of-posts'] . " posts";
    $message='';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'order' => 'DESC',
      );
      
      $query = new WP_Query( $args );
      
      if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
          $query->the_post();
          // Do something with each post, e.g. display title and content
          $message=  get_the_title() . ' || ' . get_permalink() . '\n';
        }
      }
      
      wp_reset_postdata();

    wp_mail($email, $subject, $message);
}
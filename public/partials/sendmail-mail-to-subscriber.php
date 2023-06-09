<?php

function sb_sendmail_mailsend($email) {

    $number_of_posts = get_option('sb_sendmail_options');
    $site_title = get_bloginfo( 'name' );
    $subject = "Hurray!! Welcome to " . $site_title;
    $message = "<h1>You are Successfully subscribed for the daily updates of " . $site_title . "</h1>";
    $message .= "<br>";
    $message .= "<br>";
    $message .= "<h3>Here are our latest " . $number_of_posts['no-of-posts'] . " Posts</h3>";
		$message .= "<br>";

    $summary = get_latest_post_details($number_of_posts['no-of-posts']);

		foreach ($summary as $post_data) {
			$message .= 'Title: ' . $post_data['title'] . "\n<br>";
			$message .= 'URL: <a>' . $post_data['url'] . "</a>\n<br>";
			$message .= "<br>\n";
		}

		$headers = array(
			'From: subhajit.bera@wisdmlabs.com',
			'Content-Type: text/html; charset=UTF-8'
		);

    wp_mail($email, $subject, $message, $headers);
}


function get_latest_post_details($post_number) {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $post_number,
      'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    $posts = $query->posts;
    $summary = array();

    foreach ($posts as $post) {
      $post_data = array(
        'title' => $post->post_title,
        'url' => get_permalink($post->ID),
      );
      array_push($summary, $post_data);
    }
    return $summary;
}
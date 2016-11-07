<?php

function wpb_adding_scripts() {
	wp_register_script('category-menu', get_stylesheet_directory_uri() . '/category-menu.js', array(), false, true);
	wp_enqueue_script('category-menu');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );

function get_wordpress_twitter (){
	return '<a class="twitter-timeline" data-height="400px" href="https://twitter.com/UConnCSCH">Tweets by UConnCSCH</a> <script async="" src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
}

add_shortcode ('twitter', 'get_wordpress_twitter');

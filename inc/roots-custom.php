<?php

// custom post type
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'dream',
    array(
      'labels' => array(
        'name' => __( '飞屋梦想号' ),
        'singular_name' => __( 'Dreams' ),
        'add_new' => __('生产 Dream'),
        'add_new_item' => __('生产 Dream'),
        'rewrite' => array('slug' => '$slug'),
                        ),
      'menu_position' => 5,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'comments', 'revisions'),
      'taxonomies' => array('dream_tag')));
  register_post_type( 'log',
    array(
      'labels' => array(
        'name' => __( 'Logs' ),
        'singular_name' => __( 'Logs' ),
        'add_new' => __('生产 Log'),
        'add_new_item' => __('生产 Log'),
        'rewrite' => array('slug' => '$slug'),
                        ),
      'menu_position' => 5,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'comments', 'revisions', 'post-formats'),
      'taxonomies' => array('log_tag')));
}

?>
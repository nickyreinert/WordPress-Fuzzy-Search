<?php
 
    function enqueue_styles() {
    
        wp_enqueue_style('parent-theme', get_stylesheet_directory_uri() .'/style.css');

    }
    add_action('wp_enqueue_scripts', 'enqueue_styles');

    add_shortcode("wp-faq-fuzzy-search", "init_wp_faq_fuzzy_search");

    function init_wp_faq_fuzzy_search($settings) {

        global $wpdb;

        $posts = $wpdb->get_results ("
            SELECT posts.post_title, posts.post_excerpt, posts.guid
            FROM {$wpdb->posts} AS posts
            INNER JOIN {$wpdb->term_relationships} AS tax ON (posts.ID = tax.object_id)
            WHERE posts.post_status = 'publish' 
            AND posts.post_type = 'post'
            AND tax.term_taxonomy_id = {$settings['search_category']};
        ");

        $wp_faq_list = [];

        foreach ($posts as $post) {

            $wp_faq_list[] = [
                'title' => $post->post_title,
                'url' => $post->guid,
                'excerpt' => $post->post_excerpt
            ];

        }

        wp_enqueue_script(
            'wp-faq-fuzzy-search', 
            get_stylesheet_directory_uri( __DIR__ ).'/script.js',
            array( 'jquery' )
        );

        wp_enqueue_script(
            'wp-faq-fuzzy-search-fuse', 
            get_stylesheet_directory_uri( __DIR__ ).'/fuse/fuse.js',
            array( 'wp-faq-fuzzy-search' )
        );

        wp_add_inline_script(
            'wp-faq-fuzzy-search', 
            'const wp_faq_list = ' . json_encode($wp_faq_list), 
            'before'
        );

        $search_field = "<input id='wp-faq-fuzzy-search-query' type='text'></input>";
		$search_result = "<ul id='wp-faq-search-results'></ul>";

        return '<p>'.$search_field . $search_result.'</p>';

    }
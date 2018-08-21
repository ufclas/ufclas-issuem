<?php
/*
Plugin Name: UF CLAS - IssueM
Plugin URI: http://it.clas.ufl.edu/
Description: Helper functions for IssueM.
Version: 1.2.3
Author: Priscilla Chapman (CLAS IT)
Author URI: http://it.clas.ufl.edu/
License: GPL2
*/

//Include issue and article template files
require_once( dirname( __FILE__) . '/ufclas-issuem-newsletter.php' );

/**
 * Remove columns from the article admin screen
 *
 * @param array $columns
 * @return array Columns to display on All articles screen
 * @since 1.1.0
 */
function ufclas_issuem_article_posts_columns( $columns ){
	unset($columns['comments']);
	unset($columns['expirationdate']);
	return $columns;
}
add_filter('manage_article_posts_columns', 'ufclas_issuem_article_posts_columns');

/**
 * Add an 'issue' filter dropdown to the articles screen
 *
 * @since 1.1.0
 */
function ufclas_issuem_article_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'article' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Issues',
            'taxonomy' => 'issuem_issue',
            'name' => 'issuem_issue',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['issuem_issue'] ) ? $wp_query->query['issuem_issue'] : '' ),
            'hierarchical' => false,
            'depth' => 1,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}
add_action( 'restrict_manage_posts', 'ufclas_issuem_article_filter_list' );

/**
 * Query for the 'Issue' filter dropdown on the articles screen
 *
 * @param $query
 * @since 1.1.0
 */
function ufclas_issuem_article_filter( $query ) {
	if ( is_admin() ){ 
		$qv = &$query->query_vars;
		if( isset( $qv['issuem_issue'] ) ){
			if ( ( $qv['issuem_issue'] ) && is_numeric( $qv['issuem_issue'] ) ) {
				$term = get_term_by( 'id', $qv['issuem_issue'], 'issuem_issue' );
				$qv['issuem_issue'] = $term->slug;
			}
		}
	}
}
add_filter( 'parse_query','ufclas_issuem_article_filter' );

/**
 * Allow the 'aside' post format
 * @since 1.1.0
 */
function ufclas_issuem_setup(){
	add_theme_support( 'post-formats', array( 'aside' ) );	
}
add_action( 'after_setup_theme', 'ufclas_issuem_setup' );

/**
 * Add a read more link for article excerpts and conent
 *
 * @param string $more
 * @return string Read more text to display
 * @since 1.1.0
 */
function ufclas_issuem_readmore( $more ) {
	return '<p class="read-more"><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'ufclas_newsletter') . '</a></p>';
}
add_filter('excerpt_more', 'ufclas_issuem_readmore');
add_filter( 'the_content_more_link', 'ufclas_issuem_readmore' );

/**
 * Get information about the active issue from the term data
 *
 * @since 1.1.0
 */
function ufclas_issuem_issue_data() {
	global $post;
	
	// Get the issue term object assigned to the current post or taxonomy page
	if( is_page() ){
		$issue_terms = get_terms( 'issuem_issue', array('slug' => get_issuem_issue_slug() ));
	}
	else {
		$issue_terms = wp_get_object_terms($post->ID, 'issuem_issue');
	}
	
	if(!empty($issue_terms) && !is_wp_error($issue_terms)){
		
		$issue_term = $issue_terms[0];
		
		$queried_issue = array(
			'title' => $issue_term->name,
			'url' => get_term_link( $issue_term ),
			'description' => term_description( $issue_term ),
		);
	}
	else {
		$queried_issue = false;
	}
	return $queried_issue;
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.1.0
 */
function ufclas_issuem_posted_on() {
	$time_format = '<time class="entry-date published" datetime="%s">%s</time>';
	echo '<span class="posted-on">Posted on ' . sprintf($time_format, esc_attr(get_the_date('c')), esc_html(get_the_date()) ) . '</span>';

}

/**
 * Adds site name to title
 *
 * @since 1.2.0
 */
function ufclas_issuem_title( $title, $sep ) {
	$issuem_settings = get_issuem_settings();
	
	if( (get_post_type() == 'article') || is_tax('issuem_issue') || is_page($issuem_settings['page_for_articles']) ){
		$title .= get_bloginfo('name');
	}
	return $title;
}
add_filter( 'wp_title', 'ufclas_issuem_title', 10, 2 );
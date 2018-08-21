<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ufclas-issuem
 */
?>
<?php
	include('header-issue.php');

	// Display articles by menu order then modified date
	$issue_args = array(
		'post_type' => 'article',
		'orderby' => 'menu_order date',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'issuem_issue',
				'field' => 'slug',
				'terms' => get_active_issuem_issue()
			),
		),
	);
	$issue_query = new WP_Query( $issue_args );
	
	if ( $issue_query->have_posts() ) : 
		include('content-issue.php');
	else : 
		include('content-none.php');
	endif;
	
	// Restore original post data
	wp_reset_postdata();
	
	include('footer-issue.php');


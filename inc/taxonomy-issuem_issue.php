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
	
	$issue_query = $wp_query;
	
	if ( $issue_query->have_posts() ) : 
		include('content-issue.php');
    else : 
		include('content-none.php');
	endif;

	include('footer-issue.php');

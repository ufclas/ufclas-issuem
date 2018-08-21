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
	// Use the email template
	include('header-issue.php');
?>
<div id="primary" class="content-area col-md-10 col-md-offset-1">
		<main id="main" class="site-main" role="main">
<?php		
    if ( have_posts() ) : ?>
		
		<section id="primary" class="content-area row">
                    <main id="main" class="site-main" role="main">
                     <header class="page-header">
                     		<?php 
								if( is_tax() ){
									$term = get_queried_object();
									$page_title = sprintf("Articles in &quot;%s&quot;", $term->name);
								}
								if( is_search() ){
									$page_title = sprintf("Article results for &quot;%s&quot;", get_search_query());
								}
							?>
                            <h1 class="page-title"><?php echo $page_title; ?></h1>
                    </header><!-- .page-header --> 	
					
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        	<header class="entry-header">
                                <h2 class="entry-title"><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h2>
                                <p class="posted-on"><?php ufclas_issuem_posted_on(); ?></p>
            				</header><!-- .entry-header -->
                            
                            <div class="entry-content">
							<?php the_content(); ?></div> <!-- .entry-content -->
                        </article>
                        <!-- #post-## -->
                  	<?php endwhile; ?>
                    </main>
                    <!-- #main --> 
                  </section>
                  <!-- #primary --> 
</main>
</div>
<?php 
    else : 
		include('content-none.php');
	endif;

	include('footer-issue.php');
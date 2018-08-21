<?php
/**
 * The template for displaying article pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ufclas-issuem
 */
?>
<?php
	include('header-issue.php');
?>
<div id="primary" class="content-area col-md-10 col-md-offset-1">
	<main id="main" class="site-main" role="main">

<?php if ( have_posts() ) : ?>
		
		<section id="primary" class="content-area row">
            <main id="main" class="site-main" role="main">
             <header class="page-header">
                <?php 
					// Get information about the current article's issue, if set
					$article_issue = ufclas_issuem_issue_data();
					
					if( $article_issue ): 
				?>
                    <p class="breadcrumbs"><a href="<?php echo $article_issue['url']; ?>"><?php echo $article_issue['title']; ?></a></p>
                <?php endif; ?>
            </header><!-- .page-header --> 	
            
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                    <?php 
                        if( has_post_thumbnail() ){
                        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                        $article_background = ' style="background-image: url(' . $image_url[0] . ');"';
                        echo '<div class="article-feature"' . $article_background . '></div>';
                    }
                    ?>
                    
                    <div class=" col-md-11 col-md-offset-1"><h2 class="entry-title"><?php the_title(); ?></h2></div>
                    </header><!-- .entry-header -->
                    
                    <div class="entry-content col-md-10 col-md-offset-1">
                    <?php the_content(); ?></div> <!-- .entry-content -->
                    
                    <footer class="entry-footer col-md-10 col-md-offset-1">
                        <?php 
                            
                        ?>
                        <p class="posted-on">By <?php the_author(); ?>, <?php ufclas_issuem_posted_on(); ?></p>
                        <?php if ( $article_issue ): ?>
                            <p><a href="<?php echo $article_issue['url']; ?>" title="<?php echo $article_issue['title']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Issue</a></p>
                        <?php endif; ?>
                        <?php edit_post_link( __( 'Edit Article', 'ufclas-clasnet' ), '<p class="edit-link">', '</p>' ); ?>
                    </footer> <!-- .entry-footer --> 
                </article>
                <!-- #post-## -->
            <?php endwhile; ?>
            </main>
            
          </section>
           
</main><!-- #main --> 
</div><!-- #primary -->
		
<?php 
    else : 
		include('content-none.php');
	endif;

	include('footer-issue.php');
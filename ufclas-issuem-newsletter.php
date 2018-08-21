<?php
/** 
 * CLAS IT Newsletter
 * 
 * Newsletter functions, requires IssueM
 * @since 2.0.0
 */

// Register Custom Navigation Walker class
require_once plugin_dir_path( __FILE__ ) . 'inc/lib/wp-bootstrap-navwalker.php';

/** 
 * Remove UF template styles and scripts for newsletter pages only
 */
function ufclas_issuem_newsletter_scripts_styles(){
	global $wp_styles;
	
	$issuem_settings = get_issuem_settings();
	$is_page_for_articles = ( !empty($issuem_settings['page_for_articles']) && is_page($issuem_settings['page_for_articles']) );
	
	if( is_tax('issuem_issue') || (get_post_type() == 'article') || $is_page_for_articles ){
		
		// Add bootstrap scripts and styles
		wp_enqueue_style('bootstrap', plugins_url('/inc/lib/bootstrap/css/bootstrap.min.css', __FILE__), array(), NULL, 'all'); // 3.3.6
		wp_enqueue_script('bootstrap', plugins_url('/inc/lib/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'), NULL, true); // 3.3.6
		
		// Icon fonts
		wp_enqueue_style('materialdesignicons', plugins_url('/inc/lib/materialdesignicons/css/materialdesignicons.min.css', __FILE__), array(), NULL, 'screen' ); // 1.1.34
		
		// Load IE version-specific stylesheet 
		wp_enqueue_style( 'html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', array('bootstrap'), NULL, 'screen'  ); // 3.7.2
    	$wp_styles->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		
		wp_enqueue_style( 'respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array('bootstrap'), NULL, 'screen'  ); // 1.4.2
    	$wp_styles->add_data( 'respond', 'conditional', 'lt IE 9' );
		
		// Theme
		wp_enqueue_script('theme', plugins_url('/inc/js/theme.min.js', __FILE__), array('jquery'), NULL, true);
		wp_enqueue_style('newsletter', plugins_url('/inc/css/style.min.css', __FILE__), array(), '1.2.2', 'screen' );
		
		// Remove styles
		remove_action('wp_head', 'ufandshands_header_adder');
		remove_action('wp_head', 'ufandshands_site_title_size');
		remove_action('wp_head', 'ufandshands_alternate_logo');
		
		// Remove scripts
		wp_dequeue_script('modernizr');
		wp_dequeue_script('cycle');
		wp_dequeue_script('autoclear');
		wp_dequeue_script('hoverintent');
		wp_dequeue_script('institutional-nav');
		wp_dequeue_script('pretty-photo');
		wp_dequeue_script('common-script');
		wp_dequeue_script('responsive-script');
		wp_dequeue_script('comment-reply');
		wp_dequeue_script('megamenu');
		wp_dequeue_script('defaultmenu');
		wp_dequeue_script('responsivemenu');
		wp_dequeue_script('storystacker');
		wp_dequeue_script('featureslider');
		wp_dequeue_script('flexslider');
		wp_dequeue_script('autoclear_responsive');
		wp_dequeue_script('jquery-issuem-flexslider');
		
		//Remove styles
		wp_dequeue_style('ufl-responsive-print');
		wp_dequeue_style('ufl-responsive');
		wp_dequeue_style('ufl-responsive-navigation');
		wp_dequeue_style('ufl-responsive-prettyPhoto');
		wp_dequeue_style('tribe-events-calendar-style');
		wp_dequeue_style('tribe-events-calendar-mobile-style');
		wp_dequeue_style('tribe-events-calendar-override-style');
		wp_dequeue_style('cpsh-shortcodes');
		wp_dequeue_style('jquery-issuem-flexslider');
		wp_dequeue_style('tablepress-default');
	}
}
add_action('wp_enqueue_scripts', 'ufclas_issuem_newsletter_scripts_styles', 20);

/** 
 * Add custom templates
 * @return string
 */
function ufclas_issuem_newsletter_templates( $template_path ){
	
	$issuem_settings = get_issuem_settings();
	
	if ( is_singular('article') ){
		
		// Change template for article pages
		$template_path = plugin_dir_path( __FILE__ ) . '/inc/single-article.php';
		
	} elseif ( is_tax('issuem_issue') ){
		
		// Change template for issue pages
		$template_path = plugin_dir_path( __FILE__ ) . '/inc/taxonomy-issuem_issue.php';
		
	} elseif ( is_page($issuem_settings['page_for_articles']) && !empty($issuem_settings['page_for_articles']) ){
		
		// Change template for the newsletter page
		$template_path = plugin_dir_path( __FILE__ ) . '/inc/page-issue.php';
	
	} elseif ( is_tax('issuem_issue_categories') ){
	
		// Change template for article pages
		$template_path = plugin_dir_path( __FILE__ ) . '/inc/archive-article.php';
	
	} elseif ( is_search() && ( get_query_var('post_type') == 'article' ) ){
	
		// Change template for article pages
		$template_path = plugin_dir_path( __FILE__ ) . '/inc/archive-article.php';
	}
	
	return $template_path;
}
add_filter( 'template_include', 'ufclas_issuem_newsletter_templates', 1 );

/** 
 * Set the title of the newsletter, not just the issue
 * @return string
 */
function ufclas_issuem_newsletter_title(){
	return 'CLAS IT Connections';
}

//remove_filter( 'the_content', 'default_issue_content_filter', 10 );

// Use category order - see issuem-shortcodes.php
function ufclas_issuem_newsletter_get_categories(){
	$terms = array();
	$all_terms = get_terms( 'issuem_issue_categories' );
	
	foreach( $all_terms as $term ) {
	
		$issue_cat_meta = get_option( 'issuem_issue_categories_' . $term->term_id . '_meta' );
			
		if ( !empty( $issue_cat_meta['category_order'] ) )
			$terms[ $issue_cat_meta['category_order'] ] = $term;
		else
			$terms[] = $term;
	}
	ksort($terms);
	return $terms;
}

function ufclas_issuem_newsletter_setup(){
	register_nav_menus( array(
		'newsletter-global' => esc_html__( 'Newsletter Global Menu', 'ufclas-clasnet' ),
		'newsletter-primary' => esc_html__( 'Newsletter Primary Menu', 'ufclas-clasnet' ),
	) );
}
add_action( 'after_setup_theme', 'ufclas_issuem_newsletter_setup' );

function ufclas_issuem_newsletter_global_menu( $items, $args ){
    if( $args->theme_location == 'newsletter-global' ){
        $items .= '<li id="search">
            <form role="search" method="get" action="' . home_url('/') . '" class="search-form">
              <div class="form-group has-feedback">
                <label for="search-field" class="sr-only">Search Articles</label>
                <input type="text" class="form-control" name="s" id="search-field" placeholder="Search Articles">
				<input type="hidden" value="article" name="post_type" id="post_type" />
                <i class="mdi mdi-magnify form-control-feedback"></i> </div>
            </form>
          </li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ufclas_issuem_newsletter_global_menu', 10, 2);

function ufclas_issuem_newsletter_head(){
	//Custom CSS
	$custom_css = of_get_option('opt_custom_css');
	if(!empty($custom_css)) {
		echo '<style type="text/css">' . $custom_css . '</style>'."\n";
	}
}
add_action('wp_head', 'ufclas_issuem_newsletter_head');

function ufclas_issuem_newsletter_footer(){
	//Custom JS
	$custom_js = of_get_option('opt_custom_js');
	if(!empty($custom_js)) {
		echo '<script type="text/javascript">' . $custom_js . '</script>'."\n";
	}
}
add_action('wp_footer', 'ufclas_issuem_newsletter_footer');

/**
 * Modify the main query for issue pages
 * 
 * Display articles by menu order then modified date
 */
function ufclas_issuem_newsletter_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
	
    if ( $query->is_tax('issuem_issue') ) {
        $query->set( 'orderby', 'menu_order date' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'ufclas_issuem_newsletter_query', 1 );
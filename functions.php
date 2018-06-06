<?php
/**
 * Plan Conolog functions and definitions
 *
 * @package Plan_Conolog
 * @since 1.0
 */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 860;

/*
 * Tell WordPress to run planconolog_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'planconolog_setup' );

if ( ! function_exists( 'planconolog_setup' ) ):
/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses load_theme_textdomain()    For translation/localization support.
 * @uses add_editor_style()         To style the visual editor.
 * @uses add_theme_support()        To add support for post thumbnails, automatic feed links, custom headers
 * 	                                and backgrounds, and post formats.
 * @uses register_nav_menus()       To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size()  To set a custom post thumbnail size.
 *
 * @since Plan Conolog 1.0
 */
function planconolog_setup() {
	
	//Textdomain is for translation/localization support. For more information plz visit http://developer.wordpress.org
	load_theme_textdomain( 'planconolog', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();



	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'planconolog' ) );

	// Add support for custom headers.
	$custom_header_support = array(
		// The height and width of our custom header.
		/**
		 * Filter the Plan Conolog default header image width.
		 *
		 * @since Plan Conolog 1.0
		 *
		 * @param int The default header image width in pixels. Default 1200.
		 */
		'width' => apply_filters( 'planconolog_header_image_width', 1200 ),
		/**
		 * Filter the Plan Conolog default header image height.
		 *
		 * @since Plan Conolog 1.0
		 *
		 * @param int The default header image height in pixels. Default 500.
		 */
		'height' => apply_filters( 'planconolog_header_image_height', 500 ),
		// Support flexible heights.
		'flex-height' => false,
		// Random image rotation by default.
		'random-default' => true,
	);

	add_theme_support( 'custom-header', $custom_header_support );

	/*
	 * We want them to be the size of the content width that we just defined.
	 * Larger images will be auto-cropped to fit, smaller ones will be ignored. 
	 */
	set_post_thumbnail_size( $content_width, 130, true );

	//add thumbnail support to the post.
	add_theme_support( 'post-thumbnails', array( 'post' ) ); 

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'long-hair-megumi' => array(
			'url' => '%s/images/headers/long-hair-megumi.png',
			'thumbnail_url' => '%s/images/headers/long-hair-megumi-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Long Hair Megumi', 'planconolog' )
		),
		'no-game-no-life' => array(
			'url' => '%s/images/headers/no-game-no-life.png',
			'thumbnail_url' => '%s/images/headers/no-game-no-life-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'No Game No Life', 'planconolog' )
		),
		'rezero' => array(
			'url' => '%s/images/headers/rezero.png',
			'thumbnail_url' => '%s/images/headers/rezero-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'ReZeRo', 'planconolog' )
		),
		'sao' => array(
			'url' => '%s/images/headers/sao.png',
			'thumbnail_url' => '%s/images/headers/sao-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'SAO', 'planconolog' )
		),
		'short-hair-megumi' => array(
			'url' => '%s/images/headers/short-hair-megumi.png',
			'thumbnail_url' => '%s/images/headers/short-hair-megumi-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Short Hair Megumi', 'planconolog' )
		),
		'yosuga-no-sora' => array(
			'url' => '%s/images/headers/yosuga-no-sora.png',
			'thumbnail_url' => '%s/images/headers/yosuga-no-sora-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Yosuga No Sora', 'planconolog' )
		)
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // planconolog_setup

/**
 * To remove the section 'Colors' from the theme customization admin screen
 *
 * For now we don't need this section
 *
 * @since Plan Conolog 1.0
 */
 function planconolog_customize_register( $wp_customize ) {
	 $wp_customize->remove_section( 'colors' );
 }
 add_action( 'customize_register', 'planconolog_customize_register' );

/**
 * Set the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove
 * the filter and add your own function tied to
 * the excerpt_length filter hook.
 *
 * @since Plan Conolog 1.0
 *
 * @param int $length The number of excerpt characters.
 * @return int The filtered number of characters.
 */
function planconolog_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'planconolog_excerpt_length' );

if ( ! function_exists( 'planconolog_continue_reading_link' ) ) :
/**
 * Return a "Continue Reading" link for excerpts
 *
 * @since Plan Conolog 1.0
 *
 * @return string The "Continue Reading" HTML link.
 */
function planconolog_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'planconolog' ) . '</a>';
}
endif; // planconolog_continue_reading_link

/**
 * Replace "[...]" in the Read More link with an ellipsis.
 *
 * The "[...]" is appended to automatically generated excerpts.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Plan Conolog 1.0
 *
 * @param string $more The Read More text.
 * @return The filtered Read More text.
 */
function planconolog_auto_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;' . planconolog_continue_reading_link();
	}
	return $more;
}
add_filter( 'excerpt_more', 'planconolog_auto_excerpt_more' );

/**
 * Add a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Plan Conolog 1.0
 *
 * @param string $output The "Continue Reading" link.
 * @return string The filtered "Continue Reading" link.
 */
function planconolog_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
		$output .= planconolog_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'planconolog_custom_excerpt_more' );

/**
 * Show a home link for the wp_nav_menu() fallback, wp_page_menu().
 *
 * @since Plan Conolog 1.0
 *
 * @param array $args The page menu arguments. @see wp_page_menu()
 * @return array The filtered page menu arguments.
 */
function planconolog_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'planconolog_page_menu_args' );

/**
 * Register sidebars and widgetized areas.
 *
 * Also register the default Epherma widget.
 *
 * @since Plan Conolog 1.0
 */
function planconolog_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'planconolog' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'planconolog_widgets_init' );

if ( ! function_exists( 'planconolog_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 *
 * @since Plan Conolog 1.0
 *
 * @param string $html_id The HTML id attribute.
 */
function planconolog_content_nav() {
	echo paginate_links();
}
endif; // planconolog_content_nav

if ( ! function_exists( 'planconolog_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Plan Conolog 1.0
 *
 * @param object $comment The comment object.
 * @param array  $args    An array of comment arguments. @see get_comment_reply_link()
 * @param int    $depth   The depth of the comment.
 */
function planconolog_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'planconolog' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'planconolog' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'planconolog' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'planconolog' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'planconolog' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'planconolog' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'planconolog' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for planconolog_comment()

if ( ! function_exists( 'planconolog_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Plan Conolog 1.0
 */
function planconolog_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'planconolog' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'planconolog' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Plan Conolog 2.7
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function planconolog_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'planconolog_widget_tag_cloud_args' );

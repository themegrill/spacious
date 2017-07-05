<?php
/**
 * Spacious functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menu() To add support for navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750;

/**
 * $content_width global variable adjustment as per layout option.
 */
function spacious_content_width() {
   global $post;
   global $content_width;

   if( $post ) { $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true ); }
   if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
   $spacious_default_layout = spacious_options( 'default_layout', 'right_sidebar' );

   if ( $layout_meta == 'default_layout' ) {
      if ( ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' ) || ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) ) {
         if ( $spacious_default_layout == 'no_sidebar_full_width' ) { $content_width = 978; /* pixels */ }
         else { $content_width = 642; /* pixels */ }
      }
      elseif ( $spacious_default_layout == 'no_sidebar_full_width' ) { $content_width = 1218; /* pixels */ }
      else { $content_width = 750; /* pixels */ }
   }
   elseif ( ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' ) || ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) ) {
      if ( $layout_meta == 'no_sidebar_full_width' ) { $content_width = 978; /* pixels */ }
      else { $content_width = 642; /* pixels */ }
   }
   elseif ( $layout_meta == 'no_sidebar_full_width' ) { $content_width = 1218; /* pixels */ }
   else { $content_width = 750; /* pixels */ }
}
add_action( 'template_redirect', 'spacious_content_width' );

add_action( 'after_setup_theme', 'spacious_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if( !function_exists( 'spacious_setup' ) ) :
function spacious_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'spacious', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );

   // Supporting title tag via add_theme_support (since WordPress 4.1)
   add_theme_support( 'title-tag' );

   // Adds the support for the Custom Logo introduced in WordPress 4.5
   add_theme_support( 'custom-logo',
   		array(
   			'height' => '100',
   			'width' => '100',
   			'flex-width' => true,
   			'flex-height' => true,
   		)
   	);

	// Registering navigation menus.
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu','spacious' ),
		'footer' 	=> __( 'Footer Menu','spacious' )
	) );

	// Cropping the images to different sizes to be used in the theme
	add_image_size( 'featured-blog-large', 750, 350, true );
	add_image_size( 'featured-blog-medium', 270, 270, true );
	add_image_size( 'featured', 642, 300, true );
	add_image_size( 'featured-blog-medium-small', 230, 230, true );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'spacious_custom_background_args', array(
		'default-color' => 'eaeaea'
	) ) );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	));

	// Support for selective refresh widgets in Customizer
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Add the search widget to the header sidebar.
			'spacious_header_sidebar' => array(
				'header_search'	=> array(
					'search',
					array( 'title'	=> '',
					),
				),
			),

			// Add text widgets to the contact sidebar.
			'spacious_contact_page_sidebar' => array(
				'text_business_info',
				'text_about',
			),

			// Add text widget and cta widget in the Business Top sidebar.
			'spacious_business_page_top_section_sidebar' => array(
				'text_top_sidebar_info' => array(
					'text',
					array(
						'title' => esc_html__( 'Business Top Sidebar', 'spacious' ),
						'text'  => esc_html__( 'Shows widgets on Business Page Template Top Section.', 'spacious' ).' '.__( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'spacious' ).
                  '<ul>
                     <li>'.'<strong>'.esc_html__( 'TG: Services', 'spacious' ).'</strong>'.' - '.esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'spacious' ).'</li>
                     <li>'.'<strong>'.esc_html__( 'TG: Call To Action Widget', 'spacious' ).'</strong>'.' - '.esc_html__( 'Use this widget to show the call to action section.', 'spacious' ).'</li>
                     <li>'.'<strong>'.esc_html__( 'TG: Featured Widget', 'spacious' ).'</strong>'.' - '.esc_html__( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'spacious' ).'</li></ul>'
				  	),
				),
				'call_to_action' => array(
					'spacious_call_to_action_widget',
					array(
					    'text_main' 	  => esc_html__( 'Call to Action Main Text','spacious' ),
					    'text_additional' => esc_html__( 'Call to Action Additional Text','spacious' ),
					    'button_text'	  => esc_html__( 'Theme Info', 'spacious' ),
					    'button_url'	  => 'https://themegrill.com/themes/spacious/',
					),
				),
			),

			// Add text widget and featured single page widget in the Business Middle Left Sidebar.
			'spacious_business_page_middle_section_left_half_sidebar' => array(
            'text_middle_left_sidebar_info' => array(
               'text',
               array(
                  'title' => esc_html__( 'Business Middle Left Sidebar', 'spacious' ),
                  'text'  => esc_html__( 'Shows widgets on Business Page Template Middle Section Left Half.', 'spacious' ).' '.esc_html__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' )
               ),
            ),
				'featured_single_page' => array(
			      'spacious_featured_single_page_widget',
			      array(
			            'page_id'   => '02',
				  	),
			    ),
			),

			// Add text widget and testimonial widget in the Business Middle Right Sidebar.
			'spacious_business_page_middle_section_right_half_sidebar' => array(
            'text_middle_right_sidebar_info' => array(
               'text',
               array(
                  'title' => esc_html__( 'Business Middle Right Sidebar', 'spacious' ),
                  'text'  => esc_html__( 'Shows widgets on Business Page Template Middle Section Right Half.', 'spacious' ).' '.esc_html__( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' )
               ),
            ),
				'testimonial' => array(
					'spacious_testimonial_widget',
					array(
					    'title' 	=> esc_html__( 'TG: Testimonial', 'spacious' ),
					    'text' 		=> 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw. ',
					    'name'		=> 'Mr. Bipin Singh',
					    'byline'	=> 'CEO',
					),
				)
			),

			// Add text widget in the Business Bottom Sidebar.
			'spacious_business_page_bottom_section_sidebar' => array(
				'text_bottom_sidebar_info' => array(
					'text',
					array(
					    'title'	=> esc_html__( 'Business Bottom Sidebar', 'spacious' ),
					    'text'	=> esc_html__( 'Shows widgets on Business Page Template Bottom Section.', 'spacious' ).' '.__( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Widget', 'spacious' ).
                   '<ul>
                     <li>'.'<strong>'.esc_html__( 'TG: Services', 'spacious' ).'</strong>'.' - '.esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'spacious' ).'</li>
                     <li>'.'<strong>'.esc_html__( 'TG: Call To Action Widget', 'spacious' ).'</strong>'.' - '.esc_html__( 'Use this widget to show the call to action section.', 'spacious' ).'</li>
                     <li>'.'<strong>'.esc_html__( 'TG: Featured Widget', 'spacious' ).'</strong>'.' - '.esc_html__( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'spacious' ).'</li></ul>'
					),
				),
			),

         // Add the text widget in the footer siderbar 1.
         'spacious_footer_sidebar_one' => array(
            'text_business_info',
         ),

         // Add search widget and text widget in the footer siderbar 2.
         'spacious_footer_sidebar_two' => array(
            'search',
            'text_about'
         ),

         // Add the text widget in the footer siderbar 3.
         'spacious_footer_sidebar_three' => array(
            'text_custom_menu'   => array(
               'text',
               array(
                   'title' => esc_html__( 'Spacious Important Links', 'spacious' ),
                   'text'  => '<ul>
                             <li><a href="https://themegrill.com/themes/spacious/">'.esc_html__( 'Theme Info', 'spacious' ).'</a></li>
                             <li><a href="https://demo.themegrill.com/spacious/">'.esc_html__( 'View Demo', 'spacious' ).'</a></li>
                             <li><a href="https://www.youtube.com/watch?v=rhiybsv3vUU">'.esc_html__( 'Import Demo', 'spacious' ).'</a></li>
                             <li><a href="https://docs.themegrill.com/spacious/">'.esc_html__( 'Documentation', 'spacious' ).'</a></li>
                             <li><a href="https://themegrill.com/support-forum/forum/spacious-free/">'.esc_html__( 'Support Forum', 'spacious' ).'</a></li>
                            </ul>'
               ),
            ),
         ),

         // Add the featured single page widget in the footer siderbar 4.
         'spacious_footer_sidebar_four' => array(
            'featured_single_page' => array(
               'spacious_featured_single_page_widget',
               array(
                     'page_id'   => '02',
               ),
            ),
         ),
		),

		// Specify the core-defined pages to create.
		'posts' => array(
			'home' => array(
				'template'		=> 'page-templates/business.php',
			),
         'about',
			'blog',
			'contact'		=> array(
				'template'	=> 'page-templates/contact.php',
				),
			),

		// Create the custom image attachments for site logo.
		'attachments' => array(
			'image-logo' => array(
				'post_title'	=> 'spacious logo image',
				'file' 			=> 'images/spacious-logo.png', // URL relative to the template directory.
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' 	=> 'page',
			'page_on_front' 	=> '{{home}}',
			'page_for_posts' 	=> '{{blog}}'
			),

		// Setting theme mods of slider settings.
		'theme_mods' => array(
			'custom_logo'                                => '{{image-logo}}',
			'spacious[spacious_show_header_logo_text]'	=> 'both',
			'spacious[spacious_activate_slider]'         => '1',
			'spacious[spacious_blog_slider]'             => '1',
			'spacious[spacious_slider_image1]'           => get_template_directory_uri().'/images/book.jpg',
			'spacious[spacious_slider_title1]'           => esc_html__( 'Enter title for your slider.', 'spacious' ),
			'spacious[spacious_slider_text1]'            => 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw.',
			'spacious[spacious_slider_button_text1]'     => esc_html__( 'Read more', 'spacious' ),
			'spacious[spacious_slider_link1]'            => '#',
			'spacious[spacious_slider_image2]'           => get_template_directory_uri().'/images/chess.jpg',
			'spacious[spacious_slider_title2]'           => esc_html__( 'Enter title for your slider.', 'spacious' ),
			'spacious[spacious_slider_text2]'            => 'Chocolate bar caramels fruitcake icing. Jujubes gingerbread marzipan applicake sweet lemon drops. Marshmallow cupcake bear claw oat cake candy marzipan. Cookie soufflé bear claw.',
			'spacious[spacious_slider_button_text2]'     => esc_html__( 'Read more', 'spacious' ),
			'spacious[spacious_slider_link2]'            => '#',
			),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "primary" location.
			'primary' => array(
				'name'	=> esc_html__( 'Primary Menu', 'spacious' ),
				'items'	=> array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
               'page_blog',
               'page_contact',
				),
			),

			// Assign a menu to the "footer" location.
			'footer' => array(
				'name'	=> esc_html__( 'Footer Menu', 'spacious' ),
				'items' => array(
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	$starter_content = apply_filters( 'spacious_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
	}
endif;

/**
 * Define Directory Location Constants
 */
define( 'SPACIOUS_PARENT_DIR', get_template_directory() );
define( 'SPACIOUS_CHILD_DIR', get_stylesheet_directory() );

define( 'SPACIOUS_INCLUDES_DIR', SPACIOUS_PARENT_DIR. '/inc' );
define( 'SPACIOUS_CSS_DIR', SPACIOUS_PARENT_DIR . '/css' );
define( 'SPACIOUS_JS_DIR', SPACIOUS_PARENT_DIR . '/js' );
define( 'SPACIOUS_LANGUAGES_DIR', SPACIOUS_PARENT_DIR . '/languages' );

define( 'SPACIOUS_ADMIN_DIR', SPACIOUS_INCLUDES_DIR . '/admin' );
define( 'SPACIOUS_WIDGETS_DIR', SPACIOUS_INCLUDES_DIR . '/widgets' );

define( 'SPACIOUS_ADMIN_IMAGES_DIR', SPACIOUS_ADMIN_DIR . '/images' );
define( 'SPACIOUS_ADMIN_CSS_DIR', SPACIOUS_ADMIN_DIR . '/css' );


/**
 * Define URL Location Constants
 */
define( 'SPACIOUS_PARENT_URL', get_template_directory_uri() );
define( 'SPACIOUS_CHILD_URL', get_stylesheet_directory_uri() );

define( 'SPACIOUS_INCLUDES_URL', SPACIOUS_PARENT_URL. '/inc' );
define( 'SPACIOUS_CSS_URL', SPACIOUS_PARENT_URL . '/css' );
define( 'SPACIOUS_JS_URL', SPACIOUS_PARENT_URL . '/js' );
define( 'SPACIOUS_LANGUAGES_URL', SPACIOUS_PARENT_URL . '/languages' );

define( 'SPACIOUS_ADMIN_URL', SPACIOUS_INCLUDES_URL . '/admin' );
define( 'SPACIOUS_WIDGETS_URL', SPACIOUS_INCLUDES_URL . '/widgets' );

define( 'SPACIOUS_ADMIN_IMAGES_URL', SPACIOUS_ADMIN_URL . '/images' );
define( 'SPACIOUS_ADMIN_CSS_URL', SPACIOUS_ADMIN_URL . '/css' );

/** Load functions */
require_once( SPACIOUS_INCLUDES_DIR . '/custom-header.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/functions.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/customizer.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/header-functions.php' );

require_once( SPACIOUS_ADMIN_DIR . '/meta-boxes.php' );

/** Load Widgets and Widgetized Area */
require_once( SPACIOUS_WIDGETS_DIR . '/widgets.php' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
	require get_template_directory() . '/inc/demo-config.php';
}

/**
 * Assign the Spacious version to a variable.
 */
$theme            = wp_get_theme( 'spacious' );
$spacious_version = $theme['Version'];

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-spacious-admin.php';
}
/**
* Load TGMPA Configs.
*/
require_once( SPACIOUS_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );
require_once( SPACIOUS_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-spacious.php' );

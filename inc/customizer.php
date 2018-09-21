<?php
/**
 * Spacious Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.3.4
 */

function spacious_customize_register( $wp_customize ) {

	// Include control classes.
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-image-radio-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-custom-css-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-text-area-control.php';

	// Transport postMessage variable set
	$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '#site-title a',
			'render_callback' => 'spacious_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '#site-description',
			'render_callback' => 'spacious_customize_partial_blogdescription',
		) );
	}

	/**
	 * Class to include upsell link campaign for theme.
	 *
	 * Class SPACIOUS_Upsell_Section
	 */
	class SPACIOUS_Upsell_Section extends WP_Customize_Section {
		public $type = 'spacious-upsell-section';
		public $url = '';
		public $id = '';

		/**
		 * Gather the parameters passed to client JavaScript via JSON.
		 *
		 * @return array The array to be exported to the client as JSON.
		 */
		public function json() {
			$json        = parent::json();
			$json['url'] = esc_url( $this->url );
			$json['id']  = $this->id;

			return $json;
		}

		/**
		 * An Underscore (JS) template for rendering this section.
		 */
		protected function render_template() {
			?>
			<li id="accordion-section-{{ data.id }}"
				class="spacious-upsell-accordion-section control-section-{{ data.type }} cannot-expand accordion-section">
				<h3 class="accordion-section-title"><a href="{{{ data.url }}}" target="_blank">{{ data.title }}</a></h3>
			</li>
			<?php
		}
	}

	// Register `SPACIOUS_Upsell_Section` type section.
	$wp_customize->register_section_type( 'SPACIOUS_Upsell_Section' );

	// Add `SPACIOUS_Upsell_Section` to display pro link.
	$wp_customize->add_section(
		new SPACIOUS_Upsell_Section( $wp_customize, 'spacious_upsell_section',
			array(
				'title'      => esc_html__( 'View PRO version', 'spacious' ),
				'url'        => 'https://themegrill.com/themes/spacious/?utm_source=spacious-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'capability' => 'edit_theme_options',
				'priority'   => 1,
			)
		)
	);
	/*
	 * Assigning the theme name
	 */
	$spacious_themename = get_option( 'stylesheet' );
	$spacious_themename = preg_replace( "/\W/", "_", strtolower( $spacious_themename ) );

	/****************************************Start of the Header Options****************************************/
	// Header Options Area
	$wp_customize->add_panel( 'spacious_header_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 500,
		'title'      => __( 'Header', 'spacious' ),
	) );

	// Header Logo upload option
	$wp_customize->add_section( 'spacious_header_logo', array(
		'priority' => 1,
		'title'    => __( 'Header Logo', 'spacious' ),
		'panel'    => 'spacious_header_options',
	) );

	// Header logo and text display type option
	$wp_customize->add_section( 'spacious_show_option', array(
		'priority' => 2,
		'title'    => __( 'Show', 'spacious' ),
		'panel'    => 'spacious_header_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_show_header_logo_text]', array(
		'default'           => 'text_only',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_show_header_logo_text]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the option that you want.', 'spacious' ),
		'section' => 'title_tagline',
		'choices' => array(
			'logo_only' => __( 'Header Logo Only', 'spacious' ),
			'text_only' => __( 'Header Text Only', 'spacious' ),
			'both'      => __( 'Show Both', 'spacious' ),
			'none'      => __( 'Disable', 'spacious' ),
		),
	) );

	// Header display type option
	$wp_customize->add_section( 'spacious_header_display_type_option', array(
		'priority' => 2,
		'title'    => __( 'Header Display Type', 'spacious' ),
		'panel'    => 'spacious_header_options',
	) );

	$wp_customize->add_setting( 'spacious[spacious_header_display_type]', array(
		'default'           => 'one',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Spacious_Image_Radio_Control( $wp_customize, 'spacious[spacious_header_display_type]', array(
		'type'     => 'radio',
		'label'    => __( 'Choose the header display type that you want.', 'spacious' ),
		'section'  => 'spacious_header_display_type_option',
		'settings' => 'spacious[spacious_header_display_type]',
		'choices'  => array(
			'one'  => SPACIOUS_ADMIN_IMAGES_URL . '/header-left.png',
			'four' => SPACIOUS_ADMIN_IMAGES_URL . '/menu-bottom.png',
		),
	) ) );

	// Header image position option
	$wp_customize->add_section( 'spacious_header_image_position_section', array(
		'priority' => 3,
		'title'    => __( 'Header Image Position', 'spacious' ),
		'panel'    => 'spacious_header_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_header_image_position]', array(
		'default'           => 'above',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_header_image_position]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose top header image display position.', 'spacious' ),
		'section' => 'spacious_header_image_position_section',
		'choices' => array(
			'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
			'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' ),
		),
	) );

	// Responsive collapse menu
	$wp_customize->add_section( 'spacious_new_menu', array(
		'priority' => 4,
		'title'    => __( 'Responsive Menu Style', 'spacious' ),
		'panel'    => 'spacious_header_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_new_menu]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_new_menu]', array(
		'type'    => 'checkbox',
		'label'   => __( 'Switch to new responsive menu.', 'spacious' ),
		'section' => 'spacious_new_menu',
	) );

	// End of Header Options

	/****************************************Start of the Design Options****************************************/
	$wp_customize->add_panel( 'spacious_design_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 505,
		'title'      => __( 'Design', 'spacious' ),
	) );

	// site layout setting
	$wp_customize->add_section( 'spacious_site_layout_setting', array(
		'priority' => 1,
		'title'    => __( 'Site Layout', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_site_layout]', array(
		'default'           => 'box_1218px',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_site_layout]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
		'choices' => array(
			'box_1218px'  => __( 'Boxed layout with content width of 1218px', 'spacious' ),
			'box_978px'   => __( 'Boxed layout with content width of 978px', 'spacious' ),
			'wide_1218px' => __( 'Wide layout with content width of 1218px', 'spacious' ),
			'wide_978px'  => __( 'Wide layout with content width of 978px', 'spacious' ),
		),
		'section' => 'spacious_site_layout_setting',
	) );

	// default layout setting
	$wp_customize->add_section( 'spacious_default_layout_setting', array(
		'priority' => 2,
		'title'    => __( 'Default layout', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Spacious_Image_Radio_Control( $wp_customize, $spacious_themename . '[spacious_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'spacious' ),
		'section'  => 'spacious_default_layout_setting',
		'settings' => $spacious_themename . '[spacious_default_layout]',
		'choices'  => array(
			'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for pages
	$wp_customize->add_section( 'spacious_default_page_layout_setting', array(
		'priority' => 3,
		'title'    => __( 'Default layout for pages only', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_pages_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Spacious_Image_Radio_Control( $wp_customize, $spacious_themename . '[spacious_pages_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'spacious' ),
		'section'  => 'spacious_default_page_layout_setting',
		'settings' => $spacious_themename . '[spacious_pages_default_layout]',
		'choices'  => array(
			'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for single posts
	$wp_customize->add_section( 'spacious_default_single_posts_layout_setting', array(
		'priority' => 4,
		'title'    => __( 'Default layout for single posts only', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_single_posts_default_layout]', array(
		'default'           => 'right_sidebar',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Spacious_Image_Radio_Control( $wp_customize, $spacious_themename . '[spacious_single_posts_default_layout]', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'spacious' ),
		'section'  => 'spacious_default_single_posts_layout_setting',
		'settings' => $spacious_themename . '[spacious_single_posts_default_layout]',
		'choices'  => array(
			'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// blog posts display type setting
	$wp_customize->add_section( 'spacious_blog_posts_display_type_setting', array(
		'priority' => 5,
		'title'    => __( 'Blog Posts display type', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_archive_display_type]', array(
		'default'           => 'blog_large',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_archive_display_type]', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the display type for the latests posts view or posts page view (static front page).', 'spacious' ),
		'choices' => array(
			'blog_large'            => __( 'Blog Image Large', 'spacious' ),
			'blog_medium'           => __( 'Blog Image Medium', 'spacious' ),
			'blog_medium_alternate' => __( 'Blog Image Alternate Medium', 'spacious' ),
			'blog_full_content'     => __( 'Blog Full Content', 'spacious' ),
		),
		'section' => 'spacious_blog_posts_display_type_setting',
	) );

	// Site primary color option
	$wp_customize->add_section( 'spacious_primary_color_setting', array(
		'panel'    => 'spacious_design_options',
		'priority' => 6,
		'title'    => __( 'Primary color option', 'spacious' ),
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_primary_color]', array(
		'default'              => '#0FBE7C',
		'type'                 => 'option',
		'transport'            => 'postMessage',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
		'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $spacious_themename . '[spacious_primary_color]', array(
		'label'    => __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'spacious' ),
		'section'  => 'spacious_primary_color_setting',
		'settings' => $spacious_themename . '[spacious_primary_color]',
	) ) );

	// Site dark light skin option
	$wp_customize->add_section( 'spacious_color_skin_setting', array(
		'priority' => 7,
		'title'    => __( 'Color Skin', 'spacious' ),
		'panel'    => 'spacious_design_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_color_skin]', array(
		'default'           => 'light',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Spacious_Image_Radio_Control( $wp_customize, $spacious_themename . '[spacious_color_skin]', array(
		'type'     => 'radio',
		'label'    => __( 'Choose the light or dark skin. This will be reflected in whole site.', 'spacious' ),
		'section'  => 'spacious_color_skin_setting',
		'settings' => $spacious_themename . '[spacious_color_skin]',
		'choices'  => array(
			'light' => SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
			'dark'  => SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg',
		),
	) ) );

	if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
		// Custom CSS setting
		$wp_customize->add_section( 'spacious_custom_css_setting', array(
			'priority' => 8,
			'title'    => __( 'Custom CSS', 'spacious' ),
			'panel'    => 'spacious_design_options',
		) );

		$wp_customize->add_setting( $spacious_themename . '[spacious_custom_css]', array(
			'default'              => '',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new spacious_Custom_CSS_Control( $wp_customize, $spacious_themename . '[spacious_custom_css]', array(
			'label'    => __( 'Write your Custom CSS.', 'spacious' ),
			'section'  => 'spacious_custom_css_setting',
			'settings' => $spacious_themename . '[spacious_custom_css]',
		) ) );
	}
	// End of Design Options

	/****************************************Start of the Additional Options****************************************/
	$wp_customize->add_panel( 'spacious_additional_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 510,
		'title'      => __( 'Additional', 'spacious' ),
	) );

	//Related post
	$wp_customize->add_section( 'spacious_related_posts_section', array(
		'priority' => 5,
		'title'    => esc_html__( 'Related Posts', 'spacious' ),
		'panel'    => 'spacious_additional_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_related_posts_activate]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_related_posts_activate]', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to activate the related posts', 'spacious' ),
		'section'  => 'spacious_related_posts_section',
		'settings' => $spacious_themename . '[spacious_related_posts_activate]',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_related_posts]', array(
		'default'           => 'categories',
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_radio_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_related_posts]', array(
		'type'     => 'radio',
		'label'    => __( 'Related Posts Must Be Shown As:', 'spacious' ),
		'section'  => 'spacious_related_posts_section',
		'settings' => $spacious_themename . '[spacious_related_posts]',
		'choices'  => array(
			'categories' => esc_html__( 'Related Posts By Categories', 'spacious' ),
			'tags'       => esc_html__( 'Related Posts By Tags', 'spacious' ),
		),
	) );

	// Featured image in single post page activate option
	$wp_customize->add_section( 'spacious_featured_image_single_post_page_section', array(
		'priority' => 6,
		'title'    => __( 'Featured Image In Single Post Page', 'spacious' ),
		'panel'    => 'spacious_additional_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_featured_image_single_post_page]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_featured_image_single_post_page]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to enable the featured image in single post page.', 'spacious' ),
		'section'  => 'spacious_featured_image_single_post_page_section',
		'settings' => $spacious_themename . '[spacious_featured_image_single_post_page]',
	) );

	// Featured image in single page activate option
	$wp_customize->add_section( 'spacious_featured_image_single_page_section', array(
		'priority' => 6,
		'title'    => __( 'Featured Image In Single Page', 'spacious' ),
		'panel'    => 'spacious_additional_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_featured_image_single_page]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_featured_image_single_page]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to enable the featured image in single page.', 'spacious' ),
		'section'  => 'spacious_featured_image_single_page_section',
		'settings' => $spacious_themename . '[spacious_featured_image_single_page]',
	) );

	// Author bio option.
	$wp_customize->add_section( 'spacious_author_bio_section', array(
		'priority' => 5,
		'title'    => __( 'Author Bio', 'spacious' ),
		'panel'    => 'spacious_additional_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_author_bio]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_author_bio]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to enable the author bio section just below the post.', 'spacious' ),
		'section'  => 'spacious_author_bio_section',
		'settings' => $spacious_themename . '[spacious_author_bio]',
	) );

	/****************************************Start of the Slider Options****************************************/
	$wp_customize->add_panel( 'spacious_slider_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 515,
		'title'      => __( 'Slider', 'spacious' ),
	) );

	// Slider activate option
	$wp_customize->add_section( 'spacious_slider_activate_section', array(
		'priority' => 1,
		'title'    => __( 'Activate slider', 'spacious' ),
		'panel'    => 'spacious_slider_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_activate_slider]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_activate_slider]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate slider.', 'spacious' ),
		'section'  => 'spacious_slider_activate_section',
		'settings' => $spacious_themename . '[spacious_activate_slider]',
	) );

	// Selective refresh for slider activate
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( $spacious_themename . '[spacious_activate_slider]', array(
			'selector'        => '#featured-slider',
			'render_callback' => '',
		) );
	}

	// Disable slider in blog page
	$wp_customize->add_section( 'spacious_disable_slider_blog_page_section', array(
		'priority' => 2,
		'title'    => __( 'Disable slider in Posts page', 'spacious' ),
		'panel'    => 'spacious_slider_options',
	) );

	$wp_customize->add_setting( $spacious_themename . '[spacious_blog_slider]', array(
		'default'           => 0,
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spacious_checkbox_sanitize',
	) );

	$wp_customize->add_control( $spacious_themename . '[spacious_blog_slider]', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to disable slider in Posts Page', 'spacious' ),
		'section'  => 'spacious_disable_slider_blog_page_section',
		'settings' => $spacious_themename . '[spacious_blog_slider]',
	) );

	for ( $i = 1; $i <= 5; $i++ ) {
		// adding slider section
		$wp_customize->add_section( 'spacious_slider_number_section' . $i, array(
			'priority' => 10,
			'title'    => sprintf( __( 'Image Upload #%1$s', 'spacious' ), $i ),
			'panel'    => 'spacious_slider_options',
		) );

		// adding slider image url
		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_image' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $spacious_themename . '[spacious_slider_image' . $i . ']', array(
			'label'   => __( 'Upload slider image.', 'spacious' ),
			'section' => 'spacious_slider_number_section' . $i,
			'setting' => $spacious_themename . '[spacious_slider_image' . $i . ']',
		) ) );

		// adding slider title
		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_title' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( $spacious_themename . '[spacious_slider_title' . $i . ']', array(
			'label'   => __( 'Enter title for your slider.', 'spacious' ),
			'section' => 'spacious_slider_number_section' . $i,
			'setting' => $spacious_themename . '[spacious_slider_title' . $i . ']',
		) );

		// adding slider description
		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_text' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_text_sanitize',
		) );

		$wp_customize->add_control( new Spacious_Text_Area_Control( $wp_customize, $spacious_themename . '[spacious_slider_text' . $i . ']', array(
			'label'   => __( 'Enter your slider description.', 'spacious' ),
			'section' => 'spacious_slider_number_section' . $i,
			'setting' => $spacious_themename . '[spacious_slider_text' . $i . ']',
		) ) );

		// adding slider button text
		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_button_text' . $i . ']', array(
			'default'           => __( 'Read more', 'spacious' ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( $spacious_themename . '[spacious_slider_button_text' . $i . ']', array(
			'label'   => __( 'Enter the button text. Default is "Read more"', 'spacious' ),
			'section' => 'spacious_slider_number_section' . $i,
			'setting' => $spacious_themename . '[spacious_slider_button_text' . $i . ']',
		) );

		// adding button url
		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_link' . $i . ']', array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( $spacious_themename . '[spacious_slider_link' . $i . ']', array(
			'label'   => __( 'Enter link to redirect slider when clicked', 'spacious' ),
			'section' => 'spacious_slider_number_section' . $i,
			'setting' => $spacious_themename . '[spacious_slider_link' . $i . ']',
		) );
	}
	// End of Slider Options

	/****************************************Start of the data sanitization****************************************/
	// radio/select sanitization
	function spacious_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// checkbox sanitize
	function spacious_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// text-area sanitize
	function spacious_text_sanitize( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// color sanitization
	function spacious_color_option_hex_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
			return '#' . $unhashed;
		}

		return $color;
	}

	function spacious_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	function spacious_false_sanitize() {
		return false;
	}
}

add_action( 'customize_register', 'spacious_customize_register' );

/*****************************************************************************************/

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function spacious_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function spacious_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Spacious 1.4.9
 */
function spacious_customize_preview_js() {
	wp_enqueue_script( 'spacious-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), false, true );
}

add_action( 'customize_preview_init', 'spacious_customize_preview_js' );

/*****************************************************************************************/

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'spacious_customizer_custom_scripts' );

function spacious_customizer_custom_scripts() { ?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-spacious_upsell_section h3.accordion-section-title {
			background-color: #0FBE7C !important;
			border-left-color: #04a267;
			color: #fff !important;
		}

		#accordion-section-spacious_upsell_section h3 a:after {
			content: '\f345';
			color: #fff;
			position: absolute;
			top: 12px;
			right: 10px;
			z-index: 1;
			font: 400 20px/1 dashicons;
			speak: none;
			display: block;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-decoration: none !important;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title a {
			color: #fff !important;
			display: block;
			text-decoration: none;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title:hover {
			background-color: #09ad6f !important;
			border-left-color: #04a267 !important;
		}

		li#accordion-section-spacious_important_links h3.accordion-section-title:after {
			color: #fff !important;
		}

		/* Upsell button CSS */
		.themegrill-pro-info,
		.customize-control-spacious-important-links a {
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
			background: #008EC2;
			color: #fff;
			display: block;
			margin: 15px 0 0;
			padding: 5px 0;
			text-align: center;
			font-weight: 600;
		}

		.customize-control-spacious-important-links a {
			padding: 8px 0;
		}

		.themegrill-pro-info:hover,
		.customize-control-spacious-important-links a:hover {
			color: #ffffff;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
			background: #2380BA;
		}
	</style>

	<script>
			( function( $, api ) {
				api.sectionConstructor['spacious-upsell-section'] = api.Section.extend( {

					// No events for this type of section.
					attachEvents: function() {
					},

					// Always make the section active.
					isContextuallyActive: function() {
						return true;
					}
				} );
			} )( jQuery, wp.customize );

	</script>
	<?php
}

?>

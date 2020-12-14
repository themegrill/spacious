<?php
/**
 * Spacious Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.3.4
 */

function spacious_customize_register( $wp_customize ) {

	// Custom customizer section classes.
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-upsell-section.php';

	// Include control classes.
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-image-radio-control.php';
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-text-area-control.php';
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-editor-custom-control.php';
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-typography-control.php';
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-heading-control.php';
//	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-divider-control.php';

	$wp_customize->register_control_type( 'Spacious_Heading_Control' );
	$wp_customize->register_control_type( 'Spacious_Divider_Control' );

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

	/*
	 * Assigning the theme name
	 */
	$spacious_themename = get_option( 'stylesheet' );
	$spacious_themename = preg_replace( "/\W/", "_", strtolower( $spacious_themename ) );

	/****************************************Start of the global Options****************************************/
//	$wp_customize->add_panel(
//		'spacious_global_options',
//		array(
//			'capabitity' => 'edit_theme_options',
//			'priority'   => 50,
//			'title'      => esc_html__( 'Global', 'spacious' ),
//		)
//	);

	// Site primary color option.
//	$wp_customize->add_section(
//		'spacious_global_color_setting',
//		array(
//			'panel'    => 'spacious_global_options',
//			'priority' => 7,
//			'title'    => esc_html__( 'Colors', 'spacious' ),
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_primary_color]',
//		array(
//			'default'              => '#0FBE7C',
//			'type'                 => 'option',
//			'transport'            => 'postMessage',
//			'capability'           => 'edit_theme_options',
//			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
//			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		new WP_Customize_Color_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_primary_color]',
//			array(
//				'label'    => esc_html__( 'Primary Color', 'spacious' ),
//				'section'  => 'spacious_global_color_setting',
//				'settings' => $spacious_themename . '[spacious_primary_color]',
//			)
//		)
//	);

//	// Site dark light skin option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_color_skin]',
//		array(
//			'default'           => 'light',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control( $wp_customize,
//			$spacious_themename . '[spacious_color_skin]',
//			array(
//				'type'     => 'radio',
//				'label'    => esc_html__( 'Color Skin', 'spacious' ),
//				'section'  => 'spacious_global_color_setting',
//				'settings' => $spacious_themename . '[spacious_color_skin]',
//				'choices'  => array(
//					'light' => SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
//					'dark'  => SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg',
//				),
//			)
//		)
//	);

	// Global typography options.
//	$wp_customize->add_section(
//		'spacious_global_typography_section',
//		array(
//			'panel'    => 'spacious_global_options',
//			'priority' => 7,
//			'title'    => esc_html__( 'Typography', 'spacious' ),
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_content_font]',
//		array(
//			'default'           => 'Lato',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_font_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Typography_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_content_font]',
//			array(
//				'priority' => 8,
//				'label'    => esc_html__( 'Body', 'spacious' ),
//				'section'  => 'spacious_global_typography_section',
//				'settings' => $spacious_themename . '[spacious_content_font]',
//			)
//		)
//	);

//	// Heading Typography option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_titles_font]',
//		array(
//			'default'           => 'Lato',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_font_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Typography_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_titles_font]',
//			array(
//				'priority' => 8,
//				'label'    => esc_html__( 'Headings', 'spacious' ),
//				'section'  => 'spacious_global_typography_section',
//				'settings' => $spacious_themename . '[spacious_titles_font]',
//			)
//		)
//	);

	// Global Background options.
//	$wp_customize->add_section(
//		'spacious_global_background_section',
//		array(
//			'panel'    => 'spacious_global_options',
//			'priority' => 7,
//			'title'    => esc_html__( 'Background', 'spacious' ),
//		)
//	);

//	$wp_customize->add_setting(
//		'spacious[global_background_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'global_background_heading',
//			array(
//				'label'    => esc_html__( 'Outside Container', 'spacious' ),
//				'section'  => 'spacious_global_background_section',
//				'settings' => 'spacious[global_background_heading]',
//				'priority' => 10,
//			)
//		)
//	);

//	$wp_customize->get_control( 'background_color' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_color' )->priority = 20;
//
//	$wp_customize->get_control( 'background_image' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_image' )->priority = 20;
//
//	$wp_customize->get_control( 'background_preset' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_preset' )->priority = 20;
//
//	$wp_customize->get_control( 'background_position' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_position' )->priority = 20;
//
//	$wp_customize->get_control( 'background_size' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_size' )->priority = 20;
//
//	$wp_customize->get_control( 'background_repeat' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_repeat' )->priority = 20;
//
//	$wp_customize->get_control( 'background_attachment' )->section  = 'spacious_global_background_section';
//	$wp_customize->get_control( 'background_attachment' )->priority = 20;

	// Layout option.
//	$wp_customize->add_section(
//		'spacious_global_layout_section',
//		array(
//			'panel'    => 'spacious_global_options',
//			'priority' => 7,
//			'title'    => esc_html__( 'Layout', 'spacious' ),
//		)
//	);

	// Site layout heading
//	$wp_customize->add_setting(
//		'spacious[global_site_layout_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'global_site_layout_heading',
//			array(
//				'label'    => esc_html__( 'Site Layout', 'spacious' ),
//				'section'  => 'spacious_global_layout_section',
//				'settings' => 'spacious[global_site_layout_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_site_layout]',
//		array(
//			'default'           => 'box_1218px',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_site_layout]',
//		array(
//			'type'    => 'radio',
//			'label'   => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
//			'choices' => array(
//				'box_1218px'  => esc_html__( 'Boxed layout with content width of 1218px', 'spacious' ),
//				'box_978px'   => esc_html__( 'Boxed layout with content width of 978px', 'spacious' ),
//				'wide_1218px' => esc_html__( 'Wide layout with content width of 1218px', 'spacious' ),
//				'wide_978px'  => esc_html__( 'Wide layout with content width of 978px', 'spacious' ),
//			),
//			'section' => 'spacious_global_layout_section',
//		)
//	);

//	// Site layout heading
//	$wp_customize->add_setting(
//		'spacious[global_sidebar_layout_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			$spacious_themename . 'global_sidebar_layout_heading',
//			array(
//				'label'    => esc_html__( 'Sidebar Layout', 'spacious' ),
//				'section'  => 'spacious_global_layout_section',
//				'settings' => 'spacious[global_sidebar_layout_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_default_layout]',
//		array(
//			'default'           => 'right_sidebar',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_default_layout]',
//			array(
//				'type'     => 'radio',
//				'label'    => esc_html__( 'Default layout', 'spacious' ),
//				'section'  => 'spacious_global_layout_section',
//				'settings' => $spacious_themename . '[spacious_default_layout]',
//				'choices'  => array(
//					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
//					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
//					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
//					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
//					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
//				),
//			)
//		)
//	);

////	// default layout for pages.
////	$wp_customize->add_setting(
////		$spacious_themename . '[spacious_pages_default_layout]',
////		array(
////			'default'           => 'right_sidebar',
////			'type'              => 'option',
////			'capability'        => 'edit_theme_options',
////			'sanitize_callback' => 'spacious_radio_select_sanitize',
////		) );
//
//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_pages_default_layout]',
//			array(
//				'type'     => 'radio',
//				'label'    => esc_html__( 'Default layout for pages only', 'spacious' ),
//				'section'  => 'spacious_global_layout_section',
//				'settings' => $spacious_themename . '[spacious_pages_default_layout]',
//				'choices'  => array(
//					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
//					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
//					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
//					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
//					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
//				),
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_single_posts_default_layout]',
//		array(
//			'default'           => 'right_sidebar',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_single_posts_default_layout]',
//			array(
//				'type'     => 'radio',
//				'label'    => esc_html__( 'Default layout for single posts only', 'spacious' ),
//				'section'  => 'spacious_global_layout_section',
//				'settings' => $spacious_themename . '[spacious_single_posts_default_layout]',
//				'choices'  => array(
//					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
//					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
//					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
//					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
//					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
//				),
//			)
//		)
//	);

	/****************************************Start of the Header Options****************************************/
	// Header Options Area
//	$wp_customize->add_panel( 'spacious_header_options', array(
//		'capabitity' => 'edit_theme_options',
//		'priority'   => 50,
//		'title'      => esc_html__( 'Header', 'spacious' ),
//	) );

//	$wp_customize->get_section( 'title_tagline' )->panel    = 'spacious_header_options';
//	$wp_customize->get_section( 'title_tagline' )->priority = 2;

//	$wp_customize->add_setting(
//		'spacious[site_logo_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'site_logo_heading',
//			array(
//				'label'    => esc_html__( 'Site Logo', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[site_logo_heading]',
//				'priority' => 1,
//			)
//		)
//	);

//	// Retina Logo Option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_different_retina_logo]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_different_retina_logo]',
//		array(
//			'type'     => 'checkbox',
//			'priority' => 8,
//			'label'    => esc_html__( 'Different Logo for Retina Devices?', 'spacious' ),
//			'section'  => 'title_tagline',
//		)
//	);

	// Retina Logo Upload.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_retina_logo_upload]',
//		array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'esc_url_raw',
//		)
//	);

//	$wp_customize->add_control(
//		new WP_Customize_Image_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_retina_logo_upload]',
//			array(
//				'label'           => esc_html__( 'Retina Logo', 'spacious' ),
//				'description'     => esc_html__( 'Please upload the retina logo double the size of logo. For eg: If you upload 100 * 100 pixels for logo then use 200 * 200 pixels for retina logo.', 'spacious' ),
//				'priority'        => 8,
//				'setting'         => 'spacious[spacious_retina_logo_upload]',
//				'section'         => 'title_tagline',
//				'active_callback' => 'spacious_retina_logo_option',
//			)
//		)
//	);

	// Heading for Site Icon.
//	$wp_customize->add_setting(
//		'spacious[site_icon_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'site_icon_heading',
//			array(
//				'label'    => esc_html__( 'Site icon', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[site_icon_heading]',
//				'priority' => 8,
//			)
//		)
//	);

//	$wp_customize->get_control( 'site_icon' )->priority = 9;
//
//	// Heading for Site Title.
//	$wp_customize->add_setting(
//		'spacious[site_title_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'site_title_heading',
//			array(
//				'label'    => esc_html__( 'Site Title', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[site_title_heading]',
//				'priority' => 9,
//			)
//		)
//	);

//	$wp_customize->get_control( 'blogname' )->priority = 10;

	// Heading for Site Tagline.
//	$wp_customize->add_setting(
//		'spacious[site_tagline_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'site_tagline_heading',
//			array(
//				'label'    => esc_html__( 'Site Tagline', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[site_tagline_heading]',
//				'priority' => 10,
//			)
//		)
//	);
//
//	$wp_customize->get_control( 'blogdescription' )->priority = 11;

//	// Heading for logo and header text Visibility.
//	$wp_customize->add_setting(
//		'spacious[logo_text_visibility_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'logo_text_visibility_heading',
//			array(
//				'label'    => esc_html__( 'Visibility', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[logo_text_visibility_heading]',
//				'priority' => 14,
//			)
//		)
//	);

//	$wp_customize->get_control( 'display_header_text' )->section  = 'title_tagline';
//	$wp_customize->get_control( 'display_header_text' )->priority = 15;

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_show_header_logo_text]',
//		array(
//			'default'           => 'text_only',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_show_header_logo_text]',
//		array(
//			'priority' => 15,
//			'type'     => 'radio',
//			'label'    => esc_html__( 'Choose the option that you want.', 'spacious' ),
//			'section'  => 'title_tagline',
//			'choices'  => array(
//				'logo_only' => esc_html__( 'Header Logo Only', 'spacious' ),
//				'text_only' => esc_html__( 'Header Text Only', 'spacious' ),
//				'both'      => esc_html__( 'Show Both', 'spacious' ),
//				'none'      => esc_html__( 'Disable', 'spacious' ),
//			),
//		)
//	);

	// Heading for header text color.
//	$wp_customize->add_setting(
//		'spacious[header_text_color_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_text_color_heading',
//			array(
//				'label'    => esc_html__( 'Colors', 'spacious' ),
//				'section'  => 'title_tagline',
//				'settings' => 'spacious[header_text_color_heading]',
//				'priority' => 16,
//			)
//		)
//	);

//	$wp_customize->get_control( 'header_textcolor' )->section  = 'title_tagline';
//	$wp_customize->get_control( 'header_textcolor' )->priority = 20;
//
//	// Header media options.
//	$wp_customize->get_section( 'header_image' )->panel    = 'spacious_header_options';
//	$wp_customize->get_section( 'header_image' )->priority = 2;

//	// Header image position title heading.
//	$wp_customize->add_setting(
//		'spacious[header_image_position_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_image_position_heading',
//			array(
//				'label'    => esc_html__( 'Header Image Position', 'spacious' ),
//				'section'  => 'header_image',
//				'settings' => 'spacious[header_image_position_heading]',
//				'priority' => 20,
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_image_position]',
//		array(
//			'default'           => 'above',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_image_position]',
//		array(
//			'priority' => 20,
//			'type'     => 'radio',
//			'label'    => esc_html__( 'Choose top header image display position.', 'spacious' ),
//			'section'  => 'header_image',
//			'choices'  => array(
//				'above' => esc_html__( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
//				'below' => esc_html__( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' ),
//			),
//		)
//	);

//	// Header Top bar activate option
//	$wp_customize->add_section(
//		'spacious_header_top_bar',
//		array(
//			'priority' => 2,
//			'title'    => esc_html__( 'Top Bar', 'spacious' ),
//			'panel'    => 'spacious_header_options',
//		)
//	);
//
//	// Heading for Activate top bar.
//	$wp_customize->add_setting(
//		'spacious[header_top_bar_active_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_top_bar_active_heading',
//			array(
//				'label'    => esc_html__( 'Activate Header Top Bar', 'spacious' ),
//				'section'  => 'spacious_header_top_bar',
//				'settings' => 'spacious[header_top_bar_active_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting( $spacious_themename . '[spacious_activate_top_header_bar]', array(
//		'default'           => 0,
//		'type'              => 'option',
//		'capability'        => 'edit_theme_options',
//		'sanitize_callback' => 'spacious_checkbox_sanitize',
//	) );
//
//	$wp_customize->add_control( $spacious_themename . '[spacious_activate_top_header_bar]', array(
//		'type'     => 'checkbox',
//		'label'    => esc_html__( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'spacious' ),
//		'section'  => 'spacious_header_top_bar',
//		'settings' => $spacious_themename . '[spacious_activate_top_header_bar]',
//	) );

	// Heading for header info text.
//	$wp_customize->add_setting(
//		'spacious[header_info_text_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_info_text_heading',
//			array(
//				'label'    => esc_html__( 'Header Info Text', 'spacious' ),
//				'section'  => 'spacious_header_top_bar',
//				'settings' => 'spacious[header_info_text_heading]',
//				'priority' => 10,
//			)
//		)
//	);

	// Header area small text option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_info_text]',
//		array(
//			'default'           => '',
//			'type'              => 'option',
//			'transport'         => $customizer_selective_refresh,
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_editor_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Editor_Custom_Control(
//			$wp_customize, $spacious_themename . '[spacious_header_info_text]',
//			array(
//				'label'   => esc_html__( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'spacious' ),
//				'section' => 'spacious_header_top_bar',
//				'setting' => $spacious_themename . '[spacious_header_info_text]',
//			)
//		)
//	);

//	// Register `SPACIOUS_Upsell_Section` type section.
//	$wp_customize->register_section_type( 'SPACIOUS_Upsell_Section' );
//
//	// Add `SPACIOUS_Upsell_Section` to display pro link.
//	$wp_customize->add_section(
//		new SPACIOUS_Upsell_Section( $wp_customize, 'spacious_upsell_section',
//			array(
//				'title'      => esc_html__( 'View PRO version', 'spacious' ),
//				'url'        => 'https://themegrill.com/spacious-pricing/?utm_source=spacious-customizer&utm_medium=view-pricing-link&utm_campaign=upgrade',
//				'capability' => 'edit_theme_options',
//				'priority'   => 1,
//			)
//		)
//	);
	// Selective refresh for header information text
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( $spacious_themename . '[spacious_header_info_text]', array(
			'selector'        => '.small-info-text p',
			'render_callback' => 'spacious_header_info_text',
		) );
	}

	// Primary Header section.
//	$wp_customize->add_section(
//		'spacious_header_main',
//		array(
//			'priority' => 2,
//			'title'    => esc_html__( 'Primary Header', 'spacious' ),
//			'panel'    => 'spacious_header_options',
//		)
//	);

	// Heading for header display.
//	$wp_customize->add_setting(
//		'spacious[header_display_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_display_heading',
//			array(
//				'label'    => esc_html__( 'Header Display Type', 'spacious' ),
//				'section'  => 'spacious_header_main',
//				'settings' => 'spacious[header_display_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_display_type]',
//		array(
//			'default'           => 'one',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control(
//			$wp_customize, $spacious_themename . '[spacious_header_display_type]',
//			array(
//				'type'     => 'radio',
//				'label'    => esc_html__( 'Choose the header display type that you want.', 'spacious' ),
//				'section'  => 'spacious_header_main',
//				'settings' => $spacious_themename . '[spacious_header_display_type]',
//				'choices'  => array(
//					'one'  => SPACIOUS_ADMIN_IMAGES_URL . '/header-left.png',
//					'four' => SPACIOUS_ADMIN_IMAGES_URL . '/menu-bottom.png',
//				),
//			)
//		)
//	);

//	// Primary menu section.
//	$wp_customize->add_section(
//		'spacious_header_primary_menu',
//		array(
//			'priority' => 2,
//			'title'    => esc_html__( 'Primary Menu', 'spacious' ),
//			'panel'    => 'spacious_header_options',
//		)
//	);

	// Heading for search icon.
//	$wp_customize->add_setting(
//		'spacious[header_primary_menu_search]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);

//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_primary_menu_display_type',
//			array(
//				'label'    => esc_html__( 'Search Icon', 'spacious' ),
//				'section'  => 'spacious_header_primary_menu',
//				'settings' => 'spacious[header_primary_menu_search]',
//			)
//		)
//	);

	// Search icon.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_search_icon]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		) );
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_search_icon]',
//		array(
//			'type'    => 'checkbox',
//			'label'   => esc_html__( 'Show search icon in header.', 'spacious' ),
//			'section' => 'spacious_header_primary_menu',
//		)
//	);

	// Heading for menu display.
//	$wp_customize->add_setting(
//		'spacious[header_primary_menu_display]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_primary_menu_display',
//			array(
//				'label'    => esc_html__( 'Menu Display', 'spacious' ),
//				'section'  => 'spacious_header_primary_menu',
//				'settings' => 'spacious[header_primary_menu_display]',
//			)
//		)
//	);

//	// Display menu in one line.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_one_line_menu_setting]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_one_line_menu_setting]',
//		array(
//			'type'    => 'checkbox',
//			'label'   => esc_html__( 'Display menu in one line', 'spacious' ),
//			'section' => 'spacious_header_primary_menu',
//			'setting' => $spacious_themename . '[spacious_one_line_menu_setting]',
//		)
//	);
//
//	// Heading for responsive menu.
//	$wp_customize->add_setting(
//		'spacious[header_primary_menu_responsive_style]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_primary_menu_responsive_style',
//			array(
//				'label'    => esc_html__( 'Responsive Menu Style', 'spacious' ),
//				'section'  => 'spacious_header_primary_menu',
//				'settings' => 'spacious[header_primary_menu_responsive_style]',
//			)
//		)
//	);

	// Responsive collapse menu
//	$wp_customize->add_setting( $spacious_themename . '[spacious_new_menu]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_new_menu]',
//		array(
//			'type'    => 'checkbox',
//			'label'   => esc_html__( 'Switch to new responsive menu.', 'spacious' ),
//			'section' => 'spacious_header_primary_menu',
//		)
//	);

//	// Header Button option.
//	$wp_customize->add_section( 'spacious_header_button', array(
//		'priority' => 4,
//		'title'    => esc_html__( 'Header Button', 'spacious' ),
//		'panel'    => 'spacious_header_options',
//	) );
//
//	// Heading for header button one.
//	$wp_customize->add_setting(
//		'spacious[header_button_one_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_button_one_heading',
//			array(
//				'label'    => esc_html__( 'Header Button One', 'spacious' ),
//				'section'  => 'spacious_header_button',
//				'settings' => 'spacious[header_button_one_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_button_one_setting]',
//		array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'wp_filter_nohtml_kses',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_button_one_setting]',
//		array(
//			'label'   => esc_html__( 'Button Text', 'spacious' ),
//			'section' => 'spacious_header_button',
//			'setting' => $spacious_themename . '[spacious_header_button_one_setting]',
//		)
//	);
//
//	// Header button link.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_button_one_link]',
//		array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'esc_url_raw',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_button_one_link]',
//		array(
//			'label'   => esc_html__( 'Button Link', 'spacious' ),
//			'section' => 'spacious_header_button',
//			'setting' => $spacious_themename . '[spacious_header_button_one_link]',
//		)
//	);

	// Header button link in new tab.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_button_one_tab]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_button_one_tab]',
//		array(
//			'type'    => 'checkbox',
//			'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
//			'section' => 'spacious_header_button',
//			'setting' => $spacious_themename . '[spacious_header_button_one_tab]',
//		)
//	);

	// End of Header Options

	/****************************************Start of the Slider Options****************************************/
//	$wp_customize->add_section(
//		'spacious_slider_options',
//		array(
//			'capabitity' => 'edit_theme_options',
//			'priority'   => 55,
//			'title'      => esc_html__( 'Slider', 'spacious' ),
//		)
//	);

//	// Heading for slider activation.
//	$wp_customize->add_setting(
//		'spacious[slider_activate_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'slider_activate_heading',
//			array(
//				'label'    => esc_html__( 'Activate slider', 'spacious' ),
//				'section'  => 'spacious_slider_options',
//				'settings' => 'spacious[slider_activate_heading]',
//			)
//		)
//	);

//	// Slider activate option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_activate_slider]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_activate_slider]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to activate slider.', 'spacious' ),
//			'section'  => 'spacious_slider_options',
//			'settings' => $spacious_themename . '[spacious_activate_slider]',
//		)
//	);

	// Selective refresh for slider activate
//	if ( isset( $wp_customize->selective_refresh ) ) {
//		$wp_customize->selective_refresh->add_partial( $spacious_themename . '[spacious_activate_slider]', array(
//			'selector'        => '#featured-slider',
//			'render_callback' => '',
//		) );
//	}

	// Heading for slider status.
//	$wp_customize->add_setting(
//		'spacious[slider_status_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'slider_status_heading',
//			array(
//				'label'    => esc_html__( 'Disable slider in Posts page', 'spacious' ),
//				'section'  => 'spacious_slider_options',
//				'settings' => 'spacious[slider_status_heading]',
//			)
//		)
//	);

	// Disable slider in blog page.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_blog_slider]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_blog_slider]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to disable slider in Posts Page', 'spacious' ),
//			'section'  => 'spacious_slider_options',
//			'settings' => $spacious_themename . '[spacious_blog_slider]',
//		)
//	);

//	for ( $i = 1; $i <= 5; $i++ ) {
//		// Heading for Image upload.
////		$wp_customize->add_setting(
////			'spacious[slider_image_upload_heading' . $i . ' ]',
////			array(
////				'sanitize_callback' => false,
////			)
////		);
////
////		$wp_customize->add_control(
////			new Spacious_Heading_Control(
////				$wp_customize,
////				'spacious[slider_image_upload_heading' . $i . ' ]',
////				array(
////					'label'   => sprintf( esc_html__( 'Slider Content #%1$s', 'spacious' ), $i ),
////					'section' => 'spacious_slider_options',
////					'setting' => 'spacious[slider_image_upload_heading' . $i . ']',
////				)
////			)
////		);
//
//		// adding slider image url
//		$wp_customize->add_setting(
//			$spacious_themename . '[spacious_slider_image' . $i . ']',
//			array(
//				'default'           => '',
//				'type'              => 'option',
//				'capability'        => 'edit_theme_options',
//				'sanitize_callback' => 'esc_url_raw',
//			)
//		);
//
//		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $spacious_themename . '[spacious_slider_image' . $i . ']', array(
//			'label'   => __( 'Upload slider image.', 'spacious' ),
//			'section' => 'spacious_slider_options',
//			'setting' => $spacious_themename . '[spacious_slider_image' . $i . ']',
//		) ) );
//
//		// adding slider title
//		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_title' . $i . ']', array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'wp_filter_nohtml_kses',
//		) );
//
//		$wp_customize->add_control( $spacious_themename . '[spacious_slider_title' . $i . ']', array(
//			'label'   => __( 'Enter title for your slider.', 'spacious' ),
//			'section' => 'spacious_slider_options',
//			'setting' => $spacious_themename . '[spacious_slider_title' . $i . ']',
//		) );
//
//		// adding slider description
//		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_text' . $i . ']', array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_text_sanitize',
//		) );
//
//		$wp_customize->add_control( new Spacious_Text_Area_Control( $wp_customize, $spacious_themename . '[spacious_slider_text' . $i . ']', array(
//			'label'   => __( 'Enter your slider description.', 'spacious' ),
//			'section' => 'spacious_slider_options',
//			'setting' => $spacious_themename . '[spacious_slider_text' . $i . ']',
//		) ) );
//
//		// adding slider button text
//		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_button_text' . $i . ']', array(
//			'default'           => __( 'Read more', 'spacious' ),
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'wp_filter_nohtml_kses',
//		) );
//
//		$wp_customize->add_control( $spacious_themename . '[spacious_slider_button_text' . $i . ']', array(
//			'label'   => __( 'Enter the button text. Default is "Read more"', 'spacious' ),
//			'section' => 'spacious_slider_options',
//			'setting' => $spacious_themename . '[spacious_slider_button_text' . $i . ']',
//		) );
//
//		// adding button url
//		$wp_customize->add_setting( $spacious_themename . '[spacious_slider_link' . $i . ']', array(
//			'default'           => '',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'esc_url_raw',
//		) );
//
//		$wp_customize->add_control( $spacious_themename . '[spacious_slider_link' . $i . ']', array(
//			'label'   => __( 'Enter link to redirect slider when clicked', 'spacious' ),
//			'section' => 'spacious_slider_options',
//			'setting' => $spacious_themename . '[spacious_slider_link' . $i . ']',
//		) );
//	}
	// End of Slider Options

//	// Content Options.
//	$wp_customize->add_panel(
//		'spacious_content_options',
//		array(
//			'capabitity' => 'edit_theme_options',
//			'priority'   => 60,
//			'title'      => esc_html__( 'Content', 'spacious' ),
//		)
//	);

//	$wp_customize->add_section(
//		'spacious_post_page_content_options',
//		array(
//			'title' => esc_html__( 'Page Header', 'spacious' ),
//			'panel' => 'spacious_content_options',
//		)
//	);

//	// Heading for header title
//	$wp_customize->add_setting(
//		'spacious[header_title_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'header_title_heading',
//			array(
//				'label'    => esc_html__( 'Header Title', 'spacious' ),
//				'section'  => 'spacious_post_page_content_options',
//				'settings' => 'spacious[header_title_heading]',
//			)
//		)
//	);

	/**
	 * Title header options
	 */
//	$wp_customize->add_section(
//		'spacious_post_page_content_options',
//		array(
//			'title' => esc_html__( 'Page Header', 'spacious' ),
//			'panel' => 'spacious_content_options',
//		)
//	);
//
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_header_title_hide]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_header_title_hide]',
//		array(
//			'type'    => 'checkbox',
//			'label'   => esc_html__( 'Hide page/post header title', 'spacious' ),
//			'section' => 'spacious_post_page_content_options',
//		)
//	);

//	$wp_customize->add_section(
//		'spacious_blog_content_options',
//		array(
//			'title' => esc_html__( 'Blog/Archive', 'spacious' ),
//			'panel' => 'spacious_content_options',
//		)
//	);

	// Heading for blog display.
//	$wp_customize->add_setting(
//		'spacious[blog_post_display_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'blog_post_display_heading',
//			array(
//				'label'    => esc_html__( 'Blog Posts display type', 'spacious' ),
//				'section'  => 'spacious_blog_content_options',
//				'settings' => 'spacious[blog_post_display_heading]',
//			)
//		)
//	);

	// blog posts display type setting
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_archive_display_type]',
//		array(
//			'default'           => 'blog_large',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);

//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_archive_display_type]',
//		array(
//			'type'    => 'radio',
//			'label'   => esc_html__( 'Choose the display type for the latests posts view or posts page view (static front page).', 'spacious' ),
//			'choices' => array(
//				'blog_large'            => esc_html__( 'Blog Image Large', 'spacious' ),
//				'blog_medium'           => esc_html__( 'Blog Image Medium', 'spacious' ),
//				'blog_medium_alternate' => esc_html__( 'Blog Image Alternate Medium', 'spacious' ),
//				'blog_full_content'     => esc_html__( 'Blog Full Content', 'spacious' ),
//			),
//			'section' => 'spacious_blog_content_options',
//		)
//	);

	// Single Post section.
//	$wp_customize->add_section(
//		'spacious_single_post_section',
//		array(
//			'title' => esc_html__( 'Single Post', 'spacious' ),
//			'panel' => 'spacious_content_options',
//		)
//	);

	// Heading for Author bio.
//	$wp_customize->add_setting(
//		'spacious[author_bio_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'author_bio_heading',
//			array(
//				'label'    => esc_html__( 'Author Bio', 'spacious' ),
//				'section'  => 'spacious_single_post_section',
//				'settings' => 'spacious[author_bio_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_author_bio]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_author_bio]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to enable the author bio section just below the post.', 'spacious' ),
//			'section'  => 'spacious_single_post_section',
//			'settings' => $spacious_themename . '[spacious_author_bio]',
//		)
//	);

	// Heading for single post featured image.
//	$wp_customize->add_setting(
//		'spacious[featured_image_single_post_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'featured_image_single_post_heading',
//			array(
//				'label'    => esc_html__( 'Featured Image In Single Post Page', 'spacious' ),
//				'section'  => 'spacious_single_post_section',
//				'settings' => 'spacious[featured_image_single_post_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_featured_image_single_post_page]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_featured_image_single_post_page]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to enable the featured image in single post page.', 'spacious' ),
//			'section'  => 'spacious_single_post_section',
//			'settings' => $spacious_themename . '[spacious_featured_image_single_post_page]',
//		)
//	);

	// Heading for related post.
//	$wp_customize->add_setting(
//		'spacious[related_post_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'related_post_heading',
//			array(
//				'label'    => esc_html__( 'Related Posts', 'spacious' ),
//				'section'  => 'spacious_single_post_section',
//				'settings' => 'spacious[related_post_heading]',
//			)
//		)
//	);

//	//Related post
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_related_posts_activate]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_related_posts_activate]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to activate the related posts', 'spacious' ),
//			'section'  => 'spacious_single_post_section',
//			'settings' => $spacious_themename . '[spacious_related_posts_activate]',
//		)
//	);
//
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_related_posts]',
//		array(
//			'default'           => 'categories',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_select_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_related_posts]',
//		array(
//			'type'     => 'radio',
//			'label'    => esc_html__( 'Related Posts Must Be Shown As:', 'spacious' ),
//			'section'  => 'spacious_single_post_section',
//			'settings' => $spacious_themename . '[spacious_related_posts]',
//			'choices'  => array(
//				'categories' => esc_html__( 'Related Posts By Categories', 'spacious' ),
//				'tags'       => esc_html__( 'Related Posts By Tags', 'spacious' ),
//			),
//		)
//	);

	// Page section.
//	$wp_customize->add_section(
//		'spacious_page_section',
//		array(
//			'title' => esc_html__( 'Page', 'spacious' ),
//			'panel' => 'spacious_content_options',
//		)
//	);

	// Heading for featured image in page.
//	$wp_customize->add_setting(
//		'spacious[featured_image_page_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'featured_image_page_heading',
//			array(
//				'label'    => esc_html__( 'Featured Image in Single Page', 'spacious' ),
//				'section'  => 'spacious_page_section',
//				'settings' => 'spacious[featured_image_page_heading]',
//			)
//		)
//	);

	// Featured image in single page activate option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_featured_image_single_page]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_featured_image_single_page]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to enable the featured image in single page.', 'spacious' ),
//			'section'  => 'spacious_page_section',
//			'settings' => $spacious_themename . '[spacious_featured_image_single_page]',
//		)
//	);

	/*************************************Start of the Social Links Options*************************************/

//	$wp_customize->add_section(
//		'spacious_social_links_options',
//		array(
//			'capabitity' => 'edit_theme_options',
//			'priority'   => 75,
//			'title'      => esc_html__( 'Social Links', 'spacious' ),
//		)
//	);

	// Heading for social link activation.
//	$wp_customize->add_setting(
//		'spacious[social_link_activation_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'social_link_activation_heading',
//			array(
//				'label'    => esc_html__( 'Activate social links area', 'spacious' ),
//				'section'  => 'spacious_social_links_options',
//				'settings' => 'spacious[social_link_activation_heading]',
//			)
//		)
//	);

	// Social links activate option.
//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_activate_social_links]',
//		array(
//			'default'           => 0,
//			'type'              => 'option',
//			'transport'         => $customizer_selective_refresh,
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_checkbox_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		$spacious_themename . '[spacious_activate_social_links]',
//		array(
//			'type'     => 'checkbox',
//			'label'    => esc_html__( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'spacious' ),
//			'section'  => 'spacious_social_links_options',
//			'settings' => $spacious_themename . '[spacious_activate_social_links]',
//		)
//	);

	// Selective refresh for social links enable
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			$spacious_themename . '[spacious_activate_social_links]',
			array(
				'selector'        => '.social-links',
				'render_callback' => '',
			)
		);
	}

	// Heading for social icon.
//	$wp_customize->add_setting(
//		'spacious[social_icon_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'social_icon_heading',
//			array(
//				'label'    => esc_html__( 'Social Icon', 'spacious' ),
//				'section'  => 'spacious_social_links_options',
//				'settings' => 'spacious[social_icon_heading]',
//			)
//		)
//	);

//	$spacious_social_links = array(
//		'spacious_social_facebook'  => esc_html__( 'Facebook', 'spacious' ),
//		'spacious_social_twitter'   => esc_html__( 'Twitter', 'spacious' ),
//		'spacious_social_instagram' => esc_html__( 'Instagram', 'spacious' ),
//		'spacious_social_linkedin'  => esc_html__( 'LinkedIn', 'spacious' ),
//	);
//
//	$i = 1;
//	foreach ( $spacious_social_links as $key => $value ) {
//
//		// adding social sites link
//		$wp_customize->add_setting( $spacious_themename . '[' . $key . ']',
//			array(
//				'default'           => '',
//				'type'              => 'option',
//				'capability'        => 'edit_theme_options',
//				'sanitize_callback' => 'esc_url_raw',
//			)
//		);
//
//		$wp_customize->add_control(
//			$spacious_themename . '[' . $key . ']',
//			array(
//				'label'   => sprintf( esc_html__( 'Add link for %1$s', 'spacious' ), $value ),
//				'section' => 'spacious_social_links_options',
//				'setting' => $spacious_themename . '[' . $key . ']',
//			)
//		);
//
//		// adding social open in new page tab setting
//		$wp_customize->add_setting(
//			$spacious_themename . '[' . $key . 'new_tab]',
//			array(
//				'default'           => 0,
//				'type'              => 'option',
//				'capability'        => 'edit_theme_options',
//				'sanitize_callback' => 'spacious_checkbox_sanitize',
//			)
//		);
//
//		$wp_customize->add_control(
//			$spacious_themename . '[' . $key . 'new_tab]',
//			array(
//				'type'    => 'checkbox',
//				'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
//				'section' => 'spacious_social_links_options',
//				'setting' => $spacious_themename . '[' . $key . 'new_tab]',
//			)
//		);
//
//		// divider for social link activation.
//		$wp_customize->add_setting(
//			'spacious[' . $key . '_additional]',
//			array(
//				'sanitize_callback' => false,
//			)
//		);
//
//		$wp_customize->add_control(
//			new Spacious_Divider_Control(
//				$wp_customize,
//				'spacious[' . $key . '_additional]',
//				array(
//					'section'  => 'spacious_social_links_options',
//					'settings' => 'spacious[' . $key . '_additional]',
//				)
//			)
//		);
//
//		$i++;
//
//	}

	/****************************************Start of the Footer Options****************************************/

//	$wp_customize->add_panel(
//		'spacious_footer_options',
//		array(
//			'capabitity' => 'edit_theme_options',
//			'priority'   => 65,
//			'title'      => esc_html__( 'Footer', 'spacious' ),
//		)
//	);

	// Footer widgets select type
//	$wp_customize->add_section(
//		'spacious_footer_widgets_area_section',
//		array(
//			'priority' => 5,
//			'title'    => esc_html__( 'Footer Widgets Area', 'spacious' ),
//			'panel'    => 'spacious_footer_options',
//		)
//	);

	// Heading for footer widget column options.
//	$wp_customize->add_setting(
//		'spacious[footer_widget_column_heading]',
//		array(
//			'sanitize_callback' => false,
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Heading_Control(
//			$wp_customize,
//			'footer_widget_column_heading',
//			array(
//				'label'    => esc_html__( 'Footer Widgets Column', 'spacious' ),
//				'section'  => 'spacious_footer_widgets_area_section',
//				'settings' => 'spacious[footer_widget_column_heading]',
//			)
//		)
//	);

//	$wp_customize->add_setting(
//		$spacious_themename . '[spacious_footer_widget_column_select_type]',
//		array(
//			'default'           => 'four',
//			'type'              => 'option',
//			'capability'        => 'edit_theme_options',
//			'sanitize_callback' => 'spacious_radio_sanitize',
//		)
//	);
//
//	$wp_customize->add_control(
//		new Spacious_Image_Radio_Control(
//			$wp_customize,
//			$spacious_themename . '[spacious_footer_widget_column_select_type]',
//			array(
//				'label'   => esc_html__( 'Choose the number of column for the footer widgetized areas.', 'spacious' ),
//				'choices' => array(
//					'one'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
//					'two'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
//					'three' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
//					'four'  => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
//				),
//				'section' => 'spacious_footer_widgets_area_section',
//			)
//		)
//	);
	// End of footer options.

	/**************************************Start of the WooCommerce Options*************************************/
//	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
//
//		// woocommerce archive page layout.
////		$wp_customize->add_section(
////			'spacious_woocommerce_page_layout_setting',
////			array(
////				'priority' => 1,
////				'title'    => esc_html__( 'Sidebar', 'spacious' ),
////				'panel'    => 'woocommerce',
////			)
////		);
//
//		// Heading for Woocommerce sidebar layout.
////		$wp_customize->add_setting(
////			'spacious[woocommerce_sidebar_layout_heading]',
////			array(
////				'sanitize_callback' => false,
////			)
////		);
////
////		$wp_customize->add_control(
////			new Spacious_Heading_Control(
////				$wp_customize,
////				'woocommerce_sidebar_layout_heading',
////				array(
////					'label'    => esc_html__( 'Archive Page Layout', 'spacious' ),
////					'section'  => 'spacious_woocommerce_page_layout_setting',
////					'settings' => 'spacious[woocommerce_sidebar_layout_heading]',
////				)
////			)
////		);
//
////		// woocommerce archive page layout.
////		$wp_customize->add_setting( $spacious_themename . '[spacious_woo_archive_layout]', array(
////			'default'           => 'no_sidebar_full_width',
////			'type'              => 'option',
////			'capability'        => 'edit_theme_options',
////			'sanitize_callback' => 'spacious_radio_sanitize',
////		) );
//
////		$wp_customize->add_control(
////			new Spacious_Image_Radio_Control(
////				$wp_customize, $spacious_themename . '[spacious_woo_archive_layout]',
////				array(
////					'type'     => 'radio',
////					'label'    => esc_html__( 'This layout will be reflected in woocommerce archive page only.', 'spacious' ),
////					'section'  => 'spacious_woocommerce_page_layout_setting',
////					'settings' => $spacious_themename . '[spacious_woo_archive_layout]',
////					'choices'  => array(
////						'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
////						'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
////						'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
////						'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
////					),
////				)
////			)
////		);
//
//		// Heading for Woocommerce product page layout.
////		$wp_customize->add_setting(
////			'spacious[woocommerce_product_sidebar_layout_heading]',
////			array(
////				'sanitize_callback' => false,
////			)
////		);
////
////		$wp_customize->add_control(
////			new Spacious_Heading_Control(
////				$wp_customize,
////				'woocommerce_product_sidebar_layout_heading',
////				array(
////					'label'    => esc_html__( 'Product Page Layout', 'spacious' ),
////					'section'  => 'spacious_woocommerce_page_layout_setting',
////					'settings' => 'spacious[woocommerce_product_sidebar_layout_heading]',
////				)
////			)
////		);
//
////		// WooCommerce product page layout.
////		$wp_customize->add_setting(
////			$spacious_themename . '[spacious_woo_product_layout]',
////			array(
////				'default'           => 'no_sidebar_full_width',
////				'type'              => 'option',
////				'capability'        => 'edit_theme_options',
////				'sanitize_callback' => 'spacious_radio_sanitize',
////			)
////		);
////
////		$wp_customize->add_control(
////			new Spacious_Image_Radio_Control(
////				$wp_customize, $spacious_themename . '[spacious_woo_product_layout]',
////				array(
////					'type'     => 'radio',
////					'label'    => esc_html__( 'This layout will be reflected in woocommerce Product page.', 'spacious' ),
////					'section'  => 'spacious_woocommerce_page_layout_setting',
////					'settings' => $spacious_themename . '[spacious_woo_product_layout]',
////					'choices'  => array(
////						'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
////						'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
////						'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
////						'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
////					),
////				)
////			)
////		);
//
//		// Woocommerce sale design.
//		$wp_customize->add_section(
//			'spacious_woocommerce_button_design',
//			array(
//				'priority' => 2,
//				'title'    => esc_html__( 'Design', 'spacious' ),
//				'panel'    => 'woocommerce',
//			)
//		);
//
//		// Heading for Woocommerce cart icon.
//		$wp_customize->add_setting(
//			'spacious[woocommerce_cart_icon_heading]',
//			array(
//				'sanitize_callback' => false,
//			)
//		);
//
//		$wp_customize->add_control(
//			new Spacious_Heading_Control(
//				$wp_customize,
//				'woocommerce_cart_icon_heading',
//				array(
//					'label'    => esc_html__( 'Cart Icon', 'spacious' ),
//					'section'  => 'spacious_woocommerce_button_design',
//					'settings' => 'spacious[woocommerce_cart_icon_heading]',
//				)
//			)
//		);
//
//		// Setting: WooCommerce cart icon.
//		$wp_customize->add_setting(
//			$spacious_themename . '[spacious_cart_icon]',
//			array(
//				'default'           => 0,
//				'type'              => 'option',
//				'capability'        => 'edit_theme_options',
//				'sanitize_callback' => 'spacious_checkbox_sanitize',
//			)
//		);
//
//		$wp_customize->add_control(
//			$spacious_themename . '[spacious_cart_icon]',
//			array(
//				'type'     => 'checkbox',
//				'label'    => esc_html__( 'Check to show WooCommerce cart icon on menu bar', 'spacious' ),
//				'section'  => 'spacious_woocommerce_button_design',
//				'settings' => $spacious_themename . '[spacious_cart_icon]',
//			)
//		);
//
//	}
	// End of the WooCommerce Options.

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

//	// checkbox sanitize
//	function spacious_checkbox_sanitize( $input ) {
//		if ( $input == 1 ) {
//			return 1;
//		} else {
//			return '';
//		}
//	}

//	// Google Font Sanitization
//	function spacious_font_sanitize( $input ) {
//		$spacious_standard_fonts_array = spacious_standard_fonts_array();
//		$spacious_google_fonts         = spacious_google_fonts();
//		$valid_keys                    = array_merge( $spacious_standard_fonts_array, $spacious_google_fonts );
//
//		if ( array_key_exists( $input, $valid_keys ) ) {
//			return $input;
//		} else {
//			return '';
//		}
//	}

	// editor sanitization
//	function spacious_editor_sanitize( $input ) {
//		if ( isset( $input ) ) {
//			$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
//		}
//
//		return $input;
//	}
//
//	// Radio and Select Sanitization
//	function spacious_radio_sanitize( $input, $setting ) {
//		// Ensure input is a slug.
//		$input = sanitize_key( $input );
//
//		// Get list of choices from the control associated with the setting.
//		$choices = $setting->manager->get_control( $setting->id )->choices;
//
//		// If the input is a valid key, return it; otherwise, return the default.
//		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
//	}

//	// text-area sanitize
//	function spacious_text_sanitize( $input ) {
//		return wp_kses_post( force_balance_tags( $input ) );
//	}

	// color sanitization
//	function spacious_color_option_hex_sanitize( $color ) {
//		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
//			return '#' . $unhashed;
//		}
//
//		return $color;
//	}

	// Active Callback for Retina Logo.
//	function spacious_retina_logo_option() {
//		if ( get_theme_mod( 'spacious_different_retina_logo', 0 ) == 1 ) {
//			return true;
//		}
//
//		return false;
//	}

//	function spacious_color_escaping_option_sanitize( $input ) {
//		$input = esc_attr( $input );
//
//		return $input;
//	}

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

/**
 * Enqueue customize controls scripts.
 */
function spacious_enqueue_customize_controls() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/**
	 * Enqueue required Customize Controls CSS files.
	 */
	// Main CSS file.
	wp_enqueue_style(
		'spacious-customize-controls',
		get_template_directory_uri() . '/css/customize-controls' . $suffix . '.css',
		array(),
		false
	);

}

add_action( 'customize_controls_enqueue_scripts', 'spacious_enqueue_customize_controls' );


/*****************************************************************************************/

if ( ! function_exists( 'spacious_standard_fonts_array' ) ) :

	/**
	 * Standard Fonts array
	 *
	 * @return array of Standarad Fonts
	 */
	function spacious_standard_fonts_array() {
		$spacious_standard_fonts = array(
			'Georgia,Times,"Times New Roman",serif'                                                                                                 => 'serif',
			'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => 'sans-serif',
			'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'                                                   => 'monospace',
		);

		return $spacious_standard_fonts;
	}

endif;
//
//if ( ! function_exists( 'spacious_google_fonts' ) ) :
//
//	/**
//	 * Google Fonts array
//	 *
//	 * @return array of Google Fonts
//	 */
//	function spacious_google_fonts() {
//		$spacious_google_font = array(
//			'Roboto'           => 'Roboto',
//			'Lato'             => 'Lato',
//			'Open Sans'        => 'Open Sans',
//			'Noto Sans'        => 'Noto Sans',
//			'Noto Serif'       => 'Noto Serif',
//			'PT Sans'          => 'PT Sans',
//			'Playfair Display' => 'Playfair Display',
//			'Muli'             => 'Muli',
//			'Montserrat'       => 'Montserrat',
//			'Poppins'          => 'Poppins',
//			'Raleway'          => 'Raleway',
//			'Oswald'           => 'Oswald',
//			'Ubuntu'           => 'Ubuntu',
//			'Nunito'           => 'Nunito',
//		);
//
//		return $spacious_google_font;
//	}
//
//endif;

/* * ************************************************************************************** */

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'spacious_customizer_custom_scripts' );

function spacious_customizer_custom_scripts() {
	?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-spacious_upsell_section h3.accordion-section-title {
			background-color: #0FBE7C !important;
			border-left-color: #04a267;
			color: #fff !important;
			padding: 0;
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
			color: #fff;
			display: block;
			text-decoration: none;
			padding: 12px 15px 15px;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title:hover {
			background-color: #09ad6f !important;
			border-left-color: #04a267 !important;
			color: #fff !important;
		}

		li#accordion-section-spacious_upsell_section h3.accordion-section-title:after {
			color: #fff !important;
		}
	</style>

	<script>
		(
			function ( $, api ) {
				api.sectionConstructor[ 'spacious-upsell-section' ] = api.Section.extend( {

					// No events for this type of section.
					attachEvents : function () {
					},

					// Always make the section active.
					isContextuallyActive : function () {
						return true;
					}
				} );
			}
		)( jQuery, wp.customize );

	</script>
	<?php
}

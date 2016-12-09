<?php
/**
 * Spacious Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.3.4
 */

function spacious_customize_register($wp_customize) {

	// Theme important links started
	class Spacious_Important_Links extends WP_Customize_Control {

		public $type = "spacious-important-links";

		public function render_content() {
			// Add Theme instruction, Support Forum, Demo Link, Rating Link
			$important_links = array(
				'view-pro' => array(
					'link' => esc_url('http://themegrill.com/themes/spacious-pro/'),
					'text' => esc_html__('View Pro', 'spacious'),
				),
				'theme-info' => array(
					'link' => esc_url('http://themegrill.com/themes/spacious/'),
					'text' => esc_html__('Theme Info', 'spacious'),
				),
				'support' => array(
					'link' => esc_url('http://themegrill.com/support-forum/'),
					'text' => esc_html__('Support Forum', 'spacious'),
				),
				'documentation' => array(
					'link' => esc_url('http://docs.themegrill.com/spacious/'),
					'text' => esc_html__('Documentation', 'spacious'),
				),
				'demo' => array(
					'link' => esc_url('http://demo.themegrill.com/spacious/'),
					'text' => esc_html__('View Demo', 'spacious'),
				),
				'rating' => array(
					'link' => esc_url('http://wordpress.org/support/view/theme-reviews/spacious?filter=5'),
					'text' => esc_html__('Rate this theme', 'spacious'),
				),
			);

			foreach ( $important_links as $important_link ) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr( $important_link['text'] ) . ' </a></p>';
			}
		}
	}

	$wp_customize->add_section( 'spacious_important_links', array(
		'priority' => 1,
		'title' => __( 'Spacious Important Links', 'spacious' ),
	) );

   /**
    * This setting has the dummy Sanitization function as it contains no value to be sanitized
    */
   $wp_customize->add_setting('spacious_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_false_sanitize'
   ));

   $wp_customize->add_control(new Spacious_Important_Links($wp_customize, 'important_links', array(
      'section' => 'spacious_important_links',
      'settings' => 'spacious_important_links'
   )));
   // Theme Important Links Ended

   /*
    * Assigning the theme name
    */
   $spacious_themename = get_option( 'stylesheet' );
   $spacious_themename = preg_replace("/\W/", "_", strtolower( $spacious_themename ) );

   // Start of the Header Options
   // Header Options Area
   $wp_customize->add_panel('spacious_header_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 500,
      'title' => __('Header', 'spacious')
   ));

   // Header Logo upload option
   $wp_customize->add_section('spacious_header_logo', array(
      'priority' => 1,
      'title' => __('Header Logo', 'spacious'),
      'panel' => 'spacious_header_options'
   ));

	if ( ! function_exists( 'the_custom_logo' ) ) {
	   $wp_customize->add_setting($spacious_themename.'[spacious_header_logo_image]', array(
	    	'default' => '',
	      	'type' => 'option',
	      	'capability' => 'edit_theme_options',
	      	'sanitize_callback' => 'esc_url_raw'
	   	));

   		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $spacious_themename.'[spacious_header_logo_image]', array(
      		'label' => __('Upload logo for your header. Recommended image size is 100 X 100 pixels.', 'spacious'),
      		'description' => sprintf(__( '%sInfo:%s This option will be removed in upcoming update. Please go to Site Identity section to upload the theme logo.', 'spacious'  ), '<strong>', '</strong>'),
      		'section' => 'spacious_header_logo',
      		'setting' => $spacious_themename.'[spacious_header_logo_image]'
   		)));
	}

   // Header logo and text display type option
   $wp_customize->add_section('spacious_show_option', array(
      'priority' => 2,
      'title' => __('Show', 'spacious'),
      'panel' => 'spacious_header_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_show_header_logo_text]', array(
      'default' => 'text_only',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_show_header_logo_text]', array(
      'type' => 'radio',
      'label' => __('Choose the option that you want.', 'spacious'),
      'section' => 'spacious_show_option',
      'choices' => array(
         'logo_only' => __('Header Logo Only', 'spacious'),
         'text_only' => __('Header Text Only', 'spacious'),
         'both' => __('Show Both', 'spacious'),
         'none' => __('Disable', 'spacious')
      )
   ));

   // Header image position option
   $wp_customize->add_section('spacious_header_image_position_section', array(
      'priority' => 3,
      'title' => __('Header Image Position', 'spacious'),
      'panel' => 'spacious_header_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_header_image_position]', array(
      'default' => 'above',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_header_image_position]', array(
      'type' => 'radio',
      'label' => __('Choose top header image display position.','spacious'),
      'section' => 'spacious_header_image_position_section',
      'choices' => array(
         'above' => __( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
         'below' => __( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' )
      )
   ));
   // End of Header Options

   // Start of the Design Options
   $wp_customize->add_panel('spacious_design_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 505,
      'title' => __('Design', 'spacious')
   ));

   // site layout setting
   $wp_customize->add_section('spacious_site_layout_setting', array(
      'priority' => 1,
      'title' => __('Site Layout', 'spacious'),
      'panel' => 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_site_layout]', array(
      'default' => 'box_1218px',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_site_layout]', array(
      'type' => 'radio',
      'label' => __('Choose your site layout. The change is reflected in whole site.', 'spacious'),
      'choices' => array(
         'box_1218px' => __( 'Boxed layout with content width of 1218px', 'spacious' ),
         'box_978px' => __( 'Boxed layout with content width of 978px', 'spacious' ),
         'wide_1218px' => __( 'Wide layout with content width of 1218px', 'spacious' ),
         'wide_978px' => __( 'Wide layout with content width of 978px', 'spacious' ),
      ),
      'section' => 'spacious_site_layout_setting'
   ));

   class Spacious_Image_Radio_Control extends WP_Customize_Control {

      public function render_content() {

         if ( empty( $this->choices ) )
            return;

         $name = '_customize-radio-' . $this->id;

         ?>
         <style>
            #spacious-img-container .spacious-radio-img-img {
               border: 3px solid #DEDEDE;
               margin: 0 5px 5px 0;
               cursor: pointer;
               border-radius: 3px;
               -moz-border-radius: 3px;
               -webkit-border-radius: 3px;
            }
            #spacious-img-container .spacious-radio-img-selected {
               border: 3px solid #AAA;
               border-radius: 3px;
               -moz-border-radius: 3px;
               -webkit-border-radius: 3px;
            }
            input[type=checkbox]:before {
               content: '';
               margin: -3px 0 0 -4px;
            }
         </style>
         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <ul class="controls" id='spacious-img-container'>
         <?php
            foreach ( $this->choices as $value => $label ) :
               $class = ($this->value() == $value)?'spacious-radio-img-selected spacious-radio-img-img':'spacious-radio-img-img';
               ?>
               <li style="display: inline;">
               <label>
                  <input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                  <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
               </label>
               </li>
               <?php
            endforeach;
         ?>
         </ul>
         <script type="text/javascript">
            jQuery(document).ready(function($) {
               $('.controls#spacious-img-container li img').click(function(){
                  $('.controls#spacious-img-container li').each(function(){
                     $(this).find('img').removeClass ('spacious-radio-img-selected') ;
                  });
                  $(this).addClass ('spacious-radio-img-selected') ;
               });
            });
         </script>
         <?php
      }
   }

   // default layout setting
   $wp_customize->add_section('spacious_default_layout_setting', array(
      'priority' => 2,
      'title' => __('Default layout', 'spacious'),
      'panel'=> 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control(new Spacious_Image_Radio_Control($wp_customize, $spacious_themename.'[spacious_default_layout]', array(
      'type' => 'radio',
      'label' => __('Select default layout. This layout will be reflected in whole site archives, search etc. The layout for a single post and page can be controlled from below options.', 'spacious'),
      'section' => 'spacious_default_layout_setting',
      'settings' => $spacious_themename.'[spacious_default_layout]',
      'choices' => array(
         'right_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // default layout for pages
   $wp_customize->add_section('spacious_default_page_layout_setting', array(
      'priority' => 3,
      'title' => __('Default layout for pages only', 'spacious'),
      'panel'=> 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_pages_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control(new Spacious_Image_Radio_Control($wp_customize, $spacious_themename.'[spacious_pages_default_layout]', array(
      'type' => 'radio',
      'label' => __('Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'spacious'),
      'section' => 'spacious_default_page_layout_setting',
      'settings' => $spacious_themename.'[spacious_pages_default_layout]',
      'choices' => array(
         'right_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // default layout for single posts
   $wp_customize->add_section('spacious_default_single_posts_layout_setting', array(
      'priority' => 4,
      'title' => __('Default layout for single posts only', 'spacious'),
      'panel'=> 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_single_posts_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control(new Spacious_Image_Radio_Control($wp_customize, $spacious_themename.'[spacious_single_posts_default_layout]', array(
      'type' => 'radio',
      'label' => __('Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'spacious'),
      'section' => 'spacious_default_single_posts_layout_setting',
      'settings' => $spacious_themename.'[spacious_single_posts_default_layout]',
      'choices' => array(
         'right_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // blog posts display type setting
   $wp_customize->add_section('spacious_blog_posts_display_type_setting', array(
      'priority' => 5,
      'title' => __('Blog Posts display type', 'spacious'),
      'panel' => 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_archive_display_type]', array(
      'default' => 'blog_large',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_archive_display_type]', array(
      'type' => 'radio',
      'label' => __('Choose the display type for the latests posts view or posts page view (static front page).', 'spacious'),
      'choices' => array(
         'blog_large' => __( 'Blog Image Large', 'spacious' ),
         'blog_medium' => __( 'Blog Image Medium', 'spacious' ),
         'blog_medium_alternate' => __( 'Blog Image Alternate Medium', 'spacious' ),
         'blog_full_content' => __( 'Blog Full Content', 'spacious' ),
      ),
      'section' => 'spacious_blog_posts_display_type_setting'
   ));

   // Site primary color option
   $wp_customize->add_section('spacious_primary_color_setting', array(
      'panel' => 'spacious_design_options',
      'priority' => 6,
      'title' => __('Primary color option', 'spacious')
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_primary_color]', array(
      'default' => '#0FBE7C',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_color_option_hex_sanitize',
      'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize'
   ));

   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $spacious_themename.'[spacious_primary_color]', array(
      'label' => __('This will reflect in links, buttons and many others. Choose a color to match your site.', 'spacious'),
      'section' => 'spacious_primary_color_setting',
      'settings' => $spacious_themename.'[spacious_primary_color]'
   )));

   // Site dark light skin option
   $wp_customize->add_section('spacious_color_skin_setting', array(
      'priority' => 7,
      'title' => __('Color Skin', 'spacious'),
      'panel'=> 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_color_skin]', array(
      'default' => 'light',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_radio_select_sanitize'
   ));

   $wp_customize->add_control(new Spacious_Image_Radio_Control($wp_customize, $spacious_themename.'[spacious_color_skin]', array(
      'type' => 'radio',
      'label' => __('Choose the light or dark skin. This will be reflected in whole site.', 'spacious'),
      'section' => 'spacious_color_skin_setting',
      'settings' => $spacious_themename.'[spacious_color_skin]',
      'choices' => array(
         'light' => SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
         'dark' => SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg'
      )
   )));

if ( ! function_exists( 'wp_update_custom_css_post' ) ) {
   // Custom CSS setting
   class spacious_Custom_CSS_Control extends WP_Customize_Control {

      public $type = 'custom_css';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }

   }

   $wp_customize->add_section('spacious_custom_css_setting', array(
      'priority' => 8,
      'title' => __('Custom CSS', 'spacious'),
      'panel' => 'spacious_design_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_custom_css]', array(
      'default' => '',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'wp_filter_nohtml_kses',
      'sanitize_js_callback' => 'wp_filter_nohtml_kses'
   ));

   $wp_customize->add_control(new spacious_Custom_CSS_Control($wp_customize, $spacious_themename.'[spacious_custom_css]', array(
      'label' => __('Write your Custom CSS.', 'spacious'),
      'section' => 'spacious_custom_css_setting',
      'settings' => $spacious_themename.'[spacious_custom_css]'
   )));
  }
   // End of Design Options

	if ( ! function_exists( 'has_site_icon' ) || ( ! has_site_icon() && ( spacious_options( 'spacious_favicon', '' ) != '' ) ) ) {
	    // Start of the Additional Options
	    $wp_customize->add_panel('spacious_additional_options', array(
	      'capabitity' => 'edit_theme_options',
	      'priority' => 510,
	      'title' => __('Additional', 'spacious')
	    ));

	    // Favicon activate option
	    $wp_customize->add_section('spacious_additional_activate_section', array(
	      'priority' => 1,
	      'title' => __('Activate favicon', 'spacious'),
	      'panel' => 'spacious_additional_options'
	    ));

	    $wp_customize->add_setting($spacious_themename.'[spacious_activate_favicon]', array(
	      'default' => 0,
	      'type' => 'option',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'spacious_checkbox_sanitize'
	    ));

	    $wp_customize->add_control($spacious_themename.'[spacious_activate_favicon]', array(
	      'type' => 'checkbox',
	      'label' => __('Check to activate favicon. Upload fav icon from below option', 'spacious'),
	      'section' => 'spacious_additional_activate_section',
	      'settings' => $spacious_themename.'[spacious_activate_favicon]'
	    ));

	    // Fav icon upload option
	    $wp_customize->add_section('spacious_favicon_upload_section',array(
	      'priority' => 2,
	      'title' => __('Upload favicon', 'spacious'),
	      'panel' => 'spacious_additional_options'
	    ));

	    $wp_customize->add_setting($spacious_themename.'[spacious_favicon]', array(
	      'default' => 0,
	      'type' => 'option',
	      'capability' => 'edit_theme_options',
	      'sanitize_callback' => 'esc_url_raw'
	    ));

	    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $spacious_themename.'[spacious_favicon]', array(
	      'label' => __('Upload favicon for your site.', 'spacious'),
	      'section' => 'spacious_favicon_upload_section',
	      'settings' => $spacious_themename.'[spacious_favicon]'
	    )));
	    // End of Additional Options
	}

   // Adding Text Area Control For Use In Customizer
   class Spacious_Text_Area_Control extends WP_Customize_Control {

      public $type = 'text_area';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }
   }

   // Start of the Slider Options
   $wp_customize->add_panel('spacious_slider_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 515,
      'title' => __('Slider', 'spacious')
   ));

   // Slider activate option
   $wp_customize->add_section('spacious_slider_activate_section', array(
      'priority' => 1,
      'title' => __('Activate slider', 'spacious'),
      'panel' => 'spacious_slider_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_activate_slider]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_checkbox_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_activate_slider]', array(
      'type' => 'checkbox',
      'label' => __('Check to activate slider.', 'spacious'),
      'section' => 'spacious_slider_activate_section',
      'settings' => $spacious_themename.'[spacious_activate_slider]'
   ));

   // Disable slider in blog page
   $wp_customize->add_section('spacious_disable_slider_blog_page_section', array(
      'priority' => 2,
      'title' => __('Disable slider in Posts page', 'spacious'),
      'panel' => 'spacious_slider_options'
   ));

   $wp_customize->add_setting($spacious_themename.'[spacious_blog_slider]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'spacious_checkbox_sanitize'
   ));

   $wp_customize->add_control($spacious_themename.'[spacious_blog_slider]', array(
      'type' => 'checkbox',
      'label' => __('Check to disable slider in Posts Page', 'spacious'),
      'section' => 'spacious_disable_slider_blog_page_section',
      'settings' => $spacious_themename.'[spacious_blog_slider]'
   ));

   for ( $i = 1; $i <= 5; $i++ ) {
      // adding slider section
      $wp_customize->add_section('spacious_slider_number_section'.$i, array(
         'priority' => 10,
         'title' => sprintf( __( 'Image Upload #%1$s', 'spacious' ), $i ),
         'panel' => 'spacious_slider_options'
      ));

      // adding slider image url
      $wp_customize->add_setting($spacious_themename.'[spacious_slider_image'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
      ));

      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $spacious_themename.'[spacious_slider_image'.$i.']', array(
         'label' => __( 'Upload slider image.', 'spacious' ),
         'section' => 'spacious_slider_number_section'.$i,
         'setting' => $spacious_themename.'[spacious_slider_image'.$i.']',
      )));

      // adding slider title
      $wp_customize->add_setting($spacious_themename.'[spacious_slider_title'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
      ));

      $wp_customize->add_control($spacious_themename.'[spacious_slider_title'.$i.']', array(
         'label' => __( 'Enter title for your slider.', 'spacious' ),
         'section' => 'spacious_slider_number_section'.$i,
         'setting' => $spacious_themename.'[spacious_slider_title'.$i.']'
      ));

      // adding slider description
      $wp_customize->add_setting($spacious_themename.'[spacious_slider_text'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'spacious_text_sanitize'
      ));

      $wp_customize->add_control(new Spacious_Text_Area_Control($wp_customize, $spacious_themename.'[spacious_slider_text'.$i.']', array(
         'label' => __( 'Enter your slider description.', 'spacious' ),
         'section' => 'spacious_slider_number_section'.$i,
         'setting' => $spacious_themename.'[spacious_slider_text'.$i.']'
      )));

      // adding slider button text
      $wp_customize->add_setting($spacious_themename.'[spacious_slider_button_text'.$i.']', array(
         'default' => __( 'Read more', 'spacious' ),
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
      ));

      $wp_customize->add_control($spacious_themename.'[spacious_slider_button_text'.$i.']', array(
         'label' => __( 'Enter the button text. Default is "Read more"', 'spacious' ),
         'section' => 'spacious_slider_number_section'.$i,
         'setting' => $spacious_themename.'[spacious_slider_button_text'.$i.']'
      ));

      // adding button url
      $wp_customize->add_setting($spacious_themename.'[spacious_slider_link'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
      ));

      $wp_customize->add_control($spacious_themename.'[spacious_slider_link'.$i.']', array(
         'label' => __( 'Enter link to redirect slider when clicked', 'spacious' ),
         'section' => 'spacious_slider_number_section'.$i,
         'setting' => $spacious_themename.'[spacious_slider_link'.$i.']'
      ));
   }
   // End of Slider Options

   // Start of data sanitization
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
   function spacious_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

   // text-area sanitize
   function spacious_text_sanitize($input) {
      return wp_kses_post( force_balance_tags( $input ) );
   }

   // color sanitization
   function spacious_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }

   function spacious_color_escaping_option_sanitize($input) {
      $input = esc_attr($input);
      return $input;
   }

   function spacious_false_sanitize() {
      return false;
   }
}
add_action('customize_register', 'spacious_customize_register');

/*****************************************************************************************/

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'spacious_customizer_custom_scripts' );

function spacious_customizer_custom_scripts() { ?>
<style>
   	/* Theme Instructions Panel CSS */
	li#accordion-section-spacious_important_links h3.accordion-section-title, li#accordion-section-spacious_important_links h3.accordion-section-title:focus { background-color: #0FBE7C !important; color: #fff !important; }
	li#accordion-section-spacious_important_links h3.accordion-section-title:hover { background-color: #0FBE7C !important; color: #fff !important; }
	li#accordion-section-spacious_important_links h3.accordion-section-title:after { color: #fff !important; }
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

	.customize-control-spacious-important-links a{
		padding: 8px 0;
	}

	.themegrill-pro-info:hover,
	.customize-control-spacious-important-links a:hover {
		color: #ffffff;
		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
		background:#2380BA;
	}
</style>
<?php
}
?>

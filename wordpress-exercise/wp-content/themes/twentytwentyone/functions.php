<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Registers widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			array(
				'in_footer' => false, // Because involves header.
				'strategy'  => 'defer',
			)
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueues block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), array( 'in_footer' => true ) );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 * @deprecated Twenty Twenty-One 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}

/**
 * Enqueues non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueues scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueues scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculates classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;

//register Custom Post Type
function custom_post_type_portfolio() {

    $labels = array(
        'name'                  => _x( 'Portfolio', 'twentytwentyone' ),
        'singular_name'         => _x( 'Portfolio', 'twentytwentyone' ),
        'menu_name'             => __( 'Portfolio', 'twentytwentyone' ),
        'name_admin_bar'        => __( 'Portfolio', 'twentytwentyone' ),
        'archives'              => __( 'Portfolio Archives', 'twentytwentyone' ),
        'all_items'             => __( 'All Portfolio', 'twentytwentyone' ),
        'add_new_item'          => __( 'Add New Portfolio', 'twentytwentyone' ),
        'add_new'               => __( 'Add New', 'twentytwentyone' ),
        'new_item'              => __( 'New Portfolio', 'twentytwentyone' ),
        'edit_item'             => __( 'Edit Portfolio', 'twentytwentyone' ),
        'update_item'           => __( 'Update Portfolio', 'twentytwentyone' ),
        'view_item'             => __( 'View Portfolio', 'twentytwentyone' ),
        'search_items'          => __( 'Search Portfolio', 'twentytwentyone' ),
        'featured_image'        => __( 'Featured Image', 'twentytwentyone' ),
        'set_featured_image'    => __( 'Set featured image', 'twentytwentyone' ),
        'remove_featured_image' => __( 'Remove featured image', 'twentytwentyone' ),
        'insert_into_item'      => __( 'Insert into Portfolio', 'twentytwentyone' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'twentytwentyone' ),
    );
    $args = array(
        'label'                 => __( 'Portfolio', 'twentytwentyone' ),
        'description'           => __( 'Client projects portfolio', 'twentytwentyone' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'post-formats' ),
        // 'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'portfolio' ),
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'portfolio', $args );

}
add_action( 'init', 'custom_post_type_portfolio', 0 );

//custom meta box for client name
//Defining the Meta Box Callback Function
function portfolio_client_meta_box_html( $post ) {
    // Retrieve the current value of the client meta field
    $client = get_post_meta( $post->ID, 'portfolio_client', true );
    ?>
    <label for="portfolio_client">Client: </label>
    <input type="text" id="portfolio_client" name="portfolio_client" value="<?php echo esc_attr( $client ); ?>" />
    <?php
}

//Hook into the 'add_meta_boxes' Action -  adds the meta box to the editing screen
function add_portfolio_client_meta_box() {
    add_meta_box(
        'portfolio_client_meta_box',       // Unique ID
        __( 'Project Client', 'twentytwentyone' ), // Box title
        'portfolio_client_meta_box_html', // Callback function
        'portfolio',                        // Post type
    );
}
add_action( 'add_meta_boxes', 'add_portfolio_client_meta_box' );

//save Meta Box Data
function save_portfolio_client_meta_data( $post_id ) {
    if ( array_key_exists( 'portfolio_client', $_POST ) ) {
        update_post_meta(
            $post_id,
            'portfolio_client',
            sanitize_text_field( $_POST['portfolio_client'] )
        );
    }
}

add_action( 'save_post', 'save_portfolio_client_meta_data' );


// Register Project Type Taxonomy
function register_project_type_taxonomy() {
		$labels = array(
            'name'                       => _x( 'Project Types', 'taxonomy general name'),
            'singular_name'              => _x( 'Project Type', 'taxonomy singular name'),
			'search_items'               => __( 'Search Project Types'),
			'all_items'                  => __( 'All Project Types'),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Project Type'),
			'update_item'                => __( 'Update Project Type'),
			'add_new_item'               => __( 'Add New Project Type'),
			'new_item_name'              => __( 'New Project Type Name'),
			'menu_name'                  => __( 'Project Types'),
        
		);

        $args = array(
			'hierarchical'          => true, // make it hierarchical (like categories)
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'project-type' ),
		);
    
    register_taxonomy( 'project_type', 'portfolio', $args );
}
add_action( 'init', 'register_project_type_taxonomy', 0 );

// Register Project Category Taxonomy
function register_project_category_taxonomy() {
    $labels = array(
            'name'                    	 => _x( 'Project Categories', 'taxonomy general name'),
            'singular_name'              => _x( 'Project Category', 'taxonomy singular name'),
			'search_items'               => __( 'Search Project Categories'),
			'all_items'                  => __( 'All Project Categories'),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Project Category'),
			'update_item'                => __( 'Update Project Category'),
			'add_new_item'               => __( 'Add New Project Category'),
			'new_item_name'              => __( 'New Project Category Name'),
			'menu_name'                  => __( 'Project Categories'),
        
	);
	$args = array(
        'hierarchical'    		 => true,
		'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'project-category' ),
  
    );
    register_taxonomy( 'project_category', 'portfolio', $args );
}
add_action( 'init', 'register_project_category_taxonomy', 0 );

//practice for custom cli cmd
// class Example_Command {
//     protected $environment;

//     public function __construct( ) {
//         $this->environment = wp_get_environment_type();
//     }
	
//     public function __invoke( $args ) {
//         WP_CLI::log( sprintf( 'The current environment is: %s', $this->environment ) );
//     }
// }
// // 1. Register the instance for the callable parameter.
// $instance = new Example_Command();
// WP_CLI::add_command( 'env-check', $instance );

// // 2. Register object as a function for the callable parameter.
// WP_CLI::add_command( 'env-check', 'Example_Command' );


if (defined( 'WP_CLI' ) && WP_CLI) {
//custom cli command to add post
class Custom_Addportfolio_Cmd {

	public function __invoke($args, $assoc_args) {
		//get the count argument
		$count = isset($assoc_args['count']) ? intval($assoc_args['count']) : 1;

		$success_count = 0; //track successful post creations

		//generate and add portfolio posts based on $count
		for($i = 0; $i < $count; $i++) {
			//generate random data
			$title = 'Portfolio ' . $i;
			$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
			$taxonomy_cat = array('category1', 'category2', 'category3'); //random taxonomy terms
			$taxonomy_type = array('project1', 'project2', 'project3'); //random taxonomy terms

			//create the new portfolio post
			$post_id = wp_insert_post(array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'portfolio',
			));

			//check if post creation was successful
			if(is_wp_error($post_id)) {
				WP_CLI::warning("Error creating portfolio post: " . $post_id->get_error_message()); //Retrieves the first error code available
			} else {
				$success_count++;

				//assign random taxonomy for category
				$random_cat = $taxonomy_cat[array_rand($taxonomy_cat)];
				wp_set_object_terms($post_id, $random_cat, 'project_category');

				//assign random taxonomy for type
				$random_type = $taxonomy_type[ array_rand($taxonomy_type)];
				wp_set_object_terms($post_id, $random_type, 'project_type');
			}
		}

		if ( $success_count > 0 ) {
			WP_CLI::success("$success_count portfolio posts added successfully.");
		} else {
			WP_CLI::error("No portfolio posts added.");
		}
	}
}

WP_CLI::add_command('add-portfolio', 'Custom_Addportfolio_Cmd');
}

//shortcode for portfolio list
add_shortcode('portfolio-list', 'portfolio_list_shortcode');

function portfolio_list_shortcode($atts){

	$atts = shortcode_atts(
		array('count'	=> -1,
			'category'	=> '',
			'ids'		=> '',
			'project-type'=> '' ), $atts);

	$args = array(
		'post_type'		=> 'portfolio',
		'posts_per_page' => $atts['count']);

	//add taxonomy queries if given
	if(!empty($atts['category'])){
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'project_category',
			'field' 	=> 'slug',
			'terms' 	=> explode(',', $atts['category'])
		);
	}

	if(!empty($atts['project-type'])){
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'project_type',
			'field' 	=> 'slug',
			'terms' 	=> explode(',', $atts['project-type'])
		);
	}
	//add post id if given
	if(!empty($atts['ids'])){
		$args['post__in'] = explode(',', $atts['ids']);
	}

	$shortcode_query = new WP_Query($args);

	//output in gridview

	ob_start(); //to capture output and convert it to a string
	if($shortcode_query -> have_posts()){
		?>
		<div class="portfolio-grid">
            <?php while ($shortcode_query -> have_posts() ) : $shortcode_query -> the_post(); ?>
            <article <?php post_class('portfolio-item'); ?>>
                <div class="post-header alignwide">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-taxonomies">
                            <?php the_terms(get_the_ID(), 'project_type', 'Project Type: ', ', '); ?>
                            <?php the_terms(get_the_ID(), 'project_category', 'Project Category: ', ', '); ?>
                        </div>
						<div class="post-description">
                        <?php the_excerpt(); ?>
                    	</div>
                	</div>
            	</div>
            </article>
            <?php endwhile; ?>
        </div>
		<?php
		wp_reset_postdata();
	
	}else{
		echo 'No project found!';
	}
	return ob_get_clean();
}

//to disable cart option
add_filter('woocommerce_is_purchasable', '__return_false');

//registering custom posttype for product inquiry
function register_product_inquiry_posttype(){
    $args = array(
        'public' => true,
        'label'  => 'Product Inquiries',
        'supports' => array('title' , 'editor'), 
    );
    register_post_type('product_inquiry', $args);
}
add_action('init', 'register_product_inquiry_posttype');


//for inquiry form submission
add_action('admin_post_product_inquiry', 'handle_product_inquiry'); //for logged in users
add_action('admin_post_nopriv_product_inquiry', 'handle_product_inquiry'); //for non-logged in users

function handle_product_inquiry(){
    if(isset($_POST['product_id']) && isset($_POST['inquiry_msg']) 
		&& isset($_POST['email']) && isset($_POST['contact'])) {

        // get product ID, email, contact, and inquiry message from POST data
        $product_id = absint($_POST['product_id']);
        $email = sanitize_email($_POST['email']);
        $contact = sanitize_text_field($_POST['contact']);
        $inquiry_msg = sanitize_text_field($_POST['inquiry_msg']);

        // create custom post type 'product_inquiry'
        $post_data = array(
            'post_title'   	=> 'Inquiry for Product - ID ' . $product_id,
            'post_content' 	=> $inquiry_msg,
            'post_status'  	=> 'publish',
            'post_author'  	=> 1,
            'post_type'    	=> 'product_inquiry',
            'meta_input'   	=> array(
				'product_id' => $product_id,
				'email' => $email,
                'contact' => $contact,
			));

        //insert post into database
        $post_id = wp_insert_post( $post_data );

		wp_redirect(get_permalink( $product_id ));

    }

    //redirect back to the previous page
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    exit;
}



//RestAPI endpoint ex

add_action('rest_api_init', 'register_portfolio_endpoint');

function register_portfolio_endpoint(){
    register_rest_route('md-custom/', '/all-portfolio', 
		array('methods'  => 'GET', 
		'callback' => 'get_portfolio_data' ));

}

function get_portfolio_data($data) {

    // parse and sanitize request parameters
    $params = $data->get_params();

    // prepare query arguments
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1, 
    );

    // filter by post IDs
    if( !empty($params['ids'])) {
        $args['post__in'] = explode( ',', $params['ids']);
    }

    // Filter by category
    if( !empty( $params['category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'project_category',
            'field'	=> 'slug',
            'terms' => explode( ',', $params['category']),
        );
    }

    // Filter by project type
    if( !empty( $params['project-type'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'project_type',
            'field' => 'slug',
            'terms' => explode( ',', $params['project-type']),
        );
    }

    // query portfolio data
    $portfolio_query = new WP_Query($args);

    // check if any posts are found
    if($portfolio_query->have_posts()) {
        // initialize empty array to store results
        $portfolio_data = array();

        // loop through each post and retrieve relevant data
        while($portfolio_query->have_posts()) {
            $portfolio_query->the_post();
            $portfolio_item = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
            );
            $portfolio_data[] = $portfolio_item;
        }

        // reset post data
        wp_reset_postdata();

        return rest_ensure_response($portfolio_data);   // return portfolio data in JSON 
    } else {
        return rest_ensure_response(array()); //if no posts are found, return empty array
    }
}

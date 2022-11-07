<?php

function kopa_admin_custom_header_fonts() {
	wp_enqueue_style( 'kopa-resolution-oswald', 'https://fonts.googleapis.com/css?family=Oswald', array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'kopa_admin_custom_header_fonts' );

function kopa_custom_header_setup(){
    add_theme_support( 'custom-header', apply_filters( 'kopa_custom_header_args', array(
		'default-text-color'     => '444',
		'width'                  => 1160,
		'height'                 => 101,
		'flex-height'            => true,
		'wp-head-callback'       => 'kopa_header_style',
		'admin-head-callback'    => 'kopa_admin_header_style',
		'admin-preview-callback' => 'kopa_admin_header_image',
	) ) );
}

add_action( 'after_setup_theme', 'kopa_custom_header_setup' );

if ( ! function_exists( 'kopa_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see kopa_custom_header_setup().
 *
 */
function kopa_header_style() {
	$text_color = get_header_textcolor();

	// If no custom color for text is set, let's bail.
	if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="kopa-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title {
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	<?php
		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $text_color ); ?>;
                        font-weight: 400;
                        }
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyfourteen_header_style


if ( ! function_exists( 'kopa_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see kopa_custom_header_setup()
 *
 * 
 */
function kopa_admin_header_style() {
?>
	<style type="text/css" id="kopa-admin-header-css">
	.appearance_page_custom-header #headimg {
		background-color: #f9f9f9;
		border: none;
		max-width: 1160px;
		min-height: 48px;
	}
	#headimg h1 {
		font-family: Oswald, sans-serif;
		/*font-size: 18px;*/
		margin: 0 0 0 30px;
	}
	#headimg h1 a {
		color: #444;
		text-decoration: none;
		font-weight: 400;
	}
	#headimg h1 a:hover {
		color: #33bee5;
	}
	#headimg img {
		vertical-align: middle;
		margin: 0 0 0 30px;
		padding-top: 10px;
	}
	</style>
<?php
}
endif; // twentyfourteen_admin_header_style

if ( ! function_exists( 'kopa_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see kopa_custom_header_setup()
 *
 * 
 */
function kopa_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo sprintf( ' style="color:#%s;"', get_header_textcolor() ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // twentyfourteen_admin_header_image

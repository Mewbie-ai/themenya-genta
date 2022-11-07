<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">           
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php if (kopa_get_option('kopa_theme_options_favicon_url')) { ?>       
            <link rel="shortcut icon" type="image/x-icon"  href="<?php echo kopa_get_option('kopa_theme_options_favicon_url'); ?>">
        <?php } ?>

        <?php if (kopa_get_option('kopa_theme_options_apple_iphone_icon_url')) { ?>
            <link rel="apple-touch-icon" sizes="57x57" href="<?php echo kopa_get_option('kopa_theme_options_apple_iphone_icon_url'); ?>">
        <?php } ?>

        <?php if (kopa_get_option('kopa_theme_options_apple_ipad_icon_url')) { ?>
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo kopa_get_option('kopa_theme_options_apple_ipad_icon_url'); ?>">
        <?php } ?>

        <?php if (kopa_get_option('kopa_theme_options_apple_iphone_retina_icon_url')) { ?>
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo kopa_get_option('kopa_theme_options_apple_iphone_retina_icon_url'); ?>">
        <?php } ?>

        <?php if (kopa_get_option('kopa_theme_options_apple_ipad_retina_icon_url')) { ?>
            <link rel="apple-touch-icon" sizes="144x144" href="<?php echo kopa_get_option('kopa_theme_options_apple_ipad_retina_icon_url'); ?>">        
        <?php } ?>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div class="wrapper kp-sidebar">

            <div id="kp-page-header" class="header-style-1">

                <div id="header-top">
                    <?php
					if (has_nav_menu('top-nav')) :
						$top_menu = array('theme_location' => 'top-nav', 'container' => false, 'menu_id' => 'top-menu', 'menu_class' => 'pull-left', 'depth' => -1);
						wp_nav_menu($top_menu);
					endif;
				?> 

                    <!-- top-menu -->
                    <ul id="contact-top-box" class="pull-right clearfix">
                        <?php if (get_option('kopa_theme_options_phone_number')) { ?>
                            <li><span class="clearfix"><span class="fa fa-phone"></span><?php echo esc_html( kopa_get_option('kopa_theme_options_phone_number') ); ?></span></li>
                        <?php } ?>

                        <?php if (get_option('kopa_theme_options_address')) { ?>
                            <li><span class="clearfix"><span class="fa fa-map-marker"></span><?php echo esc_html( kopa_get_option('kopa_theme_options_address') ); ?></span></li>
                        <?php } ?>

                        <?php if (get_option('kopa_theme_options_email')) { ?>
                            <li><span class="clearfix"><span class="fa fa-envelope"></span><?php echo esc_html( kopa_get_option('kopa_theme_options_email') ); ?></span></li>
                        <?php } ?>

                    </ul>
                    <!-- contact-top-box -->
                    <div class="clear"></div>
                </div>
                <!-- header-top -->

                <div id="header-middle">
                     <div id="logo-image" class="pull-left">
                        <?php if (get_header_image()) { ?>
                            <a href="<?php echo esc_url(home_url()); ?>">
                                <img src="<?php header_image(); ?>" width="217" height="70" alt="<?php bloginfo('name'); ?> <?php _e('Logo', kopa_get_domain()); ?>">
                            </a>
                        <?php } ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>
                    </div><!--logo-image-->

                    <?php if (kopa_get_option('kopa_theme_options_top_banner_url')) { ?>

                        <div id="top-banner" class="pull-right">
                            <?php echo htmlspecialchars_decode( kopa_get_option('kopa_theme_options_top_banner_url') ); ?>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
                <!-- header-middle -->

                <div id="header-bottom">
                    <div id="header-bottom-inner">
                        <nav id="main-nav" class="pull-left">

                            <?php
							if (has_nav_menu('main-nav')) {
								wp_nav_menu(array(
												  'theme_location' => 'main-nav', 
												  'container' => false, 
												  'items_wrap' => '<ul id="main-menu" class="clearfix">' . '%3$s' . '</ul>', 
												  'walker' => new kopa_main_menu()
												  )
												  );
							}
							?>
                            <!-- main-menu -->

                            <?php
							if (has_nav_menu('main-nav')) {
								wp_nav_menu(array(
												  'theme_location' => 'main-nav', 
												  'container' => false, 
												  'items_wrap' => '<div id="mobile-menu">
                                                    			   <span>Menu</span>
                                                    			   <ul id="toggle-view-menu">%3$s</ul>
                                                    			   </div>', 
                                                   'walker' => new kopa_mobile_menu()
												   )
												   );
							}
							?>
                        </nav>
                        <!-- main-nav -->


                        <!-- kp-shopping-cart -->
                    <div class="sb-search-wrapper">
                        <div id="sb-search" class="sb-search">
                        <?php get_search_form(); ?>
                        </div><!--sb-search-->
                    </div><!--sb-search-wrapper-->
                        <div class="clear"></div>
                    </div>
                    <!-- header-bottom-inner -->
                </div>
                <!-- header-bottom -->

            </div>
            <!-- kp-page-header -->

            <div id="main-content">

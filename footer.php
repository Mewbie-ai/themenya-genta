<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
$total = count( $sidebars );
$footer_sidebar[0] = ($kopa_setting) ? $sidebars[$total - 3] : 'sidebar_6';
$footer_sidebar[1] = ($kopa_setting) ? $sidebars[$total - 2] : 'sidebar_7';
$footer_sidebar[2] = ($kopa_setting) ? $sidebars[$total - 1] : 'sidebar_8';

?>

</div>
    <!-- main-content -->    

</div>
<!-- wrapper -->

<div id="bottom-sidebar">
        
    <div class="wrapper">

        <?php if ( is_active_sidebar( $footer_sidebar[0] ) ) { ?>
        <div class="widget-area-9">
            <?php dynamic_sidebar( $footer_sidebar[0] ); ?>
            <div class="r-color"></div>
        </div>
        <!-- widget-area-9 -->
        <?php } ?>

        <?php if ( is_active_sidebar( $footer_sidebar[1] ) ) { ?>
        <div class="widget-area-10">
            <?php dynamic_sidebar( $footer_sidebar[1] ); ?>
            <div class="r-color"></div>
        </div>
        <!-- widget-area-10 -->
        <?php } ?>

        <?php if ( is_active_sidebar( $footer_sidebar[2] ) ) { ?>
        <div class="widget-area-11">
            <?php dynamic_sidebar( $footer_sidebar[2] ); ?>
        </div>
        <!-- widget-area-11 -->
        <?php } ?>

        <div class="clear"></div>

    </div>
    <!-- wrapper -->

</div>
<!-- bottom-sidebar -->

  <!-- ==== FOOTER ==== -->
  <footer id="footer" class="footer">
	              <?php
            if (has_nav_menu('footer-nav')):
                    wp_nav_menu(
                            array(
                                'theme_location' => 'footer-nav',
                                'container_class' => 'clearfix',
                                'container_id' => 'footer-nav',
                                'container_class' => 'pull-right',
                                'menu_id' => 'footer-menu',
                                'menu_class' => 'clearfix',
                                'depth'=>-1
                            )
                    );
            endif;                            
            ?>
    <div class="d-flex align-items-center flex-column">
	<?php if (get_header_image()) { ?>
		<img src="<?php header_image(); ?>" width="150" alt="<?php bloginfo('name'); ?> <?php _e('Logo', kopa_get_domain()); ?>">
	<?php } ?>
      <div class="copyright">
        &copy; Copyright <strong><span>Genta_Petra </span></strong>| All Rights Reserved
      </div>
    </div>
  </footer>
  <!-- End FOOTER -->

<footer id="kp-page-footer">
    <div class="wrapper clearfix">
        <?php if(kopa_get_option('kopa_theme_options_copyright')){ ?>
        <div id="copyright" class="pull-left"> 
			<!--<?php /*echo esc_html( kopa_get_option('kopa_theme_options_copyright') );)*/ ?>-->
			<!-- Inilah tempat update tahun copyright otomatis-->
			<?php echo "Copyright ©"; ?>
			<?php date_default_timezone_set("Asia/Jakarta"); echo date('Y'); ?>
			<?php echo " GENTA Petra | All rights reserved"; ?>
		</div>       
        <?php }  ?>

        <!-- footer-nav -->
    </div>
    <!-- wrapper -->
</footer>
<!-- kp-page-footer -->
<?php wp_footer();?>
</body>

</html>

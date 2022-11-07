<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];

get_header();
?>

<div class="bottom-content">

    <div class="main-col">
         <?php if ( is_active_sidebar( $sidebars[0] ) ) { ?>
        <?php dynamic_sidebar( $sidebars[0] ); ?>
        <?php } ?>
        <?php kopa_breadcrumb(); ?>

        <?php get_template_part( 'content', 'blog' ); ?>

        <div class="r-color"></div>

    </div>
    <!-- main-col -->

	

    <div class="clear"></div>

</div>
<!-- bottom-content -->

<?php get_footer(); ?>
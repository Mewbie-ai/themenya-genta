<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];

get_header();
?>

<div class="bottom-content">

    <div class="main-col">               
        <?php if (is_active_sidebar($sidebars[0])) { ?>
        <div class="widget-area-5">
            <?php dynamic_sidebar($sidebars[0]); ?>
        </div>
        <!-- widget-area-5 -->
        <?php } ?>

        <?php if (is_active_sidebar($sidebars[2])) { ?>
        <div class="widget-area-6">
        <?php dynamic_sidebar($sidebars[2]); ?>
        </div>
        <!-- widget-area-6 -->
        <?php } ?>

        <?php if (is_active_sidebar($sidebars[3])) { ?>
        <div class="widget-area-7">
            <?php dynamic_sidebar($sidebars[3]); ?>
        </div>
        <!-- widget-area-7 -->
        <?php } ?>

        <div class="clear"></div>

        <?php if (is_active_sidebar($sidebars[4])) { ?>
        <div class="widget-area-8">
            <?php dynamic_sidebar($sidebars[4]); ?>
        </div>
        <!-- widget-area-8 -->
        <?php } ?>

        <div class="r-color"></div>

    </div>
    <!-- main-col -->

    <?php if (is_active_sidebar($sidebars[1])) { ?>
    <div class="sidebar widget-area-4">
        <?php dynamic_sidebar($sidebars[1]); ?>
    </div>
    <!-- sidebar -->
    <?php } ?>

    <div class="clear"></div>

</div>
<!-- bottom-content -->

<?php get_footer(); ?>
<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
get_header();

?>

<div class="bottom-content">
    <div class="main-col">
        <?php
        get_template_part('loop', 'single');
        ?>
    </div>
    
    <?php if (is_active_sidebar($sidebars[0])){ ?>
    <div class="sidebar widget-area-4">

	<?php
    dynamic_sidebar($sidebars[0]);
	?>

    </div>
    <!-- sidebar -->
	<?php } ?>
    <div class="clear"></div>
</div>

<?php
get_footer();
?>
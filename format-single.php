<?php
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('entry-box'); ?>>
    <h4 class="entry-title">
        <span class="bold-line"><span></span></span>
        <span class="solid-line"></span>
        <span class="text-title"><?php the_title(); ?></span>
    </h4>
    <!-- entry-title -->
    <?php $thumbnail_image = kopa_get_option('kopa_theme_options_thumbnail_image'); ?>
    <?php if ($thumbnail_image == 'show') { ?>
    <?php if (has_post_thumbnail()) { ?>
        <div class="entry-thumb">
            
                <?php the_post_thumbnail('large'); ?>
            
        </div><!-- entry-thumb -->
    <?php } ?>
    <?php } ?>
    <div class="entry-content">
        
        
        <?php the_content(); ?>
    </div>
    <!-- entry-content -->

    <?php
	$args = array(
		'before' => '<div class="page-links pull-right"><span class="page-links-title">'.__('Pages',kopa_get_domain()).':</span>',
        'after' => '</div>',
        'pagelink'=>'<span>%</span>'
        );
	 wp_link_pages($args); ?>
    <!-- page-links -->
    <?php if (get_the_tags()) { ?>
    <div class="tag-box pull-left">
        <span><?php echo __('Tagged with:', kopa_get_domain()); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <?php
    the_tags('', ', ', '');
?>
    </div>
    <?php } ?>
    <div class="clear"></div>

    <?php $post_link = kopa_get_option('kopa_theme_options_post_link'); ?>
    <?php if ($post_link == 'show') {
    	kopa_post_navigation();
		
    } ?>
</div>




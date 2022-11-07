<div class="elements-box entry-box">                  
<?php 
if (have_posts()):
    while (have_posts()):
		the_post();
?>
<h4 class="page-title">
    <span class="bold-line"><span></span></span>
    <span class="solid-line"></span>
    <span class="text-title"><?php the_title(); ?></span>
</h4>
<?php
    
    ?>
    <div id="page-<?php the_ID(); ?>" <?php post_class('entry-content clearfix'); ?>>
    <?php
    echo '';
    the_content();
	$args = array(
		'before' =>'<div class="page-links pull-right"><span class="page-links-title">Pages:</span>',
        'after' => '</div>',
        'pagelink'=>'<span>%</span>'
        );
    wp_link_pages($args);
    ?>
    </div>
    <?php
    
    comments_template();
endwhile;
endif;
?>
</div>


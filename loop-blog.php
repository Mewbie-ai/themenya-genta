<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <li class="masonry-box">
            <article class="entry-item clearfix">
                <?php if (has_post_thumbnail()) { ?>
                    <div class="entry-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('kopa-image-size-2'); ?>
                        </a>
                    </div>
                <?php } ?>
                <!-- entry-thumb -->

                <div class="entry-content">
                    <header>
                        <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                        
                        <?php if ( get_the_category() ) { ?>
                            <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                        <?php } // endif ?>

                        <?php if ( get_the_tags() ) { ?>
                            <span class="entry-tags"><span class="entry-bullet"></span><?php echo __('Tags:', kopa_get_domain()); ?> <?php the_tags('', ', ', ''); ?></span>
                        <?php } // endif ?>

                    </header>
                    <?php the_excerpt(); ?>
                </div>
                <!-- entry-content -->
            </article>
            <!-- entry-item -->
        </li>
        <?php
    }// end while 
} // end if 
else { ?>
    <div class="item clearfix">
        <div class="item-right">
            <h3><?php _e( 'Nothing Found', kopa_get_domain() ); ?></h3>
        </div>
    </div>
<?php } ?>

        
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class kopa_featured_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-featured-widget-2', 'description' => __('Show a post slider and a post list',  kopa_get_domain()));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kp-featured-widget', __('Kopa Featured Widget',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $animation = $instance['animation'];
        $direction = $instance['direction'];
        $slideshowSpeed = $instance['slideshowSpeed'];
        $animationSpeed = $instance['animationSpeed'];
        $numpost = (int) $instance['number_of_article'];
        $is_Autoplay = $instance['isAutoplay'];
        
        if ($numpost > 4) {
            $smallpost = 4;
            $bigpost = $numpost - $smallpost;
        } else {
            $bigpost = 1;
            $smallpost = $numpost - $bigpost;
        }

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title  . $title .  $after_title;
        }
        ?>
        <?php
        $kopa_big_query_args['categories'] = $instance['categories'];
        $kopa_big_query_args['relation'] = $instance['relation'];
        $kopa_big_query_args['tags'] = $instance['tags'];
        $kopa_big_query_args['posts_per_page'] = $bigpost;
        $kopa_big_query_args['orderby'] = $instance['orderby'];
		if (isset($instance['kopa_timestamp'])){
					$kopa_big_query_args['date_query'] = $instance['kopa_timestamp'];
				}
        
        $kopa_big_post = kopa_widget_posttype_build_query($kopa_big_query_args);
        $not_in_small = array();
        foreach($kopa_big_post->posts as $key=>$value):
            $not_in_small[] = $value->ID;
        endforeach;
        
        if ($kopa_big_post->have_posts()):
            ?>
            <article class="last-item clearfix">
                <div class="flexslider kp-featured-slider-2 loading" data-animation = "<?php echo $animation; ?>" data-direction = "<?php echo $direction; ?>" data-slideshow-speed = "<?php echo $slideshowSpeed; ?>" data-animation-speed = "<?php echo $animationSpeed; ?>" data-autoplay = "<?php echo $is_Autoplay; ?>">
                    <ul class="slides">
                        <?php
                        while ($kopa_big_post->have_posts()):
                            $kopa_big_post->the_post();
                            $post_format = get_post_format(get_the_ID());
                            if ($post_format == '') {
                                $post_format = 'standard';
                            }
                            ?>
                            <li class="<?php echo $post_format; ?>-post">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('kopa-image-size-0'); ?>    
                                        </a>
                                    </div>
                                <?php } ?>
                                <!-- entry-thumb -->
                                <div class="entry-content">
                                    <span class="h-line"></span>
                                    <header class="clearfix">
                                        <span class="entry-icon pull-left text-center"><span class="fa fa-camera-retro"></span></span>
                                        <div class="header-content">
                                            <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="bottom-line"></span></h6>
                                            <?php if (get_the_category()) { ?>
                                                <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                                            <?php } // endif ?>
                                            <?php if (get_the_tags()) { ?>
                                                <span class="entry-tags"><span class="entry-bullet"></span><?php echo __('Tags:', kopa_get_domain()); ?> <?php the_tags('', ', ', ''); ?></span>
                                            <?php } // endif  ?>
                                        </div>
                                        <!-- header-content -->
                                    </header>
                                    <?php the_excerpt(); ?>
                                </div>
                                <!-- entry-content -->
                            </li>


                            <?php
                        endwhile;
                        ?>
                    </ul>
                    <!-- slides -->
                </div>
                <!-- kp-blogpost-slider -->
            </article>

            <?php
        endif;
        wp_reset_postdata();
        ?>
        <?php
        
            $kopa_query_args_small['categories'] = $instance['categories'];
            $kopa_query_args_small['relation'] = $instance['relation'];
            $kopa_query_args_small['tags'] = $instance['tags'];
            $kopa_query_args_small['posts_per_page'] = $smallpost;
            $kopa_query_args_small['orderby'] = $instance['orderby'];
            $kopa_query_args_small['post__not_in'] = $not_in_small;
			if (isset($instance['kopa_timestamp'])){
					$kopa_query_args_small['date_query'] = $instance['kopa_timestamp'];
				}
        
            
        $kopa_small_post = kopa_widget_posttype_build_query($kopa_query_args_small);
        
        if ($kopa_small_post->have_posts()):
            ?>
            <div class="masonry-wrapper">
                <div class="v-line"></div>
                <ul class="older-post masonry-container transitions-enabled centered clearfix masonry">
                    <?php while ($kopa_small_post->have_posts()):$kopa_small_post->the_post();
                        ?>

                        <li class="masonry-box">
                            <article class="entry-item clearfix">

                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="entry-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('kopa-image-size-1'); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <!-- entry-thumb -->
                                <div class="entry-content">
                                    <header>
                                        <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                        <?php if (get_the_category()) { ?>
                                            <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                                        <?php } // endif ?>
                                        <?php if (get_the_tags()) { ?>
                                            <span class="entry-tags"><span class="entry-bullet"></span><?php echo __('Tags:', kopa_get_domain()); ?> <?php the_tags('', ', ', ''); ?></span>
                                        <?php } // endif ?>
                                    </header>
                                </div>
                                <!-- entry-content -->
                            </article>
                            <!-- entry-item -->
                        </li>

                    <?php endwhile; ?>

                </ul>
                <!-- older-post -->
            </div>
            <?php
        endif;
        wp_reset_postdata();
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
		$instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        $instance['animation'] = $new_instance['animation'];
        $instance['direction'] = $new_instance['direction'];
        $instance['slideshowSpeed'] = $new_instance['slideshowSpeed'];
        $instance['animationSpeed'] = $new_instance['animationSpeed'];
        $instance['isAutoplay'] =  isset($new_instance['isAutoplay']) ? $new_instance['isAutoplay']: 'false';
        
        return $instance;
    }

    function form($instance) {
        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 8,
            'orderby' => 'latest',
			'kopa_timestamp' => '',
            'animation' => 'slide',
            'direction' => 'horizontal',
            'slideshowSpeed' => 7000,
            'animationSpeed' => 600,
            'isAutoplay' => 'true',
            
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['animation'] = $instance['animation'];
        $form['direction'] = $instance['direction'];
        $form['slideshowSpeed'] = (int) $instance['slideshowSpeed'];
        $form['animationSpeed'] = (int) $instance['animationSpeed'];
		$form['kopa_timestamp'] = $instance['kopa_timestamp'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <div class="kopa-one-half">
            <p>
                <label for="<?php echo $this->get_field_id('categories'); ?>"><?php echo __('Categories:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php echo __('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, (isset($form['categories']) ? $form['categories'] : array())) ) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('relation'); ?>"><?php echo __('Relation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                    <?php
                    $relation = array(
                        'AND' => __('And', kopa_get_domain()),
                        'OR' => __('Or', kopa_get_domain())
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tags'); ?>"><?php echo __('Tags:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php echo __('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $tags = get_tags();
                    foreach ($tags as $tag) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, (isset($form['tags']) ? $form['tags'] : array()))) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php echo __('Number of articles', kopa_get_domain()); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" type="number" value="<?php echo $form['number_of_article']; ?>" />

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php echo __('Orderby:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                    <?php
                    $orderby = array(
                        'latest' => __('Latest', kopa_get_domain()),
                        'popular' => __('Popular by View Count', kopa_get_domain()),
                        'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                        'random' => __('Random', kopa_get_domain()),
                    );
                    foreach ($orderby as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
			<?php 
			kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']);?>

        </div>
        <div class="kopa-one-half last">
            <p>
                <label for="<?php echo $this->get_field_id('animation'); ?>"><?php echo __('Animation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>" autocomplete="off">
                    <?php
                    $relation = array(
                        'fade' => __('Fade', kopa_get_domain()),
                        'slide' => __('Slide', kopa_get_domain())
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['animation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('direction'); ?>"><?php echo __('Direction:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('direction'); ?>" name="<?php echo $this->get_field_name('direction'); ?>" autocomplete="off">
                    <?php
                    $relation = array(
                        'horizontal' => __('Horizontal', kopa_get_domain()),
                        
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['direction']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('slideshowSpeed'); ?>"><?php echo __('Slideshow Speed (ms):', kopa_get_domain()); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('slideshowSpeed'); ?>" name="<?php echo $this->get_field_name('slideshowSpeed'); ?>" type="number" value="<?php echo $form['slideshowSpeed'] ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('animationSpeed'); ?>"><?php echo __('Animation Speed (ms):', kopa_get_domain()); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('animationSpeed'); ?>" name="<?php echo $this->get_field_name('animationSpeed'); ?>" type="number" value="<?php echo $form['animationSpeed'] ?>" />
            </p>

            <p>
                <input class="checkbox" type="checkbox" <?php checked($instance['isAutoplay'], 'true',true); ?> id="<?php echo $this->get_field_id('isAutoplay'); ?>" name="<?php echo $this->get_field_name('isAutoplay'); ?>" value="true" /> 
                <label for="<?php echo $this->get_field_id('isAutoplay'); ?>"><?php echo __('Auto play slider', kopa_get_domain()); ?> </label>
            </p>
            
        </div>
        <div class="kopa-clear"></div>
        <?php
    }

}

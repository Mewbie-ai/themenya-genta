<?php

class kopa_topping_widget extends WP_Widget {             //mỗi page slider là 1 category

    function __construct() {
        $widget_ops = array('classname' => 'kp-topping-widget', 'description' => __('A slider of posts, each slide shows posts from one category of selected categories',  kopa_get_domain()));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kp-topping-widget', __('Kopa Topping Slider',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $categories = array();
        $categories = $instance['categories'];
        $animation = $instance['animation'];
        $direction = $instance['direction'];
        
        if(!empty($categories)){
        
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        
        ?>
        
        <div class="flexslider kp-topping-slider loading" data-animation = "<?php echo $animation; ?>" data-direction = "<?php echo $direction; ?>">
            <ul class="slides">
                <?php
                foreach ($categories as $cate):
                    $cat = (int) $cate;
                    
                        $kopa_query_args['categories'] = $cate;
                        $kopa_query_args['posts_per_page'] = (int) $instance['number_of_article'];
                        $kopa_query_args['orderby'] = $instance['orderby'];
                        if (isset($instance['kopa_timestamp'])){
							$kopa_query_args['date_query'] = $instance['kopa_timestamp'];
						}
                    
                    $kopa_slider = kopa_widget_posttype_build_query($kopa_query_args);
                    
                    ?>
                    <li>
                        <ul>
                            <?php
                            if ($kopa_slider->have_posts()):
                                ?>

                                <?php
                                while ($kopa_slider->have_posts()):
                                    $kopa_slider->the_post();
                                    ?>
                                    <li>
                                        <article class="entry-item clearfix">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="entry-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                        the_post_thumbnail('kopa-image-size-1');
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="entry-content">
                                                <header>
                                                    <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>

                                                    <?php if (get_the_category()) { ?>
                                                        <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                                                    <?php } // endif ?>
                                                   <?php if(comments_open()){ ?>
                                                <span class="entry-comments"><span class="entry-bullet"></span><?php echo __('Comments', kopa_get_domain()); ?>: <?php comments_popup_link(__('0',kopa_get_domain()), __('1',kopa_get_domain()), __('%',kopa_get_domain())); ?>  </span>
                                                <?php } ?>
                                                </header>
                                            </div>
                                        </article>
                                    </li>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </li>
                    <?php
                endforeach;
                ?>  
            </ul>
        </div>
        <?php
        
        echo $after_widget;
        }
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);

        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['animation'] = $new_instance['animation'];
        $instance['direction'] = $new_instance['direction'];
		$instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        return $instance;
    }

    function form($instance) {

        $default = array(
            'title' => __('Topping chart',  kopa_get_domain()),
            'categories' => array(),
            'number_of_article' => 4,
            'orderby' => 'latest',
            'animation' => '',
            'direction' => '',
			'kopa_timestamp' => ''
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);

        $form['categories'] = $instance['categories'];

        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['animation'] = $instance['animation'];
        $form['direction'] = $instance['direction'];
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
                        'vertical' => __('Vertical', kopa_get_domain())
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['direction']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
        </div>
        <div class="kopa-clear"></div>
        <?php
                    
    }

}

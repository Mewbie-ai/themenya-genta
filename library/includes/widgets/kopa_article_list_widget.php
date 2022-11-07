<?php

class kopa_article_list_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-article-list-widget', 'description' => __('Display your article list widget',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-article-list-widget', __('Kopa Article List',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);



        
            $big_query_args['categories'] = $instance['categories'];
            $big_query_args['relation'] = $instance['relation'];
            $big_query_args['tags'] = $instance['tags'];
            $big_query_args['posts_per_page'] = 1;
            $big_query_args['orderby'] = $instance['orderby'];
            if (isset($instance['kopa_timestamp'])){
					$big_query_args['date_query'] = $instance['kopa_timestamp'];
				}
        
        
        $big_post = kopa_widget_posttype_build_query($big_query_args);
       
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>
        
        <?php if ($big_post->have_posts()):while ($big_post->have_posts()): $big_post->the_post(); ?>
                <article class="entry-item last-item clearfix">

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
                            <?php $category = get_the_category(get_the_ID()); ?>
                            <?php if (get_the_category()) { ?>
                                <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                            <?php } // endif ?>
                            <?php if (get_the_tags()) { ?>
                                <span class="entry-tags"><span class="entry-bullet"></span><?php echo __('Tags:', kopa_get_domain()); ?> <?php the_tags('', ', ', ''); ?></span>
                            <?php } // endif ?>

                        </header>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="more-link kp-button"><span><?php echo __('Read More', kopa_get_domain()); ?></span></a>
                    </div>
                    <!-- entry-content -->
                </article>

                <?php
            endwhile;
        endif;

        wp_reset_postdata();
        ?>

        <?php
        if($instance['number_of_article'] > 1){
            $small_query_args['categories'] = $instance['categories'];
            $small_query_args['relation'] = $instance['relation'];
            $small_query_args['tags'] = $instance['tags'];
            $small_query_args['posts_per_page'] = (int) $instance['number_of_article'] - 1;
            $small_query_args['orderby'] = $instance['orderby'];
            $small_query_args['ignore_sticky_posts'] = 1;
			if (isset($instance['kopa_timestamp'])){
					$small_query_args['date_query'] = $instance['kopa_timestamp'];
				}
			if($big_post->have_posts()){
            $small_query_args['post__not_in'] = array($big_post->post->ID);
			}
       
        $small_post = kopa_widget_posttype_build_query($small_query_args);  
        if ($small_post->have_posts()):
            ?>
            <ul class="older-post">
            <?php while ($small_post->have_posts()):$small_post->the_post(); ?>
                    <li>
                        <article class="entry-item clearfix">
                <?php if (has_post_thumbnail()) { ?>
                                <div class="entry-thumb">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('kopa-image-size-1'); ?></a>
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
                <?php } // endif  ?>
                                </header>
                            </div>
                            <!-- entry-content -->
                        </article>
                        <!-- entry-item -->
                    </li>


                    <?php
                endwhile;
                ?>
            </ul>
            <?php
        endif;
        wp_reset_postdata();
		}
        ?>

        <div class="clear"></div>    
        <?php
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
        return $instance;
    }

    function form($instance) {

        $default = array(
            'title' => '',
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 4,
            'orderby' => 'latest',
			'kopa_timestamp' => ''
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
		$form['kopa_timestamp'] = $instance['kopa_timestamp'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

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

        
        <?php
    }

}
?>

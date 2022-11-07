<?php

class kopa_combo_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-accordion-widget', 'description' => __('Display your popular posts, recent posts, popular by comment posts and random posts',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-accordion-widget', __('Kopa Combo Widget',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        echo $before_widget;

        $kopa_tab_args = array();
        if ($instance['title1']) {
            $kopa_tab_args[] = array(
                'label' => $instance['title1'],
                'orderby' => 'date',
                'post_per_page' => $instance['num1']
            );
        }

        if ($instance['title2']) {
            $kopa_tab_args[] = array(
                'label' => $instance['title2'],
                'orderby' => 'popular',
                'post_per_page' => $instance['num2']
            );
        }

        if ($instance['title3']) {
            $kopa_tab_args[] = array(
                'label' => $instance['title3'],
                'orderby' => 'most_comment',
                'post_per_page' => $instance['num3']
            );
        }

        if ($instance['title4']) {
            $kopa_tab_args[] = array(
                'label' => $instance['title4'],
                'orderby' => 'random',
                'post_per_page' => $instance['num4']
            );
        }
        ?>
        <div class="acc-wrapper">
            <?php foreach ($kopa_tab_args as $kopa_tab_arg) { ?>
                <?php
                $kopa_query['posts_per_page'] = $kopa_tab_arg['post_per_page'];
                $kopa_query['orderby'] = $kopa_tab_arg['orderby'];
				if (isset($instance['kopa_timestamp'])){
					$kopa_query['date_query'] = $instance['kopa_timestamp'];
				}
                $kopa_my_query = kopa_widget_posttype_build_query($kopa_query);
                ?>
                <div class="accordion-title">
                    <h3><a href="#"><?php echo $kopa_tab_arg['label']; ?></a></h3>
                    <span>+</span>
                </div>
                <div class="accordion-container">
                    <ul>
                        <?php
                        if ($kopa_my_query->have_posts()): while ($kopa_my_query->have_posts()): $kopa_my_query->the_post();
                                ?>
                                <li>
                                    <article class="entry-item clearfix">
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="entry-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('kopa-image-size-1'); ?>  
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="entry-content">
                                            <header>
                                                <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                <?php if (get_the_category()) { ?>
                                                    <span class="entry-categories"><?php echo __('Posted in:', kopa_get_domain()); ?> <?php the_category(', '); ?></span>
                                                <?php } // endif  ?>
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
                </div>
            <?php } ?>

        </div>

        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title1'] = strip_tags($new_instance['title1']);
        $instance['num1'] = strip_tags($new_instance['num1']);
        $instance['title2'] = strip_tags($new_instance['title2']);
        $instance['num2'] = strip_tags($new_instance['num2']);
        $instance['title3'] = strip_tags($new_instance['title3']);
        $instance['num3'] = strip_tags($new_instance['num3']);
        $instance['title4'] = strip_tags($new_instance['title4']);
        $instance['num4'] = strip_tags($new_instance['num4']);
		$instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        return $instance;
    }

    function form($instance) {
	
        $instance = wp_parse_args((array) $instance, array(
            'title1' => __('Latest',  kopa_get_domain()), 
            'num1' => 5, 
            'title2' => __('Popular',  kopa_get_domain()), 
            'num2' => 5, 
            'title3' => __('Most comment',  kopa_get_domain()), 
            'num3' => 5, 
            'title4' => __('Random',  kopa_get_domain()), 
            'num4' => 5,
			'kopa_timestamp' => '',));
        $title1 = strip_tags($instance['title1']);
        $num1 = strip_tags($instance['num1']);
        $title2 = strip_tags($instance['title2']);
        $num2 = strip_tags($instance['num2']);
        $title3 = strip_tags($instance['title3']);
        $num3 = strip_tags($instance['num3']);
        $title4 = strip_tags($instance['title4']);
        $num4 = strip_tags($instance['num4']);
		$form['kopa_timestamp'] = $instance['kopa_timestamp'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title1'); ?>"><?php echo __('Latest post title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('num1'); ?>"><?php echo __('Number of latest posts', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num1'); ?>" name="<?php echo $this->get_field_name('num1'); ?>" type="number" value="<?php echo $num1; ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title2'); ?>"><?php echo __('Most viewed title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('num2'); ?>"><?php echo __('Number of most viewed posts', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num2'); ?>" name="<?php echo $this->get_field_name('num2'); ?>" type="number" value="<?php echo $num2; ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title3'); ?>"><?php echo __('Most comment title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('num3'); ?>"><?php echo __('Number of most comment posts', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num3'); ?>" name="<?php echo $this->get_field_name('num3'); ?>" type="number" value="<?php echo $num3; ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title4'); ?>"><?php echo __('Random title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('num4'); ?>"><?php echo __('Number of random posts', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num4'); ?>" name="<?php echo $this->get_field_name('num4'); ?>" type="number" value="<?php echo $num4; ?>" />

        </p>
		
		<?php 
		kopa_print_timeago($this->get_field_id('kopa_timestamp'), $this->get_field_name('kopa_timestamp'), $form['kopa_timestamp']);?>

        <?php
    }

}

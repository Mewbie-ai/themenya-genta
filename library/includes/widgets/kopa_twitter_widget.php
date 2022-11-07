<?php

class kopa_twitter_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-twitter-widget', 'description' => __('Latest Tweet',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-twitter-widget', __('Kopa Latest Tweet',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $username = $instance['username'];
        $number_of_tweets = $instance['number_of_tweets'];
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title .  $title  . $after_title;
        }
        ?>
        
        <div class="tweets clearfix" data-username ="<?php echo $username;?>" data-number-tweets ="<?php echo $number_of_tweets; ?>" ></div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['number_of_tweets'] = $new_instance['number_of_tweets'];
        return $instance;
    }

    function form($instance) {

        $instance = wp_parse_args((array) $instance, array(
            'title' => '', 
            'username' => '',
            'number_of_tweets'=>2
            ));
        $title = strip_tags($instance['title']);
        $username = $instance['username'];
        $number_of_tweets = $instance['number_of_tweets'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php echo __('Username:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_tweets'); ?>"><?php echo __('Number of tweets', kopa_get_domain()); ?></label>
            <input id="<?php echo $this->get_field_id('number_of_tweets'); ?>" name="<?php echo $this->get_field_name('number_of_tweets'); ?>" type="number" value="<?php echo $number_of_tweets; ?>" />

        </p>

        <?php
    }

}
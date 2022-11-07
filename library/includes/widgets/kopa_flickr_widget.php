<?php

class Kopa_Flickr_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-flickr-widget', 'description' => __('Display images from Flickr',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-flickr-widget', __('Kopa Flickr',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $id = strip_tags($instance['id']);
        $number_images = $instance['number_of_images'];
        
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>
        <div class="flickr-wrap clearfix" id="flickr-feed-1" data-limit = "<?php echo $number_images; ?>" data-flickr-id = "<?php echo $id; ?>">                    
            <ul class="kopa-flickr-widget clearfix"></ul>
        </div>
        
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['id'] = strip_tags($new_instance['id']);
        $instance['number_of_images'] = $new_instance['number_of_images'];
        return $instance;
    }

    function form($instance) {

        $instance = wp_parse_args((array) $instance, array(
            'title' => __('Flickr',  kopa_get_domain()), 
            'id' => '',
            'number_of_images'=>6,
            ));
        $title = strip_tags($instance['title']);
        $id = strip_tags($instance['id']);
        $number_of_images =  $instance['number_of_images'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php echo __('ID:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo esc_attr($id); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_images'); ?>"><?php echo __('Number of images', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_images'); ?>" name="<?php echo $this->get_field_name('number_of_images'); ?>" type="number" value="<?php echo $number_of_images; ?>" />

        </p>
        <?php
    }

}

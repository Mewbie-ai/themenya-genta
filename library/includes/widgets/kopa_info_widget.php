<?php

class kopa_info_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Your site description, address, phone and email',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_info', __('Kopa Info Widget',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title  . $after_title;
        }
        ?>
        <div class="textwidget">
            <p><?php echo $instance['description']; ?></p>

            <div class="contact-info">
                <p><span class="fa fa-map-marker entry-icon"></span><span><?php echo $instance['address']; ?></span></p>
                <p><span class="fa fa-phone entry-icon"></span><a href="#"><?php echo $instance['phone']; ?></a></p>
                <p><span class="fa fa-envelope entry-icon"></span><a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></p>
            </div>
            <!-- contact-info -->
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $instance['address'] = strip_tags($new_instance['address']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['email'] = strip_tags($new_instance['email']);

        return $instance;
    }

    function form($instance) {
        $default = array(
            'title'       => '',
            'description' => '',
            'address'     => '',
            'phone'       => '',
            'email'       => ''
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $description = strip_tags($instance['description']);
        $address = strip_tags($instance['address']);
        $phone = strip_tags($instance['phone']);
        $email = strip_tags($instance['email']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php echo __('Description:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo esc_attr($description); ?>" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php echo __('Address:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php echo __('Phone:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php echo __('Email:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />

        </p>

        <?php
    }

}
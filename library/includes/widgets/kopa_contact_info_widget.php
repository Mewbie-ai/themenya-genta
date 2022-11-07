<?php
class Kopa_Widget_Contact_Info extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kp-contact-box', 'description' => __('Your fullwidth contact info widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_contact_info', __('Kopa Contact Info Widget', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $before_widget;

        ?>
        
        <div class="section-title text-center">
            <?php if ( ! empty( $title ) ) { ?>
            <h4 class="big-caption">
                <span class="bold-line"><span></span></span>
                <span class="solid-line"></span>
                <span class="text-title"><?php echo $title; ?></span>
            </h4>
            <?php } ?>

            <p><?php echo $instance['description']; ?></p>
        </div>
        
        <ul class="text-center">
            <?php if ( ! empty( $instance['phone'] ) ) { ?>
            <li class="text-center clearfix">
                <div class="contact-icon hi-icon-effect-3 hi-icon-effect-3b">
                    <span class="hi-icon fa fa-mobile-phone"></span>
                </div><!--contact-icon-->
                <div class="contact-detail"><?php echo $instance['phone']; ?></div>
            </li>
            <?php } ?>

            <?php if ( ! empty( $instance['email'] ) ) { ?>
            <li class="text-center clearfix">
                <div class="contact-icon hi-icon-effect-3 hi-icon-effect-3b">
                    <span class="hi-icon fa fa-envelope-o"></span>
                </div><!--contact-icon-->
                <div class="contact-detail"><a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></div>
            </li>
            <?php } ?>

            <?php if ( ! empty( $instance['address'] ) ) { ?>
            <li class="text-center clearfix">
                <div class="contact-icon hi-icon-effect-3 hi-icon-effect-3b">
                    <span class="hi-icon fa fa-map-marker"></span>
                </div><!--contact-icon-->
                <div class="contact-detail"><span><?php echo $instance['address']; ?></span></div>
            </li>
            <?php } ?>
        </ul>

        <?php

        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title'       => '',
            'description' => '',
            'phone'       => '',
            'email'       => '',
            'address'     => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', kopa_get_domain() ); ?></label>
            <textarea class="widefat" name="<?php echo $this->get_field_name( 'description' ); ?>" id="<?php echo $this->get_field_id( 'description' ); ?>" rows="5"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Phone:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $instance['phone'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $instance['email'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Address:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $instance['address'] ); ?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        $instance['phone'] = strip_tags( $new_instance['phone'] );
        $instance['email'] = strip_tags( $new_instance['email'] );
        $instance['address'] = strip_tags( $new_instance['address'] );

        return $instance;
    }
}
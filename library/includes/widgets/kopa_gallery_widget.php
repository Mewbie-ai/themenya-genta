<?php

class kopa_gallery_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-gallery-widget', 'description' => __('Display a gallery from a specific gallery post-format post',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-gallery-widget', __('Kopa Gallery',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $gallery = $instance['kpgallery'];
        $animation = $instance['animation'];
        $direction = $instance['direction'];
        $slideshowSpeed = $instance['slideshowSpeed'];
        $animationSpeed = $instance['animationSpeed'];
        $is_Autoplay = $instance['isAutoplay'];
       

        $gal_content_post = get_post($gallery);
        $gal_content = $gal_content_post->post_content;
        $gal_ids = kopa_content_get_gallery_attachment_ids($gal_content);
        ?>

        <?php
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>
        <div class="flexslider kp-gallery-slider loading" data-animation = "<?php echo $animation; ?>" data-direction = "<?php echo $direction; ?>" data-slideshow-speed = "<?php echo $slideshowSpeed; ?>" data-animation-speed = "<?php echo $animationSpeed; ?>" data-autoplay = "<?php echo $is_Autoplay; ?>">
            <ul class="slides">
                <?php
                foreach ($gal_ids as $id):
                    if (wp_attachment_is_image($id)) {
                        ?>
                        <li><?php
                            echo wp_get_attachment_image($id, 'kopa-image-size-2');
                            if (get_post_field('post_excerpt', $id)) {
                                ?>
                                <div class="kp-gallery-caption " style="text-align: center" >
                                    <?php
                                    echo get_post_field('post_excerpt', $id);
                                    ?>

                                </div>
                            <?php } // endif  ?>
                        </li>
                        <?php
                    }
                    ?>

                <?php endforeach; ?>
            </ul>
            <!--slides -->
        </div><!--flexslider -->
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['kpgallery'] = $new_instance['kpgallery'];
        $instance['animation'] = $new_instance['animation'];
        $instance['direction'] = $new_instance['direction'];
        $instance['slideshowSpeed'] = $new_instance['slideshowSpeed'];
        $instance['animationSpeed'] = $new_instance['animationSpeed'];
        $instance['isAutoplay'] = isset( $new_instance['isAutoplay'] ) ? $new_instance['isAutoplay'] : 'false';
        
        return $instance;
    }

    function form($instance) {

        $default = array(
            'title' => __('Gallery',  kopa_get_domain()),
            'kpgallery' => '',
            'animation' => 'slide',
            'direction' => 'horizontal',
            'slideshowSpeed' => 7000,
            'animationSpeed' => 600,
            'isAutoplay' =>'true'
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);
        $form['kpgallery'] = $instance['kpgallery'];
        $form['animation'] = $instance['animation'];
        $form['direction'] = $instance['direction'];
        $form['slideshowSpeed'] = (int) $instance['slideshowSpeed'];
        $form['animationSpeed'] = (int) $instance['animationSpeed'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('kpgallery'); ?>"><?php echo __('Gallery:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('kpgallery'); ?>" name="<?php echo $this->get_field_name('kpgallery'); ?>"  autocomplete="off">
                <option value=""><?php echo __('-- None --', kopa_get_domain()); ?></option>
                <?php
                $gallery_post = get_posts(array('post_format' => 'post-format-gallery'));
                foreach ($gallery_post as $key => $value):
                    printf('<option value="%1$s" %3$s>%2$s </option>', $value->ID, $value->post_title, ($value->ID == $form['kpgallery'] ) ? 'selected="selected"' : '');

                endforeach;
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('animation'); ?>"><?php echo __('Animation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>" autocomplete="off" >
                <?php
                $relation = array(
                    'fade' => __('Fade', kopa_get_domain()),
                    'slide' => __('Slide', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option id="%4$s" value="%1$s" %3$s >%2$s</option>', $value, $title, ($value === $form['animation']) ? 'selected="selected"' : '', $value);
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
                    printf('<option value="%1$s" %3$s  >%2$s</option>', $value, $title, ($value === $form['direction']) ? 'selected="selected"' : '');
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
            <input class="checkbox" type="checkbox" <?php checked($instance['isAutoplay'], 'true'); ?> id="<?php echo $this->get_field_id('isAutoplay'); ?>" name="<?php echo $this->get_field_name('isAutoplay'); ?>" value="true" /> 
            <label for="<?php echo $this->get_field_id('isAutoplay'); ?>"><?php echo __('Auto play slider', kopa_get_domain()); ?> </label>
        </p>
        <?php
    }

}

<?php

class kopa_socials_link_widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'kp-socials-widget', 'description' => __('A social links widget',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-socials-widget', __('Kopa Socials Link',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $temp = array('rss', 'twitter', 'facebook', 'gplus');
        $socials = array();

        foreach ($temp as $value):
            $option = 'kopa_theme_options_social_links_' . $value . '_url';
            $socials[$value] = kopa_get_option($option);  
        endforeach;
        $location = $instance['location'];
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title  . $after_title;
        }
        ?>
        <ul class="clearfix">
            <?php
            if ($location == 'bottom') {
                foreach ($socials as $key => $value):
                    if ($value == 'HIDE'):
                        continue;
                    endif;
                    if ($value == '') {
                        if ($key == 'rss') {
                            ?>
                            <li><a href="<?php echo bloginfo('rss2_url'); ?>" class="fa fa-<?php echo $key; ?>"></a></li>
                            <?php
                            continue;
                        } else {
                            continue;
                        }
                    }
                    ?>
                    <?php if ($key != 'gplus') { ?>
                        <li><a href="<?php echo esc_url($value); ?>" class="fa fa-<?php echo $key; ?>"></a></li>
                        <?php continue;
                    } ?>
                    <?php if ($key == 'gplus') { ?>
                        <li><a href="<?php echo esc_url($value); ?>" class="fa fa-google-plus"></a></li>
                        <?php continue;
                    } ?>
                    <?php
                endforeach;
            } else {

                foreach ($socials as $key => $value):
                    if ($value == 'HIDE'):
                        continue;
                    endif;
                    if ($value == '') {
                        if ($key == 'rss') {
                            ?>
                            <li class ="<?php echo $key; ?>-icon text-center"><a href="<?php echo bloginfo('rss2_url'); ?>" class="fa fa-<?php echo $key; ?>"></a></li>
                            <?php
                            continue;
                        } else {
                            continue;
                        }
                    }
                    ?>
                    <?php if ($key != 'gplus') { ?>
                        <li class ="<?php echo $key; ?>-icon text-center"><a href="<?php echo esc_url($value); ?>" class="fa fa-<?php echo $key; ?>"></a></li>
                        <?php continue;
                    } ?>
                    <?php if ($key == 'gplus') { ?>
                        <li class ="<?php echo $key; ?>-icon text-center"><a href="<?php echo esc_url($value); ?>" class="fa fa-google-plus"></a></li>
                        <?php continue;
                    } ?>
                <?php
            endforeach;
        }
        ?>
        </ul>

        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['location'] = $new_instance['location'];
        return $instance;
    }

    function form($instance) {

        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'location' => 'bottom'
        ));
        $title = strip_tags($instance['title']);

        $location = $instance['location'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

        </p>


        <p>
            <label for="<?php echo $this->get_field_id('location'); ?>"><?php echo __('Location:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'bottom' => __('Bottom sidebar', kopa_get_domain()),
                    'right' => __('Right sidebar', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value == $location) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>



        <?php
    }

}

<?php

class kopa_headline_wrapper_widget extends WP_Widget{
    function __construct() {
        $widget_ops = array('classname' => 'kp-headline-wrapper clearfix', 'description' => __('Headline running',  kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kp-headline-wrapper', __('Kopa Headline Slide',  kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        
            $kopa_query_args['categories'] = $instance['categories'];
            $kopa_query_args['posts_per_page'] = (int) $instance['number_of_article'];
            $kopa_query_args['orderby'] = $instance['orderby'];
            if (isset($instance['kopa_timestamp'])){
					$kopa_query_args['date_query'] = $instance['kopa_timestamp'];
				}
	
       
        if(!empty($instance['categories'])){
        echo $before_widget;
         if (!empty($title)) {
            echo '<span class="kp-headline-title"> '. $title . '</span>';}
        ?>

        <?php
         $kopa_slider = kopa_widget_posttype_build_query($kopa_query_args);
        if ($kopa_slider->have_posts()):
            ?>
            <div class="kp-headline clearfix">                        
                        <dl class="ticker-1 clearfix">
                            <?php
                            while($kopa_slider->have_posts()):
                                $kopa_slider->the_post();
                            ?>
                            <dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
                            <?php
                            endwhile;
                            ?>
                            
                            
                        </dl>
                        <!--ticker-1-->
                    </div>

        <?php
        endif;
        wp_reset_postdata();
        echo $after_widget;
        }
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
		$instance['kopa_timestamp'] = $new_instance['kopa_timestamp'];
        return $instance;
    }

    function form($instance) {

        $default = array(
            'title' => __('Breaking News',  kopa_get_domain()),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 3,
            'orderby' => 'lastest',
			'kopa_timestamp' => ''
        );
        $instance = wp_parse_args((array) $instance, $default);
        $title = strip_tags($instance['title']);

        $form['categories'] = $instance['categories'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
		$form['kopa_timestamp'] = $instance['kopa_timestamp'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php echo __('Categories:',  kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php echo __('-- None --',  kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, (isset($form['categories']) ? $form['categories'] : array())) ) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        

        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php echo __('Number of articles',  kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" type="number" value="<?php echo $form['number_of_article']; ?>" />

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php echo __('Orderby:',  kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'latest' => __('Latest',  kopa_get_domain()),
                    'popular' => __('Popular by View Count',  kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count',  kopa_get_domain()),
                    'random' => __('Random',  kopa_get_domain()),
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

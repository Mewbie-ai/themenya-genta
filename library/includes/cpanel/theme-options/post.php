<div id="tab-single-post" class="kopa-content-box tab-content tab-content-1">    

    
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Post Content', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        
        <div class="kopa-element-box kopa-theme-options">            
            <span class="kopa-component-title"><?php _e('Thumbnail Image', kopa_get_domain()); ?></span>
            <?php
            $thumbnail_image_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $thumbnail_image = "kopa_theme_options_thumbnail_image";
            foreach ($thumbnail_image_status as $value => $label):
                $thumbnail_image_id = $thumbnail_image . "_{$value}";
                ?>
                <label  for="<?php echo $thumbnail_image_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $thumbnail_image_id; ?>" name="kopa_theme_options[<?php echo $thumbnail_image; ?>]" <?php echo ($value == kopa_get_option($thumbnail_image)) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach
            ?>
        </div>
        
        
        <div class="kopa-element-box kopa-theme-options">            
            <span class="kopa-component-title"><?php _e('Previous/Next Post Link', kopa_get_domain()); ?></span>
            <?php
            $post_link_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $post_link = "kopa_theme_options_post_link";
            foreach ($post_link_status as $value => $label):
                $post_link_id = $post_link . "_{$value}";
                ?>
                <label  for="<?php echo $post_link_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $post_link_id; ?>" name="kopa_theme_options[<?php echo $post_link; ?>]" <?php echo ($value == kopa_get_option($post_link)) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach
            ?>
        </div>
        
    </div>
    
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('About Author', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $about_author_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $about_author_name = "kopa_theme_options_post_about_author";
            foreach ($about_author_status as $value => $label):
                $about_author_id = $about_author_name . "_{$value}";
                ?>
                <label  for="<?php echo $about_author_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $about_author_id; ?>" name="kopa_theme_options[<?php echo $about_author_name; ?>]" <?php echo ($value == kopa_get_option($about_author_name)) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach
            ?>
        </div>
    </div>
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Related Posts', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Get By', kopa_get_domain()); ?></span>
            <select class="" id="kopa_theme_options_post_related_get_by" name="kopa_theme_options[kopa_theme_options_post_related_get_by]">
                <?php
                $post_related_get_by = array(
                    'hide' => __('-- Hide --', kopa_get_domain()),
                    'post_tag' => __('Tag', kopa_get_domain()),
                    'category' => __('Category', kopa_get_domain())
                );
                foreach ($post_related_get_by as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value == kopa_get_option('kopa_theme_options_post_related_get_by')) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Limit', kopa_get_domain()); ?></span>
            <input type="number" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_post_related_limit') ); ?>" id="kopa_theme_options_post_related_limit" name="kopa_theme_options[kopa_theme_options_post_related_limit]">
        </div>
    </div><!--tab-theme-skin-->  

</div><!--tab-container-->
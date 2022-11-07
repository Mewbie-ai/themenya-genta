<div class="kopa-content-box tab-content tab-content-1" id="tab-general">

    <!--tab-logo-favicon-icon-->
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Logo, Favicon, Apple Icon, Banner', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">

            <p class="kopa-desc"><?php printf( __('Use <a href="%s">custom header</a> to upload logo image and change site title color.', kopa_get_domain()), admin_url('themes.php?page=custom-header') ); ?></p>                         
            <span class="kopa-component-title"><?php _e('Logo margin', kopa_get_domain()); ?></span>
            <label class="kopa-label"><?php _e('Top margin:', kopa_get_domain()); ?> </label>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_logo_margin_top') ); ?>" id="kopa_theme_options_logo_margin_top" name="kopa_theme_options[kopa_theme_options_logo_margin_top]" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Left margin:', kopa_get_domain()); ?> </label>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_logo_margin_left') ); ?>" id="kopa_theme_options_logo_margin_left" name="kopa_theme_options[kopa_theme_options_logo_margin_left]" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Right margin:', kopa_get_domain()); ?> </label>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_logo_margin_right') ); ?>" id="kopa_theme_options_logo_margin_right" name="kopa_theme_options[kopa_theme_options_logo_margin_right]" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Bottom margin:', kopa_get_domain()); ?> </label>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_logo_margin_bottom') ); ?>" id="kopa_theme_options_logo_margin_bottom" name="kopa_theme_options[kopa_theme_options_logo_margin_bottom]" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>
        </div><!--kopa-element-box-->

        <div class="kopa-element-box kopa-theme-options">
            
            <span class="kopa-component-title"><?php _e('Top Banner ', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Upload your top banner.', kopa_get_domain()); ?></p>                         
            <div class="clearfix">
                
                <textarea class="left" id="kopa_theme_options_top_banner_url" rows="5" name="kopa_theme_options[kopa_theme_options_top_banner_url]"><?php echo esc_textarea(kopa_get_option('kopa_theme_options_top_banner_url')); ?></textarea>
            </div>
            
            
        </div><!--kopa-element-box-->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Favicon', kopa_get_domain()); ?></span>

            <p class="kopa-desc"><?php _e('Upload your own favicon.', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_favicon_url') ); ?>" id="kopa_theme_options_favicon_url" name="kopa_theme_options[kopa_theme_options_favicon_url]">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_favicon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
        </div><!--kopa-element-box-->


        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Apple Icons', kopa_get_domain()); ?></span>

            <p class="kopa-desc"><?php _e('Iphone (57px - 57px)', kopa_get_domain()); ?></p>   
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_apple_iphone_icon_url') ); ?>" id="kopa_theme_options_apple_iphone_icon_url" name="kopa_theme_options[kopa_theme_options_apple_iphone_icon_url]">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
            <p class="kopa-desc"><?php _e('Iphone Retina (114px - 114px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_apple_iphone_retina_icon_url') ); ?>" id="kopa_theme_options_apple_iphone_retina_icon_url" name="kopa_theme_options[kopa_theme_options_apple_iphone_retina_icon_url]">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_retina_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad (72px - 72px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_apple_ipad_icon_url') ); ?>" id="kopa_theme_options_apple_ipad_icon_url" name="kopa_theme_options[kopa_theme_options_apple_ipad_icon_url]">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad Retina (144px - 144px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="" type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_apple_ipad_retina_icon_url') ); ?>" id="kopa_theme_options_apple_ipad_retina_icon_url" name="kopa_theme_options[kopa_theme_options_apple_ipad_retina_icon_url]">
                <button class="btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_retina_icon_url"><i class="icon-circle-arrow-up"></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
        </div><!--kopa-element-box-->


    </div><!--tab-logo-favicon-icon-->





    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Contact Information', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Phone number:', kopa_get_domain()); ?></span>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_phone_number') ); ?>" id="kopa_theme_options_phone_number" name="kopa_theme_options[kopa_theme_options_phone_number]">
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Address:', kopa_get_domain()); ?></span>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_address') ); ?>" id="kopa_theme_options_address" name="kopa_theme_options[kopa_theme_options_address]">
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Email:', kopa_get_domain()); ?></span>
            <input type="text" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_email') ); ?>" id="kopa_theme_options_email" name="kopa_theme_options[kopa_theme_options_email]">
        </div>
    </div>
    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Footer', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Custom Footer', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Enter the content you want to display in your footer (e.g. copyright text).', kopa_get_domain()); ?></p>    
            <textarea class="" rows="6" id="kopa_setting_copyrights" name="kopa_theme_options[kopa_theme_options_copyright]"><?php echo esc_textarea( kopa_get_option('kopa_theme_options_copyright') ); ?></textarea>
        </div><!--kopa-element-box-->


       

    </div>

</div><!--kopa-content-box-->


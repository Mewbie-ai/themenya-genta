<div id="tab-social-links" class="kopa-content-box tab-content tab-content-1">    

    <div class="kopa-box-head">
        <i class="icon-hand-right"></i>
        <span class="kopa-section-title"><?php _e('Social Links', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <!-- RSS -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('RSS URL', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Display the RSS feed button with the default RSS feed or enter a custom feed below. <br><code>Enter <b>"HIDE"</b> if you want to hide it</code>', kopa_get_domain()); ?></p>    
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_rss_url') ); ?>" id="kopa_theme_options_social_links_rss_url" name="kopa_theme_options[kopa_theme_options_social_links_rss_url]">                                                     
        </div><!--kopa-element-box-->

        <!-- FACEBOOK -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Facebook_URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_facebook_url') ); ?>" id="kopa_theme_options_social_links_facebook_url" name="kopa_theme_options[kopa_theme_options_social_links_facebook_url]">
        </div>

        <!-- TWITTER -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Twitter URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_twitter_url') ); ?>" id="kopa_theme_options_social_links_twitter_url" name="kopa_theme_options[kopa_theme_options_social_links_twitter_url]">
        </div>       
        <!-- GOOGLE PLUS -->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Google Plus URL', kopa_get_domain()); ?></span>
            <input type="url" value="<?php echo esc_attr( kopa_get_option('kopa_theme_options_social_links_gplus_url') ); ?>" id="kopa_theme_options_social_links_gplus_url" name="kopa_theme_options[kopa_theme_options_social_links_gplus_url]">
        </div>
        
        <p class="kopa-desc"><?php echo __('*Enter HIDE or leave blank to hide Facebook, Twitter or Google Plus link', kopa_get_domain()); ?></p>                         
        
    </div>

</div>

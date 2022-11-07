

<?php
if ( !defined('ABSPATH')) exit;


if (post_password_required() || !comments_open()) {
    return;
} // endif check pwd

if (have_comments()) {
    ?>
    <div id="comments">
        <h4><?php comments_number(); ?></h4>
        <ol class="comments-list clearfix">
            <?php
            wp_list_comments(array(
                'walker' => null,
                'style' => 'ul',
                'callback' => 'kopa_comment',
                'end-callback' => null,
                'type' => 'all'
            ));
            ?>
        </ol>

        <?php
        $prev_comments_link = get_previous_comments_link();
        $next_comments_link = get_next_comments_link();

        if ('' !== $prev_comments_link . $next_comments_link) {
            ?>
            <div class="pagination kopa-comment-pagination pull-right"> <?php paginate_comments_links(); ?></div>
        <?php } // endif  ?>
        <div class="clear"></div>
    </div>


    <?php
}
?>

<?php comment_form(kopa_comment_form_args()); ?>

<div class="r-color"></div>


<?php

function kopa_comment($comment, $args, $depth) {
     $GLOBALS['comment']=$comment;
     
     if ( 'pingback' == get_comment_type() || 'trackback' == get_comment_type() ) {
    ?>
    
    <li id="comment-<?php comment_ID(); ?>" class="comment clearfix">
        <article class="comment-wrap clearfix"> 
            <div class="comment-avatar">
                <?php echo get_avatar($comment->comment_author_email, 50); ?>
            </div>
            <div class="comment-body clearfix">
                <header class="clearfix">                                
                    <h6><?php _e( 'Pingback', kopa_get_domain() ); ?></h6>
                    <span class="entry-date pull-left"><?php comment_date(get_option('date_format')); ?><?php _e(' at ', kopa_get_domain()); ?> <?php comment_time(get_option('time_format')); ?></span>
                    <div class="comment-button pull-right">
                        <?php if ( current_user_can( 'moderate_comments' ) ) { edit_comment_link( __( 'Edit', kopa_get_domain() ) ); ?> /
                            <?php } ?>

                            
                    </div>
                    <div class="clear"></div>
                </header>
                <div class="comment-content">
                <?php comment_author_link(); ?>
                </div>
            </div><!--comment-body -->
        </article>                                                                     
    </li>
    
    
    
    <?php } elseif ( 'comment' == get_comment_type() ) {  ?> 
    <li id="comment-<?php comment_ID(); ?>" class="comment clearfix">
        <article class="comment-wrap clearfix"> 
            <div class="comment-avatar">
                <?php echo get_avatar($comment->comment_author_email, 50); ?>
            </div>
            <div class="comment-body clearfix">
                <header class="clearfix">                                
                    <h6><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></h6>
                    <span class="entry-date pull-left"><?php comment_date(get_option('date_format')); ?><?php _e(' at ', kopa_get_domain()); ?> <?php comment_time(get_option('time_format')); ?></span>
                    <div class="comment-button pull-right">
                        <?php if ( current_user_can( 'moderate_comments' ) ) { edit_comment_link( __( 'Edit', kopa_get_domain() ) ); ?> /
                            <?php } ?>

                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                    <div class="clear"></div>
                </header>
                <div class="comment-content">
                <?php comment_text(); ?>
                </div>
            </div><!--comment-body -->
        </article>                                                                     
    </li>
    <?php
    }
}

function kopa_comment_form_args() {
    global $user_identity;
    $commenter = wp_get_current_commenter();

    $fields = array(
        'author' => '<div class="comment-left pull-left">
                            <p class="input-block">
                                <label for="comment_name" class="required">'.__('Name',  kopa_get_domain()).' <span>*</span></label>
                                <input type="text" id="comment_name" name="author" class="valid">
                            </p>',
        'email' => '<p class="input-block">
                                <label for="comment_email" class="required">'.__('Email',  kopa_get_domain()).'<span>*</span></label>
                                <input type="text" id="comment_email" name="email" class="valid">
                            </p>',
        'url' => '<p class="input-block">                                                
                                <label for="comment_url" class="required">'.__('Website',  kopa_get_domain()).':</label>
                                <input type="text" name="url" class="valid" id="comment_url">                                                
                            </p>
                        </div>',
    );

    if (is_user_logged_in()) {
        $comment_field = '<p class="textarea-block">                        
                                <label for="comment_message" class="required">Your comment <span>*</span></label>
                                <textarea onfocus="if(this.value==\'Your comments *\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Your comments *\';" name="comment" id="comment_message" cols="88" rows="6">Your comments *</textarea>
                            </p>';
    } else {
    $comment_field = '<div class="comment-right pull-right">
                            <p class="textarea-block">                        
                                <label for="comment_message" class="required">Your comment <span>*</span></label>
                                <textarea onfocus="if(this.value==\'Your comments *\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\'Your comments *\';" name="comment" id="comment_message" cols="88" rows="6">Your comments *</textarea>
                            </p>
                        </div>';
    }
    
    $args = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => $comment_field,
        'logged_in_as' => '<p class="log-in-out">' . sprintf(__('Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', kopa_get_domain()), admin_url('profile.php'), esc_attr($user_identity)) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . esc_attr__('Log out of this account', kopa_get_domain()) . '">' . __('Log out &raquo;', kopa_get_domain()) . '</a></p><!-- .log-in-out -->',
        'comment_notes_before' => '<span class="c-note">Your email address will not be published. Required fields are marked *</span>',
        'comment_notes_after' => '<div class="clear"></div>',
        'id_form' => 'comments-form',
        'id_submit' => 'submit-comment',
        'title_reply' => __('Post your comments', kopa_get_domain()),
        // 'title_reply_to' => __('Reply to %s', kopa_get_domain()),
        // 'cancel_reply_link' => '<span class="title-text">'.__('Cancel', kopa_get_domain()).'</span>',
        'label_submit' => __('Post Comment', kopa_get_domain()),
    );

    return $args;
}
?>
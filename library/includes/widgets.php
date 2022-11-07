<?php

add_action( 'widgets_init', 'kopa_widgets_init' );

function kopa_widgets_init(){
    register_widget('Kopa_Flex_Slider_Widget');
    register_widget('Kopa_Flickr_Widget');
    register_widget('kopa_twitter_widget');
    register_widget('kopa_topping_widget');
    register_widget('kopa_headline_wrapper_widget');
    register_widget('kopa_featured_widget');
    register_widget('kopa_article_list_widget');
    register_widget('kopa_gallery_widget');
    register_widget('kopa_combo_widget');
    
    register_widget('kopa_info_widget');
    register_widget('Kopa_Widget_Contact_Info');
    register_widget('kopa_socials_link_widget');
    
    
   
    register_widget('kopa_flex_slider_thumb');
  }  
  
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_flex_slider_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_flickr_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_twitter_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_topping_slide_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_headline_slide_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_featured_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_article_list_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_gallery_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_combo_widget.php';
  
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_info_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_contact_info_widget.php';
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_socials_link_widget.php';

  
  
  require trailingslashit(get_template_directory()) . '/library/includes/widgets/kopa_flex_slider_2_widget.php';
  

function kopa_widget_posttype_build_query( $query_args = array() ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'orderby'        => '',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag',
        'offset'         => 0
    );

    $query_args = wp_parse_args( $query_args, $default_query_args );

    $args = array(
        'post_type'           => $query_args['post_type'],
        'posts_per_page'      => $query_args['posts_per_page'],
        'post__not_in'        => $query_args['post__not_in'],
        'ignore_sticky_posts' => $query_args['ignore_sticky_posts'],
        'offset'              => $query_args['offset']  
    );

    $tax_query = array();

    if ( $query_args['categories'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['cat_name'],
            'field'    => 'id',
            'terms'    => $query_args['categories']
        );
    }
    if ( $query_args['tags'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['tag_name'],
            'field'    => 'id',
            'terms'    => $query_args['tags']
        );
    }
    if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $query_args['orderby'] ) {
    case 'popular':
        $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
        $args['orderby'] = 'meta_value_num';
        break;
    case 'most_comment':
        $args['orderby'] = 'comment_count';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    default:
        $args['orderby'] = 'date';
        break;
    }
    
	 if ( isset($query_args['date_query']) && $query_args['date_query'] ){
        global $wp_version;
        $timestamp =  $query_args['date_query'];
        if (version_compare($wp_version, '3.7.0', '>=')) {
            if (isset($timestamp) && !empty($timestamp)) {
                $y = date('Y', strtotime($timestamp));
                $m = date('m', strtotime($timestamp));
                $d = date('d', strtotime($timestamp));
                $args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }
    }

	
    return new WP_Query( $args );
} 




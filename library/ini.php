<?php

//blog-right-sidebar-1
$kopa_layout = array(
    'front-page' => array(
        'title' => 'Front Page Style',
        'thumbnails' => 'home-right-sidebar.jpg',
        'positions' => array(
            'position_1',
            'position_2',
            'position_3',
            'position_4',
            'position_5',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    'page-right-sidebar' => array(
        'title' => 'Page Right Sidebar',
        'thumbnails' => 'page-right-sidebar.jpg',
        'positions' => array(
            'position_2',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    'single-right-sidebar' => array(
        'title' => 'Single Right Sidebar',
        'thumbnails' => 'single-right-sidebar.jpg',
        'positions' => array(
            'position_2',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    'blog-right-sidebar' => array(
        'title' => 'Blog Right Sidebar',
        'thumbnails' => 'blog-right-sidebar-1.jpg',
        'positions' => array(
            'position_9',
            'position_2',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    'blog-left-sidebar' => array(
        'title' => 'Blog Left Sidebar',
        'thumbnails' => 'blog-left-sidebar.jpg',
        'positions' => array(
            'position_9',
            'position_2',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    'blog-no-sidebar' => array(
        'title' => 'Blog No Sidebar',
        'thumbnails' => 'blog-no-sidebar.jpg',
        'positions' => array(
            'position_9',
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
    '404-page' => array(
        'title' => '404 Page',
        'thumbnails' => '404-page.jpg',
        'positions' => array(
            'position_6',
            'position_7',
            'position_8',
        ),
    ),
);

$kopa_sidebar_position = array(
    'position_1' => array('title' => 'Widget Area 1'),
    'position_2' => array('title' => 'Widget Area 2'),
    'position_3' => array('title' => 'Widget Area 3'),
    'position_4' => array('title' => 'Widget Area 4'),
    'position_5' => array('title' => 'Widget Area 5'),
    'position_6' => array('title' => 'Widget Area 6'),
    'position_7' => array('title' => 'Widget Area 7'),
    'position_8' => array('title' => 'Widget Area 8'),
    'position_9' => array('title' => 'Widget Area 9'),
);

$kopa_template_hierarchy = array(
    'home' => array(
        'title' => 'Home',
        'layout' => array('blog-right-sidebar', 'blog-left-sidebar', 'blog-no-sidebar')
    ),
    'front-page' => array(
        'title' => 'Front Page',
        'layout' => array('front-page')
    ),
    'post' => array(
        'title' => 'Post',
        'layout' => array('single-right-sidebar')
    ),
    'page' => array(
        'title' => 'Page',
        'layout' => array('front-page', 'page-right-sidebar')
    ),
    'taxonomy' => array(
        'title' => 'Taxonomy',
        'layout' => array('blog-right-sidebar', 'blog-left-sidebar', 'blog-no-sidebar')
    ),
    'search' => array(
        'title' => 'Search',
        'layout' => array('blog-right-sidebar', 'blog-left-sidebar', 'blog-no-sidebar')
    ),
    'archive' => array(
        'title' => 'Archive',
        'layout' => array('blog-right-sidebar', 'blog-left-sidebar', 'blog-no-sidebar')
    ),
    '_404' => array(
        'title' => '404',
        'layout' => array('404-page')
    ),
);

define('KOPA_INIT_VERSION', 'resolution-setting-version-2');
define('KOPA_LAYOUT', serialize($kopa_layout));
define('KOPA_SIDEBAR_POSITION', serialize($kopa_sidebar_position));
define('KOPA_TEMPLATE_HIERARCHY', serialize($kopa_template_hierarchy));
define('KOPA_DEFAULT_SETTING', serialize( array(
    'home' => array(
        'layout_id' => 'blog-right-sidebar',
        'sidebars' => array(
            'sidebar_9',
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'front-page' => array(
        'layout_id' => 'front-page',
        'sidebars' => array(
            'sidebar_1',
            'sidebar_2',
            'sidebar_3',
            'sidebar_4',
            'sidebar_5',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'post' => array(
        'layout_id' => 'single-right-sidebar',
        'sidebars' => array(
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'page' => array(
        'layout_id' => 'page-right-sidebar',
        'sidebars' => array(
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'taxonomy' => array(
        'layout_id' => 'blog-right-sidebar',
        'sidebars' => array(
            'sidebar_9',
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'search' => array(
        'layout_id' => 'blog-right-sidebar',
        'sidebars' => array(
            'sidebar_9',
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    'archive' => array(
        'layout_id' => 'blog-right-sidebar',
        'sidebars' => array(
            'sidebar_9',
            'sidebar_2',
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
    '_404' => array(
        'layout_id' => '404-page',
        'sidebars' => array(
            'sidebar_6',
            'sidebar_7',
            'sidebar_8'
        ),
    ),
) ) );
define('KOPA_DEFAULT_SIDEBAR', serialize( array(
    'sidebar_hide' => '-- None --',
    'sidebar_1'    => 'Sidebar 1',
    'sidebar_2'    => 'Sidebar 2',
    'sidebar_3'    => 'Sidebar 3',
    'sidebar_4'    => 'Sidebar 4',
    'sidebar_5'    => 'Sidebar 5',
    'sidebar_6'    => 'Sidebar 6',
    'sidebar_7'    => 'Sidebar 7',
    'sidebar_8'    => 'Sidebar 8',
    'sidebar_9'    => 'Sidebar 9',
) ) );

//register dynamic widget areas
add_action('widgets_init', 'kopa_register_sidebar');
function kopa_register_sidebar() {
    $kopa_sidebar = get_option('kopa_sidebar', unserialize( KOPA_DEFAULT_SIDEBAR ));

    foreach ($kopa_sidebar as $key => $value) {
        if ('sidebar_hide' != $key) {
            register_sidebar(array(
                'name' => $value,
                'id' => $key,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="widget-title">
                                        <span class="bold-line"><span></span></span>
                                        <span class="solid-line"></span><span class="text-title">',
                'after_title' => '</span></h4>'
            ));
        }
    }
}


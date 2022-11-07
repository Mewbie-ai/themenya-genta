<?php

define('KOPA_THEME_NAME', 'Resolution');
define('KOPA_DOMAIN', 'resolution');
define('KOPA_CPANEL_IMAGE_DIR', get_template_directory_uri() . '/library/images/layout/');

/*
 * Initialize admin page, register widgets
 */
require trailingslashit(get_template_directory()) . '/library/kopa.php';

/*
 * Initialize layout settings and dynamic sidebar settings
 */
require trailingslashit(get_template_directory()) . '/library/ini.php';

/*
 * Get google fonts array
 */
require trailingslashit(get_template_directory()) . '/library/includes/google-fonts.php';

/*
 * Contain all ajax functions that use in this theme 
 */
require trailingslashit(get_template_directory()) . '/library/includes/ajax.php';

/*
 * Dynamic layout options for post, page and category
 */
require trailingslashit(get_template_directory()) . '/library/includes/metabox/post.php';
require trailingslashit(get_template_directory()) . '/library/includes/metabox/category.php';
require trailingslashit(get_template_directory()) . '/library/includes/metabox/page.php';

/*
 * Set up theme defaults and registers support for various WordPress features.
 * Contain many utility functions for frontend
 */
require trailingslashit(get_template_directory()) . '/library/front.php';

/*
 * Custom Header
 */
require get_template_directory().'/library/custom-header.php';


<?php

if (have_posts()) {
    while (have_posts()) {
        the_post();
        kopa_breadcrumb();
        get_template_part('format-single', get_post_format());
        //author
        $about_author = kopa_get_option('kopa_theme_options_post_about_author');
        if ($about_author == 'show') {
            kopa_about_author();
        }
        //related
        kopa_get_related_articles();
        //comment
        comments_template();
    }
}
?>
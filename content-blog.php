
<div class="widget kp-entry-list-widget">
    <h4 class="widget-title">
        <span class="bold-line"><span></span></span>
        <span class="solid-line"></span>
        <span class="text-title">
        <?php if ( have_posts() ) {
            
            if ( is_home() ) {
                
                if ( get_option( 'page_for_posts' ) ) {
                    
                    echo get_the_title( get_option( 'page_for_posts' ) );
                
                } else {

                    _e( 'Blog', kopa_get_domain() );

                }

            } elseif ( is_search() ) {     
               
                printf( __( 'Search Results for: %s', kopa_get_domain() ), get_search_query() );

            } elseif ( is_category() ) {
                
                single_cat_title();

            } elseif ( is_tag() ) {

                single_tag_title();
            
            } elseif ( is_day() ) {
                
                printf( __( 'Daily Archives: %s', kopa_get_domain() ), get_the_date() );

            } elseif ( is_month() ) {

                printf( __( 'Monthly Archives: %s', kopa_get_domain() ), get_the_date( _x( 'F Y', 'monthly archives date format', kopa_get_domain() ) ) );
            
            } elseif ( is_year() ) {
            
                printf( __( 'Yearly Archives: %s', kopa_get_domain() ), get_the_date( _x( 'Y', 'yearly archives date format', kopa_get_domain() ) ) );
            
            } elseif ( is_author() ) {

                _e( 'Author Archives', kopa_get_domain() );

            } else {
            
                _e( 'Archives', kopa_get_domain() );
            
            }
        } ?>
        </span>
    </h4>
    <!-- widget-title -->

    <div class="masonry-wrapper">
        <ul class="entry-list masonry-container transitions-enabled centered clearfix masonry">
		
		<?php get_template_part( 'loop', 'blog' ); ?>

		</ul>
        <!-- entry-list -->
    </div>
    <!-- masonry-wrapper -->

    <?php kopa_pagination(); ?>
</div> 
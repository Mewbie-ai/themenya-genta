        <form role="search" action="<?php echo home_url('/'); ?>" id="searchform" method="get">
            <input class="sb-search-input" placeholder="<?php echo get_search_query() ? get_search_query() : __( 'Search...', kopa_get_domain() ); ?>" type="text" value="" name="s" id="search">
            <input class="sb-search-submit" type="submit" value="">
            <span class="sb-icon-search"></span>
        </form>

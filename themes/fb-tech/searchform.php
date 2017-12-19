<form role="search" class="search-widget" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="form-group">
        <input type="text" class="form-control" value="<?php echo get_search_query() ?>"  name="s" placeholder="<?php echo esc_html__('search here','fb-tech')?>">
    </div>
    <button type="submit" class="btn btn-search btn-submit"><?php esc_html_e('Search','fb-tech')?></button>
</form>
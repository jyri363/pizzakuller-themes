<?php
function dsm_paging_nav($dsm_query = false) {
    if(!$dsm_query) {
        global $wp_query;
        $dsm_query = $wp_query;
    }


    get_query_var('paged') < 2 ? $cur_page = 1 : $cur_page = get_query_var('paged');
    // Don't print empty markup if there's only one page.
    if ($dsm_query->max_num_pages < 2)
        return;

    // 2 styles of pagination
    $big = 999999999; // needs an unlikely integer

    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'current' => max(1, get_query_var('paged')),
        'total' => $dsm_query->max_num_pages,
        'type' => 'list',
        'mid_size' => 1,
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
    ));
}
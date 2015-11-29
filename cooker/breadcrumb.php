<?php 
    function dsm_breadcrumb() {
         if (!is_home() || !is_front_page()) :
            if ( is_category() ) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0)
                    $breadcrumbs[] = get_category_parents($thisCat->parent, TRUE, '');
                $breadcrumbs[] = __('Archive by category', 'cooker-ln') .' '. single_cat_title('', false);
            }
            if ( is_search() ) {
                $breadcrumbs[] =  __('Search results for ', 'cooker-ln') . get_search_query();
            }
            if ( is_day() ) {
                $breadcrumbs[] = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
                $breadcrumbs[] = '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
                $breadcrumbs[] = get_the_time('d');
            }
            if ( is_month() ) {
                $breadcrumbs[] = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
                $breadcrumbs[] = get_the_time('F');
            }
            if ( is_year() ) {
                $breadcrumbs[] = '<li>' . get_the_time('Y') . '</li>';
            }
            if ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    // $breadcrumbs[] = '<a href="' . home_url() . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                    $breadcrumbs[] = get_the_title();
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, '');
                    $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
                    $breadcrumbs[] = $cats;
                    $breadcrumbs[] = get_the_title();
                }

            }
            if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                $breadcrumbs[] = $post_type->labels->singular_name;
            }
            if ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if(!empty($cat)) {
                    $cat = $cat[0];
                    $breadcrumbs[] = get_category_parents($cat, TRUE, '');
                }
                $breadcrumbs[] = '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                $breadcrumbs[] = get_the_title();
            }
            if ( is_page() && !$post->post_parent ) {
                $breadcrumbs[] = get_the_title();
            }
            if ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs_parrents = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs_parents[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs_parents = array_reverse($breadcrumbs_parents);
                for ($i = 0; $i < count($breadcrumbs_parents); $i++) {
                    $breadcrumbs[] = $breadcrumbs_parents[$i];
                }
                $breadcrumbs[] = get_the_title();
            }
            if ( is_tag() ) {
                $breadcrumbs[] = __('Posts tagged ', 'cooker-ln') . single_tag_title('', false);

            }
            if ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                $breadcrumbs[] = __('Articles posted by ', 'cooker-ln') . $userdata->display_name;

            }
            if ( is_404() ) {
                $breadcrumbs[] = __('Error 404', 'cooker-ln');
            }
            if ( get_query_var('paged') ) {
                $breadcrumbs[] =    __('Page', 'cooker-ln') . ' ' . get_query_var('paged');
            }
        ?>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo home_url() ?>"><?php echo __('Home', 'cooker-ln') ?></a></li>
                    <?php foreach ($breadcrumbs as $b): ?>
                        <li><?php echo $b; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
<?php
    }

    if (class_exists('Woocommerce') && is_woocommerce()) {
        woocommerce_breadcrumb(); 
    } else {
        dsm_breadcrumb();
    }//end if WOO

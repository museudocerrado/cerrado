<?php
/**
 * Custom pagination function.
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists( 'dt_paginator' ) ) {

function dt_paginator( $query = null, $opts = array() ) {
	global $wpdb, $wp_query, $paged;

    if ( !is_single() ) {
        $defaults = array(
            'wrap'              => '<ul class="%CLASS%">%LIST%</ul>',
            'item_wrap'         => '<li class="%ITEM_CLASS%%ACT_CLASS%"><a href="%HREF%">%TEXT%</a></li>',
            'first_wrap'        => '<li><a href="%HREF%">%TEXT%</a></li>',
            'last_wrap'         => '<li><a href="%HREF%">%TEXT%</a></li>',
            'pages_wrap'        => '<div class="paginator-r"><span class="pagin">%TEXT%</spzn>%PREV%%NEXT%</div>',
            'ajaxing'           => false,
            'class'             => 'paginator',
            'item_class'        => '',
            'act_class'         => ' act',
            'pages_prev_class'  => 'larr',
            'pages_next_class'  => 'rarr',
            'always_show'       => 0,
            'dotleft_wrap'      => '<span>%TEXT%</span>',
            'dotright_wrap'     => '<span>%TEXT%</span>',
            'pages_text'        => _x( 'Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'pagination defaults', LANGUAGE_ZONE ),
            'current_text'      => '%PAGE_NUMBER%',
            'page_text'         => '%PAGE_NUMBER%',
            'first_text'        => _x( 'First', 'pagination defaults', LANGUAGE_ZONE ),
            'last_text'         => _x( 'Last', 'pagination defaults', LANGUAGE_ZONE ),
            'prev_text'         => '<',
            'next_text'         => '>',
			'no_next'			=> '',
			'no_prev'			=> '',
            'dotright_text'     => '&#8230;',
            'dotleft_text'      => '&#8230;',
            'num_pages'         => 5,
            'total_pages'       => true,
			'first_is_first_mode'	=> false,
            'query'             => is_object($query) ? $query : $wp_query
        );
        $opts = wp_parse_args( $opts, $defaults );
        $opts = apply_filters('dt_paginator_args', $opts);

        // setup query
        $query = $opts['query'];
        if( !is_object($query) ) {
            $query = $wp_query;
        }

		$posts_per_page = intval(get_query_var('posts_per_page'));
        
        if( !$paged = intval(get_query_var('page'))) {
            $paged = intval(get_query_var('paged'));
        }
/*		
		if( function_exists('of_get_option') &&
            of_get_option('layout_paginator_show_all_checkbox', false) )
        {
			$opts['num_pages'] = 9999;
		}
 */      
        $numposts = $query->found_posts;
		$max_page = $query->max_num_pages;
        
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
        
		if ( $opts['num_pages'] <= 0 ) { $opts['num_pages'] = 1; }
		
		$pages_to_show = absint($opts['num_pages']);
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
        
        if($start_page <= 0) {
			$start_page = 1;
		}
        
        $end_page = $paged + $half_page_end;
        
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
        
        if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
        
		$end_page = absint( $end_page );
		
        if($start_page <= 0) {
			$start_page = 1;
		}
        
        if( $opts['ajaxing'] ) {
            add_filter( 'get_pagenum_link', 'dt_ajax_paginator_filter', 10, 1);
        }
        
        // add class to item wrap
        $opts['item_wrap'] = str_replace( '%ITEM_CLASS%', $opts['item_class'], $opts['item_wrap'] );
        // add class to global pagunator wrap and cut it into parts
        $opts['wrap'] = explode( '%LIST%', str_replace('%CLASS%', $opts['class'], $opts['wrap']) ); 
        
		if($max_page > 1 || intval($opts['always_show']) == 1) {
            
			$loop_start = $start_page;
			$loop_end = $end_page;
			$dots_left_point = 1;
			$dots_right_point = $max_page;

			if ( $opts['first_is_first_mode'] ) {
				if ( 1 == $start_page ) {
					$loop_start++;
				}
				
				if ( $max_page == $end_page ) {
					$loop_end--;
				}

				$dots_left_point++;
				$dots_right_point--;
				
			}
			
            echo $opts['wrap'][0]; 
			
            if( $paged > 1 || $opts['first_is_first_mode'] ) {

				$act_class = $class_act = '';
				if ( 1 == $paged ) {
					$act_class = $opts['act_class'];
					$class_act = 'class="' . $opts['act_class'] . '"';
				}

                echo str_replace(
                    array( '%HREF%', '%TEXT%', '%FIRST_PAGE%', '%ACT_CLASS%', '%CLASS_ACT%' ),
                    array( esc_url( get_pagenum_link() ), $opts['first_text'], 1, $act_class, $class_act ),
                    $opts['first_wrap']
                );
            }
                        
            if ( $start_page > $dots_left_point && $pages_to_show < $max_page ) {   
                if(!empty($opts['dotleft_text'])) {
					
					if ( $opts['first_is_first_mode'] ) {
						$class_act = $curr_class = '';
						echo '<div style="display: none;">';
						for ( $i = 2; $i < $loop_start; $i++ ) {
							$page_text = str_replace( "%PAGE_NUMBER%", number_format_i18n($i), $opts['page_text'] );
							echo str_replace(
								array( '%ITEM_CLASS%', '%HREF%', '%TEXT%', '%ACT_CLASS%', '%CLASS_ACT%' ),
								array(
									$opts['item_class'],
									esc_url(get_pagenum_link($i)),
									$page_text,
									$curr_class,
									$class_act,
								),
								$opts['item_wrap']
							);
						}
						echo '</div>';
					}
					
                    echo str_replace( '%TEXT%', $opts['dotleft_text'], $opts['dotleft_wrap'] );
                }
            }
			
            for($i = $loop_start; $i <= $loop_end; $i++) {						
                if ( $i == $paged ) {
                    $page_text = str_replace(
                        "%PAGE_NUMBER%",
                        number_format_i18n($i),
                        $opts['current_text']
                    );
                    $curr_class = $opts['act_class'];
					$class_act = 'class="' . $opts['act_class'] . '"';
				} else {
                    $page_text = str_replace(
                        "%PAGE_NUMBER%",
                        number_format_i18n($i),
                        $opts['page_text']
                    );
                    $curr_class = $class_act = '';
                }
                echo str_replace(
                    array( '%ITEM_CLASS%', '%HREF%', '%TEXT%', '%ACT_CLASS%', '%CLASS_ACT%' ),
                    array(
                        $opts['item_class'],
                        get_pagenum_link($i),
                        $page_text,
                        $curr_class,
						$class_act,
                    ),
                    $opts['item_wrap']
                );
            }
            
            if ( $end_page < $dots_right_point ) {
                if(!empty($opts['dotright_text'])) {
                    echo str_replace( '%TEXT%', $opts['dotright_text'], $opts['dotright_wrap'] );
					
					if ( $opts['first_is_first_mode'] ) {
						$class_act = $curr_class = '';
						echo '<div style="display: none;">';
						for ( $i = $loop_end+1; $i <= $dots_right_point; $i++ ) {
							$page_text = str_replace( "%PAGE_NUMBER%", number_format_i18n($i), $opts['page_text'] );
							echo str_replace(
								array( '%ITEM_CLASS%', '%HREF%', '%TEXT%', '%ACT_CLASS%', '%CLASS_ACT%' ),
								array(
									$opts['item_class'],
									get_pagenum_link($i),
									$page_text,
									$curr_class,
									$class_act,
								),
								$opts['item_wrap']
							);
						}
						echo '</div>';
					}
                }
            }
            
            if( $paged < $max_page || $opts['first_is_first_mode'] ) {
				
				$act_class = $class_act = '';
				if ( $max_page == $paged ) {
					$act_class = $opts['act_class'];
					$class_act = 'class="' . $opts['act_class'] . '"';
				}
				
                echo str_replace(
                    array( '%HREF%', '%TEXT%', '%LAST_PAGE%', '%ACT_CLASS%', '%CLASS_ACT%' ),
                    array( get_pagenum_link($max_page), $opts['last_text'], $max_page, $act_class, $class_act ),
                    $opts['last_wrap']
                );
            }
            
            if( $opts['total_pages'] ) {
                $pages_text = str_replace(
                    array( '%CURRENT_PAGE%', '%TOTAL_PAGES%' ),
                    array( number_format_i18n($paged), number_format_i18n($max_page) ),
                    $opts['pages_text']
                );

                global $dt_paginator_pages_next_class, $dt_paginator_pages_prev_class; 
                $dt_paginator_pages_next_class = $opts['pages_next_class'];
                $dt_paginator_pages_prev_class = $opts['pages_prev_class'];

                // add some stuff
                add_filter( 'next_posts_link_attributes', 'dt_next_posts_link_attr' );
                add_filter( 'previous_posts_link_attributes', 'dt_previous_posts_link_attr' );

                $pages_next = get_next_posts_link($opts['next_text'], $max_page);
                $pages_prev = get_previous_posts_link($opts['prev_text']);

                // remove stuff for our safety
                remove_filter( 'next_posts_link_attributes', 'dt_next_posts_link_attr' );
                remove_filter( 'previous_posts_link_attributes', 'dt_previous_posts_link_attr' );
                
                if ( ! $pages_next ) {
                    $pages_next = $opts['no_next'];
				}

                if ( ! $pages_prev ) {
                    $pages_prev = $opts['no_prev'];
				}

                echo str_replace(
                    array( '%TEXT%', '%PREV%', '%NEXT%' ),
                    array( $pages_text, $pages_prev, $pages_next ),
                    $opts['pages_wrap']
                );    
            }
            
			echo $opts['wrap'][1];
        } 
        remove_filter( 'get_pagenum_link', 'dt_ajax_paginator_filter', 10, 1);
	}
}

} // !function_exists

// filter pagelink when ajaxing paginatior
function dt_ajax_paginator_filter( $href ) {
    $data = dt_storage( 'page_data' );
    $first = true;

    $data['cat_id'] = current($data['cat_id']);
    if( !$data['cat_id'] ) {
        $data['cat_id'] = 'all';
    }
    
    $search = array(
        '&paged=',
        '?paged=',
        '/page/'
    );
    
    foreach( $search as $exp ) {
        $str = explode( $exp, $href );
    
        if( isset($str[1]) ) {
            $href = '#' . $data['cat_id'] . '/' . $str[1];
            $first = false;
            break;
        }
    }
    
    if( $first ) {
        $href = '#' . $data['cat_id'] . '/' . 1;
    }
    
    $href .= '/' . $data['layout'];

    if( !empty($data['base_url']) ) {
        $href = str_replace( admin_url( 'admin-ajax.php' ), $data['base_url'], $href );
    }
    
    return $href;
}

// some little filters for posts links
function dt_next_posts_link_attr( $attr ) {
    global $dt_paginator_pages_next_class;
    if( !($next_class = $dt_paginator_pages_next_class) ) {
        $next_class = 'rarr';
    }
    $attr .= sprintf('class="%s"', $next_class);
    return $attr;
}

function dt_previous_posts_link_attr( $attr ) {
    global $dt_paginator_pages_prev_class;
    if( !($prev_class = $dt_paginator_pages_prev_class) ) {
        $prev_class = 'larr';
    }
    $attr .= sprintf('class="%s"', $prev_class);
    return $attr;
}

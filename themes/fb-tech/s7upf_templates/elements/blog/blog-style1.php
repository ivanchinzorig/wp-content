<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/04/2017
 * Time: 10:08
 */

$image_size = s7upf_get_size_image('full',$image_size);
$data_date=get_option('date_format');
if(!empty($date_format))
    $data_date= $date_format;
if($query->have_posts()){ ?>
    <div class="element-blog-style1 <?php echo esc_attr($extra_class); ?>">
        <?php while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="df-post-item-style">
                <?php  echo S7upf_Template::load_view('elements/blog/media-post-format',false,array(
                    'image_size' => $image_size,
                ));  ?>
                <div class="df-post-info">
                    <ul class="list-meta-block">
                        <li>
                            <span><?php echo esc_html__('Posted By:', 'fb-tech')?></span> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="df-silver"><?php echo get_the_author(); ?></a> - <span><?php echo get_the_date($data_date); ?></span>
                        </li>
                        <li>
                            <span><?php echo get_comments_number(); ?> </span>
                            <a href="<?php echo esc_url( get_comments_link() ); ?>" class="df-silver"><?php
                                if(get_comments_number()>1) esc_html_e('Comments', 'fb-tech') ;
                                else esc_html_e('Comment', 'fb-tech') ;
                                ?>
                            </a>
                        </li>
                        <?php $cats = get_the_category_list(', ');
                        if($cats) { ?>
                            <li>
                                <div class="df-category-list">
                                    <span><?php echo esc_html__('Category:','fb-tech'); ?> </span>
                                    <?php echo do_shortcode($cats); ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <h2 class="df-title-post text-uppercase">
                        <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title()?>">
                            <?php the_title()?>
                            <?php echo (is_sticky()) ? '<i class="fa fa-thumb-tack"></i>':''?>
                        </a>
                    </h2>
                    <?php if ( has_excerpt( get_the_ID()) ) { ?>
                        <p class="df-desc">
                            <?php
                            echo wp_trim_words( get_the_excerpt(), $word_excerpt , '...' );
                            ?>
                        </p>
                    <?php  } ?>
                    <?php $tags = get_the_tag_list(' ',', ',' ');
                    if($tags) { ?>
                        <div class="df-tag-list">
                            <i class="fa fa-tag"></i>
                            <?php echo do_shortcode($tags);?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        } ?>
    </div>
    <?php
} ?>
<?php
if('on' === $pagination){
   ?> <div class="df-pagination-blog"><div class="loop-pagination"> <?php

    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '&page=%#%',
        'current' => max(1, $paged),
        'total' => $query->max_num_pages,
        'mid_size' => 1,
        'type' => 'plain',
        'prev_text' => '<i class="icon ion-ios-arrow-thin-left"></i>',
        'next_text' => '<i class="icon ion-ios-arrow-thin-right"></i>',
    ));
    ?> </div> </div> <?php
}

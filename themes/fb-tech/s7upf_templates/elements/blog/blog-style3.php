<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/04/2017
 * Time: 10:08
 */
$data_date=get_option('date_format');
if(!empty($date_format))
    $data_date= $date_format;
switch ($col_layout){
    case '12':
        $size_img_df = '1170x400';
        break;
    case  '6':
        $size_img_df = '570x270';
        break;
    case  '3':
        $size_img_df = '270x160';
        break;
    default:
        $size_img_df = '370x240';
        break;
}
$default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_'.$size_img_df.'.png';

$size_image = s7upf_get_size_image($size_img_df,$image_size);
if($query->have_posts()){ ?>
    <?php if(!empty($title)){?>
        <div class="shop-title">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="font-bold title30 text-uppercase title-line-after pull-left"><?php echo esc_attr($title);?></h2>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="element-blog-style3 blog-gridview <?php echo esc_attr($extra_class); ?>">
        <div class="row">
            <?php while ($query->have_posts()) {
                $query->the_post(); ?>
                <div class="col-md-<?php echo esc_attr($col_layout); ?> col-sm-6 col-xs-6">
                    <div class="item-post drop-shadow post-item-style3">
                        <div class="banner-adv overlay-image zoom-image">
                            <a href="<?php echo the_permalink();?>" class="adv-thumb-link">
                                <?php if(has_post_thumbnail()){
                                    the_post_thumbnail($size_image);
                                }else if(!empty($default_thumbnail)){ ?>
                                    <img src="<?php echo esc_url($default_thumbnail); ?>">
                                    <?php
                                }?>
                            </a>
                        </div>
                        <div class="post-info">
                            <h3 class="title18 font-bold"><a href="<?php echo the_permalink();?>"><?php the_title();?></a></h3>
                            <ul class="list-none total-post-info">
                                <li>
                                    <div class="post-date-author title12 <?php if(!empty($hide_date) || !empty($hide_author)) echo "hide-one-in-two"; ?>">
                                        <?php if(empty($hide_date)){ ?>
                                            <span class="color"><i class="icon ion-calendar"></i><?php echo get_the_date($data_date); ?></span>
                                        <?php } if(empty($hide_author)){?>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="color"><i class="icon ion-compose"></i><?php echo get_the_author(); ?></a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <?php
                                $cats = get_the_category_list(', ');
                                if($cats and empty($hide_category)) { ?>
                                    <li>
                                        <div class="post-tags-cats title12 color">
                                            <i class="icon ion-android-folder"></i>
                                            <?php echo do_shortcode($cats); ?>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php $tags = get_the_tag_list(' ',', ',' ');
                                if($tags and empty($hide_tags)) { ?>
                                    <li>
                                        <div class="post-tags-cats title12 color">
                                            <i class="icon ion-ios-pricetags"></i>
                                            <?php echo do_shortcode($tags);?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if ( has_excerpt( get_the_ID()) ) { ?>
                                <p class="desc">
                                    <?php
                                    echo wp_trim_words( get_the_excerpt(), $word_excerpt , '...' );
                                    ?>
                                </p>
                            <?php  } ?>
                            <a href="<?php the_permalink(); ?>" class="shop-button color"><?php echo esc_html__('Read more','fb-tech')?></a>
                        </div>
                    </div>
                </div>

                <?php
            } ?>
        </div>
    </div>
    <?php
} ?>
<?php
if('on' === $pagination){
    ?> <div class="pagi-nav text-center"><div class="loop-pagination"> <?php

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

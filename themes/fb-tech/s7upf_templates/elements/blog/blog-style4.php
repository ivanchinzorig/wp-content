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

$size_img_df = '370x240';
$default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_'.$size_img_df.'.png';
$size_image = s7upf_get_size_image($size_img_df,$image_size);
if(empty($itemscustom)) $itemscustom='[0,1],[560,2],[990,3]'; else $itemscustom= s7upf_base64decode($itemscustom);
if($query->have_posts()){ ?>
<div class="latest-news latest-news2 element-blog-style4  <?php if($posi_navigation == 'center-navi')echo 'center-navi-position'; ?> <?php echo esc_attr($extra_class); ?>">
    <?php if(!empty($title)){
        if($posi_navigation == 'center-navi'){ ?>
        <h2 class="title30 title-underline"><?php echo esc_attr($title); ?></h2>
        <?php } else{ ?>
        <h3 class="title30 font-bold title-line-after"><?php echo esc_attr($title); ?></h3>
    <?php }
    }?>
    <div class="list-latest-post">
        <div class="wrap-item group-navi <?php echo esc_attr($posi_navigation); ?>" data-pagination="false" data-navigation="<?php echo esc_attr($navigation); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
            <?php while ($query->have_posts()) {
                $query->the_post(); ?>
                <div class="item-post drop-shadow">
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
                        <h3 class="title18 font-bold"><a href="<?php echo the_permalink();?>"><?php the_title(); ?></a></h3>
                        <span class="color post-date"><i class="icon ion-calendar"></i><?php echo get_the_date($data_date); ?></span>
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
                <?php
            } ?>
        </div>
    </div>
</div>
<?php }

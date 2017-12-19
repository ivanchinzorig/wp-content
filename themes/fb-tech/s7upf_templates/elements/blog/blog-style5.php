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
if(empty($itemscustom)) $itemscustom='[0,1],[768,2]'; else $itemscustom= s7upf_base64decode($itemscustom);
$size_img_df = '370x240';
if(empty($number_row)) $number_row = 1;
$default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_'.$size_img_df.'.png';
$size_image = s7upf_get_size_image($size_img_df,$image_size);
if($query->have_posts()){ ?>
    <div class="element-blog-style5 from-blog5 <?php echo esc_attr($extra_class); ?>">
        <?php if(!empty($title)){?>
            <h2 class="text-center title-underline"><?php echo esc_attr($title); ?></h2>
        <?php } ?>
        <div class="from-blog-slider5">
            <div class="wrap-item group-navi center-navi" data-pagination="false" data-navigation="<?php echo esc_attr($navigation); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr($itemscustom)?>]">
                <?php $count_post= $query->post_count; $i=1;  while ($query->have_posts()) {
                    $query->the_post(); ?>
                    <?php if($i % (int)$number_row == 1  || $count_post == 1|| $number_row == 1) echo '<div class="item">'; ?>
                        <div class="item-blog5 banner-adv zoom-image">
                            <a href="<?php echo the_permalink();?>" class="adv-thumb-link">
                                <?php if(has_post_thumbnail()){
                                    the_post_thumbnail($size_image);
                                }else if(!empty($default_thumbnail)){ ?>
                                    <img src="<?php echo esc_url($default_thumbnail); ?>">
                                    <?php
                                }?>
                            </a>
                            <div class="banner-info">
                                <h2 class="title18 font-bold">
                                    <a href="<?php echo the_permalink();?>" class="white">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                <span class="white post-date"><i class="icon ion-calendar"></i><?php echo get_the_date($data_date); ?></span>
                            </div>
                        </div>

                    <?php if($i % (int)$number_row  == 0 || $i == $count_post  || $count_post == 1 || $number_row == 1) echo '</div>'; $i= $i+1; ?>
                    <?php
                } ?>
            </div>
        </div>
    </div>
<?php }

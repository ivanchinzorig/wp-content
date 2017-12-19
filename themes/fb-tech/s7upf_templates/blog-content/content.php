<?php
$word_excerpt = s7upf_get_option('number_word_excerpt_blog_list','30');
$style_blog = s7upf_get_style_blog();
$sidebar=s7upf_get_sidebar();
$sidebar_pos=$sidebar['position'];

switch ($style_blog){
    case 'style3':
        $size_img_df = '1118x400';
        $col_blog = s7upf_get_option('s7upf_col_blog_grid');
        if($sidebar_pos !== 'no'){
            switch ($col_blog){
                case '12':
                    $size_img_df = '870x400';
                    break;
                case  '6':
                    $size_img_df = '420x220';
                    break;
                case  '3':
                    $size_img_df = '195x100';
                    break;
                default:
                    $size_img_df = '270x160';
                    break;
            }
        } else{
            switch ($col_blog){
                case '12':
                    $size_img_df = '1118x400';
                    break;
                case  '6':
                    $size_img_df = '533x270';
                    break;
                case  '3':
                    $size_img_df = '270x160';
                    break;
                default:
                    $size_img_df = '338x200';
                    break;
            }
        }
        $default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_'.$size_img_df.'.png';
        $image_size = s7upf_get_option('custom_size_image_blog_list');
        $size_image = s7upf_get_size_image($size_img_df,$image_size);
        ?>
        <div class="col-md-<?php echo esc_attr($col_blog); ?> col-sm-6 col-xs-6">
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
                            <div class="post-date-author title12">
                                <span class="color"><i class="icon ion-calendar"></i><?php echo get_the_date(get_option('date_format')); ?></span>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="color"><i class="icon ion-compose"></i><?php echo get_the_author(); ?></a>
                            </div>
                        </li>
                        <?php $cats = get_the_category_list(', ');
                        if($cats) { ?>
                            <li>
                                <div class="post-tags-cats title12 color">
                                    <i class="icon ion-android-folder"></i>
                                    <?php echo do_shortcode($cats); ?>
                                </div>
                            </li>
                        <?php } ?>
                        <?php $tags = get_the_tag_list(' ',', ',' ');
                        if($tags) { ?>
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
        break;
    case 'style2':

        $size_img_df = '461x260';
        if($sidebar_pos !== 'no') $size_img_df = '336x224';
        $default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_'.$size_img_df.'.png';
        $image_size = s7upf_get_option('custom_size_image_blog_list');
        $size_image = s7upf_get_size_image($size_img_df,$image_size);
        ?>
        <div class="item-post drop-shadow post-item-style2">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12">
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
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="post-info">
                        <h3 class="title18 font-bold"><a href="<?php echo the_permalink();?>"><?php the_title(); ?></a></h3>
                        <ul class="list-none total-post-info">
                            <li>
                                <div class="post-date-author title12">
                                    <span class="color"><i class="icon ion-calendar"></i><?php echo get_the_date(get_option('date_format')); ?></span>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="color"><i class="icon ion-compose"></i><?php echo get_the_author(); ?></a>
                                </div>
                            </li>
                            <?php $cats = get_the_category_list(', ');
                            if($cats) { ?>
                                <li>
                                    <div class="post-tags-cats title12 color">
                                        <i class="icon ion-android-folder"></i>
                                        <?php echo do_shortcode($cats); ?>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php $tags = get_the_tag_list(' ',', ',' ');
                            if($tags) { ?>
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
        </div>
        <?php
        break;
    default: ?>

        <div class="df-post-item-style">
            <?php  echo S7upf_Template::load_view('blog-content/media-post');  ?>
            <div class="df-post-info">
                <ul class="list-meta-block">
                    <li>
                        <span><?php echo esc_html__('Posted By:', 'fb-tech')?></span> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="df-silver"><?php echo get_the_author(); ?></a> - <span><?php echo get_the_date(get_option('date_format')); ?></span>
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
                <?php  } else { ?><p class="df-desc">
                    <?php echo wp_trim_words( get_the_content(), $word_excerpt , '...   '); ?>
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
        break;
}
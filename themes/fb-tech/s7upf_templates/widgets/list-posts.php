<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 27/09/2017
 * Time: 11:23 SA
 */
$default_thumbnail = get_template_directory_uri().'/assets/images/no-thumb/img_110x80.png';

if(empty($instance['word_excerpt'])) $number_word = 30; else $number_word = $instance['word_excerpt'];
if(!empty($instance['style'])and $instance['style']== 'comment'){ ?>
    <li>
        <div class="item-wg-comment table">
            <div class="post-comment-count">
                <a href="<?php echo esc_url( get_comments_link() ); ?>" class="post-comment-link border color"><i class="icon ion-chatboxes"></i><span><?php echo get_comments_number(); ?></span></a>
            </div>
            <div class="post-info">
                <h3 class="font-bold title14"><a href="<?php the_permalink(); ?>"><?php  echo wp_trim_words( get_the_title(), (int)$number_word , '...' ); ?></a></h3>
                <span class="color"><?php echo get_the_date(get_option('date_format'));?></span>
            </div>
        </div>
    </li>
    <?php
}else{ ?>
    <li>
        <div class="item-wg-post table">
            <div class="post-thumb banner-adv zoom-image overlay-image">
                <a href="<?php the_permalink(); ?>" class="adv-thumb-link border"><?php
                    if(has_post_thumbnail()) the_post_thumbnail(array(110,80)); else { ?><img src="<?php echo esc_url($default_thumbnail);?>"><?php } ?></a>
            </div>
            <div class="post-info">
                <h3 class="font-bold title14"><a href="<?php the_permalink(); ?>"><?php  echo wp_trim_words( get_the_title(), (int)$number_word , '...' ); ?></a></h3>
                <span class="color"><?php echo get_the_date(get_option('date_format'));?></span>

            </div>
        </div>
    </li>
<?php }

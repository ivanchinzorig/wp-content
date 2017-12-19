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
?>
<div class="footer-block6 element-blog-style6 <?php echo esc_attr($extra_class); ?>">
    <?php if(!empty($title)){ ?>
        <h2 class="title30"><?php echo esc_attr($title); ?></h2>
    <?php }
    if($query->have_posts()){ ?>
        <ul class="latest-news6 list-none">
            <?php while ($query->have_posts()) {
                $query->the_post(); ?>
                <li>
                    <div class="item-blog6">
                        <div class="blog-date6 bg-color white">
                            <span class="title12"><?php echo get_the_date('M'); ?></span>
                            <strong class="title18"><?php echo get_the_date('d'); ?></strong>
                        </div>
                        <div class="blog-info6">
                            <h3 class="title18"><a href="<?php the_permalink(); ?>" class="black">
                                    <?php the_title(); ?>
                                </a></h3>
                            <?php if ( has_excerpt( get_the_ID()) ) { ?>
                                <p class="desc silver">
                                    <?php
                                    echo wp_trim_words( get_the_excerpt(), $word_excerpt , '...' );
                                    ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </li>
                <?php
            } ?>
        </ul>
    <?php } ?>
</div>
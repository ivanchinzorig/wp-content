<?php
$data = '';
$gallery = get_post_meta(get_the_ID(), 'format_gallery', true);
if (!empty($gallery)){
    $array = explode(',', $gallery);
    if(is_array($array) && !empty($array)){
        
        $data .= '<div class="post-gallery banner-adv"><div class="wrap-item white-pagi" data-gation="true" data-transition="fade" data-pagination="false"  data-navigation="true"  data-autoplay="true" data-itemscustom="[[0,1]]">';
        foreach ($array as $key => $item) {
            $thumbnail_url = wp_get_attachment_url($item);
            $data .='<div class="image-slider">';
            $data .= '<img src="' . esc_url($thumbnail_url) . '" alt="image-slider">';           
            $data .= '</div>';
        }
        $data .='</div></div>';
    }
}
?>

<div <?php post_class(); ?>>
    <div class="detail-blog-info">
        <h2 class="title30 font-bold text-uppercase ">
            <?php the_title()?>
        </h2>
        <?php if (has_excerpt( get_the_ID())){ ?>
            <p class="desc title18  silver"><?php echo get_the_excerpt(); ?></p>
        <?php }
        s7upf_display_metabox('single_post'); ?>
    </div>
    <?php if(!empty($data)) echo do_shortcode($data);?>
    <div class="content-single-post">
        <?php the_content(); ?>
    </div>
</div>
<?php
$data = '';
$media_url = get_post_meta(get_the_ID(), 'format_media', true);
$hide_media = get_post_meta(get_the_ID(),'hide_media_single',true);
if (!empty($media_url)) {
    if(strpos($media_url,'.mp3') !== false){
        $data .='<div class="post-audio banner-adv"><audio controls><source src="'.esc_url($media_url).'" type="audio/mpeg"></audio></div>';
    }else{
        $data .= '<div class="post-audio banner-adv">' . s7upf_remove_w3c(wp_oembed_get($media_url, array('height' => '176'))) . '</div>';
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
<?php

$data = '';
$hide_media = get_post_meta(get_the_ID(),'hide_media_single',true);
$data_media = get_post_meta(get_the_ID(), 'format_media', true);
$video_format = array('.mp4','.ogg','.webm','.MP4','.Ogg','WebM');
$check_format = false;
foreach ($video_format as $key => $value) {
    $check_format = strpos($data_media, $value);
    if ($check_format !== false)
        break;
}
if($check_format !== false) {
    $data .= '<div class="post-video banner-adv">';
    $data .= '<video class="video_host_media" controls> <source src="'.esc_url($data_media).'"></video>';
    $data .= '</div>';
}else{
    $data .= '<div class="post-video banner-adv">';
    $data .= s7upf_remove_w3c(wp_oembed_get($data_media));
    $data .= '</div>';
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
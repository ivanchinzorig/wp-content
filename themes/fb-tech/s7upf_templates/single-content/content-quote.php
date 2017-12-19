<?php
$data = $st_link_post= $s_class = '';
global $post;
$s7upf_image_blog = get_post_meta(get_the_ID(), 'format_image', true);
if(!empty($s7upf_image_blog)){
    $data .='<div class="banner-adv">
                <img alt="'.$post->post_name.'" title="'.$post->post_name.'" class="adv-thumb-link" src="' . esc_url($s7upf_image_blog) . '"/>
            </div>';
}
else{
    if (has_post_thumbnail()) {
        $data .= '<div class="banner-adv">
                    '.get_the_post_thumbnail(get_the_ID(),'full',array('class'=>'adv-thumb-link')).'                
                </div>';
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
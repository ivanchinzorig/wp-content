<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 31/03/2017
 * Time: 17:36
 */
$logo = '';
if(!empty($logo_img)){
    $img = wp_get_attachment_image_src( $logo_img ,"full");
    $logo .= $img[0];
}else{
    $logo .= s7upf_get_option('logo');
}
?>
<div class="logo logo1 <?php echo esc_attr($alignment); ?> <?php echo esc_attr($el_class); ?>">
    <h1 class="hidden"><?php echo get_bloginfo('name', 'display'); ?></h1>
    <a href="<?php echo esc_url(get_home_url('/')) ?>"><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_html__('logo','fb-tech')?>"></a>
</div>
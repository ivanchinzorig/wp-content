<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03/04/2017
 * Time: 16:33
 */

$image_size = s7upf_get_size_image('full',$bg_image_size);
if(!empty($data_banner_1) and is_array($data_banner_1)){
?>
<div class="element-banner-slider1 banner-slider bg-slider banner-slider1 <?php echo esc_attr($el_class);?>">
    <div class="wrap-item" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-transition="<?php echo esc_attr($transition); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-itemscustom="[[0,1]]">
        <?php foreach($data_banner_1 as $value){
            if(!empty($value['bg_link'])) $bg_link = vc_build_link($value['bg_link']); ?>
            <div class="item-slider item-slider1">
                <?php if(!empty($value['bg_image'])){?>
                    <div class="banner-thumb">
                        <a  href="<?php echo (!empty($bg_link['url']))? esc_url($bg_link['url']):'#'; ?>" <?php if(empty($bg_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($bg_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($bg_link['rel'])) echo'rel="' .esc_attr( $bg_link['rel'] ) . '"'?>>
                            <?php echo wp_get_attachment_image($value['bg_image'],$image_size); ?>
                        </a>
                    </div>
                <?php } ?>
                <div class="banner-info animated" data-animated="<?php if(!empty($value['animation_css'])) echo esc_attr($value['animation_css']); ?>">
                    <div class="container">
                        <div class="banner-info-inner <?php if(!empty($value['position'])) echo esc_attr($value['position']); ?>  <?php if(!empty($value['alignment'])) echo esc_attr($value['alignment']); ?>">
                            <?php if(!empty($value['title_1'])){ ?>
                                <h2 class="title30 color"><?php echo esc_attr($value['title_1']); ?></h2>
                            <?php } if($value['title_2']){?>
                                <h2 class="title30"><?php echo esc_attr($value['title_2']); ?></h2>
                            <?php } if(!empty($value['button'])) echo s7upf_get_vc_build_link($value['button'],'shop-button color'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php }
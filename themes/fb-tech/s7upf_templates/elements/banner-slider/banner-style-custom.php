<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03/04/2017
 * Time: 16:33
 */

$image_size = s7upf_get_size_image('full',$bg_image_size);
if(!empty($data_banner_custom) and is_array($data_banner_custom)){
    ?>
    <div class="element-banner-slider-custom banner-slider bg-slider <?php echo esc_attr($el_class);?>">
        <div class="wrap-item" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-transition="<?php echo esc_attr($transition); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-itemscustom="[[0,1]]">
            <?php foreach($data_banner_custom as $value){
                if(!empty($value['bg_link'])) $bg_link = vc_build_link($value['bg_link']); ?>
                <div class="item-slider <?php if(!empty($value['el_class_item'])) echo esc_attr($value['el_class_item']); ?>">
                    <?php if(!empty($value['bg_image'])){?>
                        <div class="banner-thumb">
                            <a  href="<?php echo (!empty($bg_link['url']))? esc_url($bg_link['url']):'#'; ?>" <?php if(empty($bg_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($bg_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($bg_link['rel'])) echo'rel="' .esc_attr( $bg_link['rel'] ) . '"'?>>
                                <?php echo wp_get_attachment_image($value['bg_image'],$image_size,false,array('class'=>'mb_image_full')); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if(!empty($value['info'])){ ?>
                        <div class="banner-info animated <?php if(!empty($value['alignment'])) echo esc_attr($value['alignment']); ?>" data-animated="<?php if(!empty($value['animation_css'])) echo esc_attr($value['animation_css']); ?>">
                            <div class="container">
                                <div class="<?php if(!empty($value['position'])) echo esc_attr($value['position']); ?>">
                                    <?php  echo s7upf_base64decode($value['info']);?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            <?php } ?>
        </div>
    </div>
<?php }
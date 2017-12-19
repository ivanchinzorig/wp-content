<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 26/05/2017
 * Time: 15:51
 */
$image_size = s7upf_get_size_image('full',$image_size);
switch ($style){
    case 'style1': ?>
        <div class="brand-box <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){?>
                <h2 class="title30 font-bold title-line-after"><?php echo esc_attr($title); ?></h2>
            <?php } ?>
            <?php if(!empty($data_item_brand) and is_array($data_item_brand)){ ?>
            <div class="brand-slider">
                <div class="wrap-item group-navi" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="false" <?php if(!empty($transition)) echo 'data-transition="'.$transition.'"';?> data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr(s7upf_base64decode($itemscustom)); ?>]">
                <?php foreach($data_item_brand as $value){
                    if(!empty($value['link'])) $data_link = vc_build_link($value['link']);
                    if(!empty($value['image'])){ ?>
                        <div class="item-brand text-center">
                            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="wobble-horizontal">
                               <?php echo wp_get_attachment_image($value['image'],$image_size); ?>
                            </a>
                        </div>
                    <?php }
                } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style2': ?>
        <div class="popular-brand <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){?>
                <h2 class="title30 title-underline"><?php echo esc_attr($title); ?></h2>
            <?php } ?>
            <?php if(!empty($data_item_brand) and is_array($data_item_brand)){ ?>
                <div class="brand-slider">
                    <div class="wrap-item group-navi center-navi" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="false" <?php if(!empty($transition)) echo 'data-transition="'.$transition.'"';?> data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr(s7upf_base64decode($itemscustom)); ?>]">
                        <?php foreach($data_item_brand as $value){
                            if(!empty($value['link'])) $data_link = vc_build_link($value['link']);
                            if(!empty($value['image'])){ ?>
                                <div class="item-brand text-center">
                                    <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="wobble-horizontal">
                                        <?php echo wp_get_attachment_image($value['image'],$image_size); ?>
                                    </a>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
        break;
    default: ?>

        <?php
        break;
}
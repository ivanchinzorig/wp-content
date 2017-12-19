<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/05/2017
 * Time: 16:24
 */
$data_link='';
if(!empty($image_link)){
    $data_link=vc_build_link($image_link);
}
if(!empty($min_height)){
    $min_height=S7upf_Assets::build_css('min-height:'.$min_height.'px;');
}
$image_size = s7upf_get_size_image('full',$image_size);
switch ($style){
    case 'style1': ?>
        <div class="element-banner1 parallax featured-banner-product <?php echo esc_attr($min_height); ?> <?php echo esc_attr($extra_class); ?>" data-image="<?php echo esc_url(wp_get_attachment_image_url($image,$image_size)); ?>">
            <?php if(!empty($content)){ ?>
            <div class="banner-info">
                <div class="container">
                    <div class="featured-banner-info wow <?php echo esc_attr($animation_css); ?> <?php echo esc_attr($position); ?>">
                        <?php echo wpb_js_remove_wpautop($content, true); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style2':
        $class_color = S7upf_Assets::build_css('background:'.$bg_color.';'); ?>
        <div class="element-banner2 white item-banner-body  <?php echo esc_attr($extra_class); ?> <?php echo esc_attr($class_color); ?>">
            <?php if(!empty($content)) echo wpb_js_remove_wpautop($content, true); ?>
            <?php if(!empty($image)) echo wp_get_attachment_image($image,$image_size,false,array('class'=>'wow '.$animation_img)); ?>
        </div>
        <?php
        break;
    case 'style3': ?>
        <div class="element-banner3 item-adv2 banner-adv  <?php echo esc_attr($extra_class); ?> <?php echo esc_attr($animation_image3); ?>">
            <?php if(!empty($image)) { ?>
                <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="adv-thumb-link">
                    <?php echo wp_get_attachment_image($image,$image_size); ?>
                    <?php if('zoom-out'==$animation_image3) echo wp_get_attachment_image($image,$image_size); ?>
                </a>
            <?php } ?>
            <?php if(!empty($content)){ ?>
                <div class="banner-info <?php echo esc_attr($position3);?>">
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style4': ?>
        <div class="element-banner4  item-adv5 text-center  <?php echo esc_attr($extra_class); ?>">
            <?php if(!empty($content)){ ?>
                <div class="adv-info5">
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            <?php } ?>

            <div class="banner-adv">
                <?php if(!empty($image)) echo wp_get_attachment_image($image,$image_size,false); ?>
                <?php if(!empty($button)) $data_link=vc_build_link($button);
                if(!empty($data_link['title'])){ ?>
                    <div class="adv-button5">
                        <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>  class="white shop-button"><?php echo esc_attr($data_link['title']); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        break;
    case 'style5':  $uniqid= uniqid(); ?>
        <div class="element-banner5 samsung-galaxy  <?php echo esc_attr($extra_class); ?>">
            <?php if(!empty($title_intro)){ ?>
                <h2 class="title36 smoke text-uppercase font-bold"><?php echo esc_attr($title_intro); ?></h2>
            <?php } ?>
            <div class="item-your-phone">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <?php if(!empty($data_item_5) and is_array($data_item_5)){ ?>
                            <div class="tab-content">
                                <?php foreach ($data_item_5 as $key=>$value){ ?>
                                    <div id="tab<?php echo esc_attr($key); echo esc_attr($uniqid); ?>" class="tab-pane <?php if($key==0) echo 'active';?>">
                                        <?php if(!empty($value['image'])){ ?>
                                            <div class="thumb-your-phone">
                                                <?php echo wp_get_attachment_image($value['image'],$image_size); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="intro-your-phone">
                            <?php if(!empty($title)){ ?>
                                <h2 class="title30 title-line-after"><?php echo esc_attr($title); ?></h2>
                            <?php } if(!empty($desc)){ ?>
                                <p class="desc"><?php echo esc_attr($desc); ?></p>
                            <?php } ?>
                            <?php if(!empty($data_item_5) and is_array($data_item_5)){ ?>
                                <ul class="list-inline-block color-your-phone">
                                    <?php foreach ($data_item_5 as $key=>$value){ $class_bg='';
                                        if(!empty($value['color'])) $class_bg = S7upf_Assets::build_css('background:'.$value['color'].';'); ?>
                                        <li class="<?php if($key==0) echo 'active';?>"><a class="<?php echo esc_attr($class_bg); ?>" href="#tab<?php echo esc_attr($key); echo esc_attr($uniqid); ?>" data-toggle="tab" data-color="<?php if(!empty($value['title'])) echo esc_attr($value['title']); ?>"></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <?php if(!empty($content)){ ?>
                                <div class="your-product-info">
                                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    default : ?>
        <div class="element-banner6 banner-adv6 parallax <?php echo esc_attr($extra_class); ?>" data-image="<?php echo esc_url(wp_get_attachment_image_url($image_bg,'full')); ?>">
            <div class="banner-info">
                <div class="container">
                    <div class="inner-banner-info6 text-center inline-block">
                        <?php if(!empty($title_intro)){ ?>
                            <h3 class="title30 font-bold dark"><?php echo esc_attr($title_intro); ?></h3>
                        <?php } ?>
                        <?php if(!empty($content)){ ?>
                                <?php echo wpb_js_remove_wpautop($content, true); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if(!empty($image)){ ?>
                <div class="container">
                    <div class="text-right banner-thumb6">
                        <?php echo wp_get_attachment_image($image,$image_size); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
}
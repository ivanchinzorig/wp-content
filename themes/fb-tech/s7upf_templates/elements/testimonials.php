<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24/05/2017
 * Time: 17:19
 */

$data_link='';
if(!empty($image_link)){
    $data_link=vc_build_link($link_title);
}
$image_size = s7upf_get_size_image('full',$image_size);
switch ($style){
    case 'style1':?>
        <div class="item-client <?php echo esc_attr($el_class); ?>">
            <ul class="list-none info-client">
                <?php if(!empty($title)){?>
                    <li>
                        <h3 class="title18 font-bold">
                            <a class="" href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> >
                                <?php echo esc_attr($title); ?>
                            </a>
                        </h3>
                    </li>
                <?php } if(!empty($sub_title)){ ?>
                    <li>
                        <span class=""><?php echo esc_attr($sub_title); ?></span>
                    </li>
                <?php } ?>
            </ul>
            <?php if(!empty($content)) { ?>
                <div class="desc title18 font-light"><?php echo wpb_js_remove_wpautop($content, true); ?></div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style2': $data_link ='';
        $class_color = S7upf_Assets::build_css('color:'.$color_main.';');
        $border_color = S7upf_Assets::build_css('border-color:'.$color_main.';','::before');
        $border_color_desc = S7upf_Assets::build_css('border-color:'.$color_main.';',' .desc'); ?>
        <div class="element-testimonial2  <?php echo esc_attr($el_class); ?> <?php echo esc_attr($class_color); ?>">
            <div class="inner-client-box <?php if(empty($img_right)) echo 'no-img-right';?>">
                <?php if(!empty($data_testimonials2) and is_array($data_testimonials2)){?>
                    <div class="client-slider">
                        <div class="wrap-item" data-itemscustom="[[0,1]]" data-autoplay="true">
                            <?php foreach ($data_testimonials2 as $value){
                                if(!empty($value['link'])) $data_link=vc_build_link($value['link']); ?>
                            <div class="item-client  <?php echo esc_attr($border_color_desc); ?>">
                                <ul class="list-none info-client <?php echo esc_attr($border_color); ?>">
                                    <?php if(!empty($value['title'])){ ?>
                                        <li>
                                            <h3 class="title18 font-bold">
                                                <a class="<?php echo esc_attr($class_color); ?>" href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                                                   <?php echo esc_attr($value['title']); ?>
                                                </a>
                                            </h3>
                                        </li>
                                    <?php } if(!empty($value['sub_title'])){ ?>
                                        <li>
                                            <span class="<?php echo esc_attr($class_color); ?>" ><?php echo esc_attr($value['sub_title']); ?></span>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php if(!empty($value['desc'])){ ?>
                                <p class="desc title18 font-light <?php echo esc_attr($class_color); ?>"><?php echo esc_attr($value['desc']); ?></p>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } if(!empty($img_right)){ ?>
                    <div class="client-box-thumb wow slideInRight">
                        <?php echo wp_get_attachment_image($img_right,$image_size); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        break;
    case 'style2':
        if(empty($itemscustom)) $itemscustom='[0,1],[560,2],[990,3]'; else $itemscustom= s7upf_base64decode($itemscustom); ?>
        <div class="element-testimonial3 about-client <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){?>
                <h2 class="title18 rale-font text-uppercase font-bold"><?php echo esc_attr($title); ?></h2>
            <?php }
            if(!empty($data_testimonials3) and is_array($data_testimonials3)){ ?>
                <div class="about-client-slider">
                    <div class="wrap-item group-navi" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr($itemscustom); ?>]">
                        <?php foreach ($data_testimonials3 as $value){
                            if(!empty($value['link'])) $data_link=vc_build_link($value['link']); ?>
                            <div class="item-about-client">
                                <?php if(!empty($value['image'])){ ?>
                                    <div class="client-thumb"><a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                                            <?php echo wp_get_attachment_image($value['image'],$image_size); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="client-info">
                                    <?php if(!empty($value['desc'])){ ?>
                                        <p class="desc"><?php echo esc_attr($value['desc']); ?></p>
                                    <?php } if(!empty($value['title'])){?>
                                        <h3 class="title14">
                                            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="color">
                                                <?php echo esc_attr($value['title']); ?>
                                            </a>
                                        </h3>
                                    <?php }  if(!empty($value['sub_title'])){ ?>
                                        <span class="navi silver"><?php echo esc_attr($value['sub_title']); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    default:
        if(empty($itemscustom)) $itemscustom='[0,1]'; else $itemscustom= s7upf_base64decode($itemscustom); ?>
        <div class="element-testimonial4 client-block7 <?php echo esc_attr($el_class); ?>">
            <div class="client-slider7">
                <?php if(!empty($data_testimonials3) and is_array($data_testimonials3)){ ?>
                    <div class="wrap-item" data-navigation="<?php echo esc_attr($navigation); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>"  data-itemscustom="[<?php echo esc_attr($itemscustom); ?>]">
                        <?php foreach ($data_testimonials3 as $value){
                            if(!empty($value['link'])) $data_link=vc_build_link($value['link']); ?>
                            <div class="item-client7 text-center">
                                <?php if(!empty($value['image'])){ ?>
                                    <a  href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="client-thumb inline-block">
                                        <?php echo wp_get_attachment_image($value['image'],$image_size); ?>
                                    </a>
                                <?php } ?>
                                <?php if(!empty($value['desc'])){ ?>
                                    <p class="desc"><?php echo esc_attr($value['desc']); ?></p>
                                <?php } if(!empty($value['title'])){?>
                                    <h3 class="title18 font-bold">
                                        <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                                            <?php echo esc_attr($value['title']); ?>
                                        </a>
                                    </h3>
                                <?php }  if(!empty($value['sub_title'])){ ?>
                                    <span class="gray"><?php echo esc_attr($value['sub_title']); ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        break;
}
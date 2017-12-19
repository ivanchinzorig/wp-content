<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22/05/2017
 * Time: 11:09
 */
$image_size = s7upf_get_size_image('full',$image_size);
switch ($style){
    case 'style1':
        $class_color = S7upf_Assets::build_css('color:'.$text_color.';');
        $class_color .= ' '.S7upf_Assets::build_css('border-color:'.$text_color.';', ' .deal-countdown .time_circles > div');
        $class_color .= ' '.S7upf_Assets::build_css('background-color:'.$text_color.';', ' .deal-countdown .time_circles > div .number::after'); ?>
        <div class="element-infobox1 deal-of-day <?php echo esc_attr($class_color); ?>  <?php echo esc_attr($alignment); ?> <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){ ?>
                <h2 class="title30 font-bold"><?php echo esc_attr($title); ?></h2>
            <?php } if(!empty($time_down)){ ?>
                <div class="time-countdown deal-countdown hidden-canvas" data-date="<?php echo esc_attr($time_down); ?>" data-text='["<?php echo esc_html__('Days','fb-tech'); ?>","<?php echo esc_html__('Hour','fb-tech'); ?>","<?php echo esc_html__('Mins','fb-tech'); ?>","<?php echo esc_html__('Secs','fb-tech'); ?>"]'></div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style2':
        $class_color_icon = S7upf_Assets::build_css('color:'.$icon_color.';');
        $class_color_title = S7upf_Assets::build_css('color:'.$title_color.';');
        $class_color_item_title = S7upf_Assets::build_css('color:'.$title_item_color.';');
        ?>
        <div class="element-infobox2  footer-box <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){ ?>
                <h2 class="title-footer title18 <?php echo esc_attr($class_color_title); ?>"><?php echo esc_attr($title); ?></h2>
            <?php }
            if(!empty($data_box2) and is_array($data_box2)){ ?>
                <div class="contact-footer-box">
                    <?php foreach ($data_box2 as $value){ ?>
                    <div class="desc"><i class="<?php echo esc_attr($class_color_icon); ?> icon <?php if(!empty($value['icon'])) echo esc_attr($value['icon']); ?>"></i>
                        <div class="<?php echo esc_attr($class_color_item_title); ?>">
                            <?php if(!empty($value['title'])) echo do_shortcode($value['title']);?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style3':
        if(!empty($title_link)) $data_link = vc_build_link($title_link);
        ?>
        <div class="element-infobox3 item-choise <?php echo esc_attr($text_position); ?> <?php echo esc_attr($el_class); ?> ">
            <?php if(!empty($choice)){ ?>
                <strong class="choise-index title18"><?php echo esc_attr($choice);?></strong>
            <?php } ?>
            <h3 class="title18 text-uppercase">
                <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="black">
                    <?php echo esc_attr($title); ?>
                </a>
            </h3>
            <?php if(!empty($desc)){ ?>
                <p class="desc"><?php echo esc_attr($desc); ?></p>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style4':
        if(!empty($image_link)) $img_link = vc_build_link($image_link);
        ?>
        <div class="item-popcat3 element-infobox4 <?php echo esc_attr($el_class); ?>">
            <div class="row">
                <?php if(!empty($image)){ ?>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="banner-adv zoom-out">
                            <a href="<?php echo (!empty($img_link['url']))? esc_url($img_link['url']):'#'; ?>" <?php if(empty($img_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($img_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($img_link['rel'])) echo'rel="' .esc_attr( $img_link['rel'] ) . '"'?> class="adv-thumb-link">
                                <?php echo wp_get_attachment_image($image,$image_size); echo wp_get_attachment_image($image,$image_size);?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-<?php echo (!empty($image)) ?'6':'12'; ?> col-sm-12 col-xs-12">
                    <div class="popcat-info3">
                        <?php if(!empty($title)){ ?>
                            <h2 class="title18 text-uppercase font-bold title-underline text-left"><?php echo esc_attr($title); ?></h2>
                        <?php } ?>
                        <?php if(!empty($data_box4) and is_array($data_box4)){ ?>
                            <ul class="list-none">
                                <?php foreach ($data_box4 as $value){
                                    if(!empty($value['link'])) $data_link = vc_build_link($value['link']);
                                    if(!empty($value['title'])){ ?>
                                        <li>
                                            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                                                <?php echo esc_attr($value['title']); ?>
                                            </a>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'style5':
        if(!empty($image_link)) $img_link = vc_build_link($image_link);
        ?>
        <div class="item-popcat4 element-infobox5 <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){ ?>
                <h2 class="title18 text-uppercase font-bold title-underline text-left"><?php echo esc_attr($title); ?></h2>
            <?php } ?>
            <div class="row">
                <?php if(!empty($image)){ ?>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="banner-adv zoom-out">
                            <a href="<?php echo (!empty($img_link['url']))? esc_url($img_link['url']):'#'; ?>" <?php if(empty($img_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($img_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($img_link['rel'])) echo'rel="' .esc_attr( $img_link['rel'] ) . '"'?> class="adv-thumb-link">
                                <?php echo wp_get_attachment_image($image,$image_size); echo wp_get_attachment_image($image,$image_size);?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-<?php echo (!empty($image)) ?'6':'12'; ?> col-sm-12 col-xs-12">
                    <div class="popcat-info4">
                        <ul class="list-none">
                            <?php foreach ($data_box4 as $value){
                                if(!empty($value['link'])) $data_link = vc_build_link($value['link']);
                                if(!empty($value['title'])){ ?>
                                    <li>
                                        <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                                            <?php echo esc_attr($value['title']); ?>
                                        </a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'style6':
        ?>
        <div class="element-infobox6 about-why-choise  <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($title)){ ?>
                <h2 class="title18 rale-font text-uppercase font-bold"><?php echo esc_attr($title); ?></h2>
            <?php }
            if(!empty($data_box6) and  is_array($data_box6)){?>
                <div class="about-accordion toggle-tab">
                    <?php foreach ($data_box6 as $value){ ?>
                        <div class="item-toggle-tab active <?php if(empty($value['icon'])) echo 'no-icon';?>">
                            <div class="toggle-tab-title">
                                <?php if(!empty($value['icon'])){ ?>
                                    <span class="bg-color">
                                        <i class="icon <?php echo esc_attr($value['icon']); ?>"></i>
                                    </span>
                                <?php } ?>
                                <?php if(!empty($value['title'])) { ?>
                                    <h2 class="navi"><?php echo esc_attr($value['title']); ?></h2>
                                <?php } ?>
                            </div>
                            <?php if(!empty($value['desc'])){ ?>
                                <p class="desc toggle-tab-content silver"><?php echo esc_attr($value['desc']); ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style7':  ?>
        <div class="element-infobox7 contact-box contact-address-box <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($icon)){ ?>
                <span class="color"><i class="icon <?php echo esc_attr($icon)?>"></i></span>
            <?php } ?>
            <?php if(!empty($content)) echo wpb_js_remove_wpautop($content, true); ?>
        </div>
        <?php
        break;
    case 'style8':  if(!empty($icon_link)) $icon_link = vc_build_link($icon_link); ?>
        <div class="element-infobox8 item-function-product table <?php echo esc_attr($el_class); ?>">
            <?php if(!empty($icon)){ ?>
                <div class="function-icon">
                    <a href="<?php echo (!empty($icon_link['url']))? esc_url($icon_link['url']):'#'; ?>" <?php if(empty($icon_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($icon_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($icon_link['rel'])) echo'rel="' .esc_attr( $icon_link['rel'] ) . '"'?> class="color title30"><i class="icon <?php echo esc_attr($icon)?>"></i></a>
                </div>
            <?php } ?>
            <?php if(!empty($content)) { ?>
                <div class="function-intro">
                    <?php  echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style9':
        if(!empty($data_box6) and  is_array($data_box6)){ ?>
            <div class="element-infobox9 choise-accordion5 toggle-tab <?php echo esc_attr($el_class); ?>">
                <?php foreach ($data_box6 as $key=>$value){ ?>
                    <div class="item-toggle-tab <?php if($key == 0) echo 'active'; ?> <?php if(empty($value['icon'])) echo 'no-icon';?>">
                        <h3 class="toggle-tab-title title14 text-uppercase font-bold">
                            <?php if(!empty($value['icon'])){ ?>
                                <i class="icon <?php echo esc_attr($value['icon']); ?>"></i>
                            <?php } ?>
                            <?php if(!empty($value['title'])) {echo esc_attr($value['title']); } ?>
                        </h3>
                        <?php if(!empty($value['desc'])){ ?>
                            <p class="desc toggle-tab-content"><?php echo esc_attr($value['desc']); ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
        break;
    default: if(!empty($button)) $data_button = vc_build_link($button); ?>
        <div class="item-price-table element-infobox9 <?php echo esc_attr($el_class); ?>">
            <div class="price-table-header bg-color white text-center">
                <?php if(!empty($title)){ ?>
                    <h3 class="title18 font-bold"><?php echo esc_attr($title);?></h3>
                <?php } if(!empty($desc)){ ?>
                    <span><?php echo esc_attr($desc);?></span>
                <?php } ?>
            </div>
            <?php if(!empty($content)) { ?>
                <div class="price-table-content bg-white">
                    <?php  echo wpb_js_remove_wpautop($content, true); ?>
                </div>
            <?php } ?>
            <?php if(!empty($data_button['title'])) { ?>
                <div class="price-table-footer text-center">
                    <a href="<?php echo (!empty($data_button['url']))? esc_url($data_button['url']):'#'; ?>" <?php if(empty($data_button['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_button['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_button['rel'])) echo'rel="' .esc_attr( $data_button['rel'] ) . '"'?> class="shop-button round bg-color font-bold"><?php echo esc_attr($data_button['title']); ?></a>
                </div>
            <?php } ?>
        </div>
        <?php
    break;
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22/05/2017
 * Time: 15:49
 */
$data_link='';
if(!empty($link)){
    $data_link=vc_build_link($link);
}
switch ($style){
    case 'style1':
        if(!empty($content)){ ?>
            <div class="element-service1 item-hover-active item-intro-box wow <?php echo esc_attr($el_class);?> <?php echo esc_attr($animation_css);?>" <?php if(!empty($data_delay)) echo 'data-wow-delay="'.esc_attr($data_delay).'s"'; ?>>
                <a class="color text-uppercase" href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                </a>
            </div>
        <?php
        }
        break;
    case 'style2': ?>
        <div class="element-service2 item-service3 text-center  <?php echo esc_attr($el_class);?> ">
            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?>>
                <?php if(!empty($icon)){ ?>
                    <span class="title30 gray"><i class="icon <?php echo esc_attr($icon); ?>"></i></span>
                <?php } if(!empty($title)){ ?>
                    <h2 class="title14 text-uppercase gray title-underline font-bold"><?php echo do_shortcode($title); ?></h2>
                <?php } if(!empty($desc)){ ?>
                    <p class="desc"><?php echo do_shortcode($desc); ?></p>
                <?php } ?>
            </a>
        </div>
        <?php
        break;
    case 'style3':
        $class_color_text='';
        $bg_color = S7upf_Assets::build_css('background:'.$bg_color.';');
        $class_color_text .= ' '.S7upf_Assets::build_css('color:'.$color_text.';');
        $class_color_text .= ' '.S7upf_Assets::build_css('color:'.$color_text.';','>a');
        ?>
        <div class="element-service3 item-about-service text-center white bg-color <?php echo esc_attr($el_class);?> <?php echo esc_attr($class_color_text);?>  <?php echo esc_attr($bg_color);?> ">
            <?php if(!empty($icon)){ ?>
                <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="wobble-horizontal">
                    <i class="icon <?php echo esc_attr($icon); ?>"></i>
                </a>
            <?php } if(!empty($title)){?>
                <h2 class="title30"><?php echo esc_attr($title); ?></h2>
            <?php } ?>
        </div>
        <?php
        break;
    case 'style4': ?>
        <div class="element-service4 item-service6 text-center <?php echo esc_attr($el_class);?>">
            <?php if(!empty($icon)){ ?>
                <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="service-icon wobble-horizontal title90 color"><i class="icon <?php echo esc_attr($icon); ?>"></i></a>
            <?php } if(!empty($content)){?>
                <?php echo wpb_js_remove_wpautop($content, true); ?>
            <?php } ?>
        </div>
        <?php
        break;
    default: ?>
        <div class="element-service5 item-service8 text-center <?php echo esc_attr($el_class);?>">
            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="bg-color2">
                <?php if(!empty($icon)){ ?>
                    <span class="title60 color"><i class="icon <?php echo esc_attr($icon); ?>"></i></span>
                <?php } if(!empty($content)){?>
                    <?php echo wpb_js_remove_wpautop($content, true); ?>
                <?php } ?>
            </a>
        </div>
        <?php
        break;
}
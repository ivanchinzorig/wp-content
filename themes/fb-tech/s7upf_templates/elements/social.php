<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 29/05/2017
 * Time: 16:03
 */

switch ($style){
    case 'style1': ?>
        <div class="element-social1 footer-block6">
            <?php if(!empty($title)){ ?>
            <h2 class="title30"><?php echo esc_attr($title); ?></h2>
            <?php } if(!empty($data_social) and is_array($data_social)){ ?>
                <div class="social-footer6">
                    <?php foreach ($data_social as $value) {
                        if (!empty($value['link'])) $data_link = vc_build_link($value['link']);
                        if (!empty($value['icon'])) { ?>
                            <a href="<?php echo (!empty($data_link['url']))? esc_url($data_link['url']):'#'; ?>" <?php if(empty($data_link['url'])) echo 'onclick="return false;"'; ?> target="<?php echo (!empty($data_link['target']))?'_blank':'_parent'; ?>" <?php if(!empty($data_link['rel'])) echo'rel="' .esc_attr( $data_link['rel'] ) . '"'?> class="round inline-block float-shadow color">
                                <i class="<?php echo esc_attr($value['icon'])?>"></i></a>
                        <?php }
                    } ?>
                </div>
            <?php } ?>
        </div>
        <?php
        break;
    default: ?>

        <?php
        break;
}
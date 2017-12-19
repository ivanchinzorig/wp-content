<?php
/**
 * Created by PhpStorm.
 * User: mai100it
 * Date: 11/09/2017
 * Time: 5:27 CH
 */
if('style1'== $style){
    $class_title_color = S7upf_Assets::build_css('color: '.$title_color.';'); ?>
    <div class="footer-box <?php echo esc_attr($el_class); ?>">
        <?php if(!empty($title)){?>
            <h2 class="title-footer title18 <?php echo esc_attr($class_title_color); ?>"><?php echo esc_attr($title); ?></h2>
        <?php } ?>
        <div class="newsletter-footer mb-mailchimp" data-namesubmit = "<?php echo esc_attr($submit_name)?>" data-placeholder = "<?php echo esc_attr($placeholder)?>">
            <?php echo wpb_js_remove_wpautop('[mc4wp_form id="'.$shortcode.'"]'); ?>
        </div>
    </div>
    <?php
}else if('style2'== $style){ ?>
    <div class="signup-footer3 <?php echo esc_attr($el_class); ?>">
        <?php if(!empty($title)){?>
            <h2 class="title18 font-bold white text-uppercase"><i class="title30 icon ion-laptop"></i><?php echo esc_attr($title); ?></h2>
        <?php } ?>
        <?php if(!empty($desc)){ ?>
            <p class="desc white"><?php echo esc_attr($desc); ?></p>
        <?php } ?>
        <div class="newsletter-footer3 mb-mailchimp"  data-namesubmit = "<?php echo esc_attr($submit_name)?>" data-placeholder = "<?php echo esc_attr($placeholder)?>">
            <?php echo wpb_js_remove_wpautop('[mc4wp_form id="'.$shortcode.'"]'); ?>
        </div>
    </div>
    <?php
}else if('style3'== $style){ ?>
    <div class="form-newsletter4 <?php echo esc_attr($el_class); ?> mb-mailchimp"  data-namesubmit = " " data-placeholder = "<?php echo esc_attr($placeholder)?>">
        <?php if(!empty($title)){?>
            <strong class="title-newsletter4 title18 text-uppercase font-bold"><?php echo esc_attr($title); ?></strong>
        <?php } ?>
        <?php echo wpb_js_remove_wpautop('[mc4wp_form id="'.$shortcode.'"]'); ?>
    </div>
    <?php

}else{ ?>
    <div class="footer-block6 <?php echo esc_attr($el_class); ?>">
        <?php if(!empty($title)){?>
            <h2 class="title30"><?php echo esc_attr($title); ?></h2>
        <?php } ?>
        <div class="newsletter6">
            <?php if(!empty($desc)){ ?>
                <p class="desc"><?php echo do_shortcode($desc); ?></p>
            <?php } ?>
            <div class="email-form6 mb-mailchimp" data-namesubmit = "<?php echo esc_attr($submit_name)?>" data-placeholder = "<?php echo esc_attr($placeholder)?>">
                <?php echo wpb_js_remove_wpautop('[mc4wp_form id="'.$shortcode.'"]'); ?>
            </div>
        </div>
    </div>
<?php }
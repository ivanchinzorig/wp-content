<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package 7up-framework
 */

?>
        </div><!-- End .container-->
    </div><!-- End #content-->
        <?php
        $page_id = s7upf_get_value_by_id('s7upf_footer_page');
        if(!empty($page_id)) {
            s7upf_get_footer_visual($page_id);
        }
        else{
            s7upf_get_footer_default();
        }?>
        <a href="#" class="scroll-top dark"><i class="icon ion-android-navigate"></i></a>

        <div class="wishlist-mask">
            <?php
            if(class_exists('YITH_WCWL_Init')){
                $url = YITH_WCWL()->get_wishlist_url();
                echo    '<div class="wishlist-popup">
                                <span class="popup-icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
                                <p class="wishlist-alert">"<span class="wishlist-title"></span>" '.esc_html__("was added to wishlist","fb-tech").'</p>
                                <div class="wishlist-button">
                                    <a href="#" class="wishlist-close">'.esc_html__("Close","fb-tech").' (<span class="wishlist-countdown">3</span>)</a>
                                    <a href="'.esc_url($url).'">'.esc_html__("View page","fb-tech").'</a>
                                </div>
                            </div>';
            }
            ?>
        </div>
    </div> <!--End .wrap-->
<?php wp_footer(); ?>
</body>
</html>

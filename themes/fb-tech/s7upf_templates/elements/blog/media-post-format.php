<?php
/**
 * Created by PhpStorm.
 * User: 7uptheme
 * Date: 29/03/2017
 * Time: 11:39
 */
$default_image = '';
$class_style = 'df-media-post';
$data_gallery_array = array();
// Get data media
$data_gallery = get_post_meta(get_the_ID(),'format_gallery',true);
if(!empty($data_gallery)) $data_gallery_array = explode(',',$data_gallery);
$data_media = get_post_meta(get_the_ID(),'format_media',true);

// Check post format
$format = get_post_format();
switch ($format){
    case 'image':
        if(has_post_thumbnail()) { ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($image_size); ?></a>
            </div>
        <?php } else if(!empty($default_image)){ ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($default_image); ?>"></a>
            </div>
        <?php }
        break;
    case 'gallery':
        if(!empty($data_gallery_array) and is_array($data_gallery_array)){   ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <div class="wrap-item arrow-image" data-pagination="false" data-navigation="true" data-itemscustom="[[990,1]]" >
                    <?php foreach ($data_gallery_array as $value){
                        if(!empty($value)){ ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php echo wp_get_attachment_image($value,$image_size,false,array('class'=>'full-width')); ?>
                            </a>
                        <?php }
                    }?>
                </div>
            </div>
            <?php
        }else  if(has_post_thumbnail()) { ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($image_size); ?></a>
            </div>
        <?php } else if(!empty($default_image)){ ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($default_image); ?>"></a>
            </div>
        <?php }
        break;
    case 'video':
        $video_format = array('.mp4','.ogg','.webm','.MP4','.Ogg','WebM');
        $check_format = true;
        if(!empty($data_media)) {
            ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <?php
                $check_format = false;
                foreach ($video_format as $key => $value) {
                    $check_format = strpos($data_media, $value);
                    if ($check_format !== false)
                        break;
                }
                if($check_format !== false) {
                    ?>
                    <video class="video_host_media" controls> <source src="<?php echo esc_url($data_media); ?>"></video>
                    <?php
                }else{
                    echo s7upf_remove_w3c(wp_oembed_get($data_media));
                }
                ?>
            </div>
            <?php
        }else if(has_post_thumbnail()) { ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($image_size); ?></a>
            </div>
        <?php } else if(!empty($default_image)){ ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($default_image); ?>"></a>
            </div>
        <?php }

        break;
    case 'audio':
        $check_type = true;
        if(!empty($data_media)) {
            if(strpos($data_media,'.mp3') == false){ ?>
                <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>"><?php echo s7upf_remove_w3c(wp_oembed_get($data_media, array('height' => '176'))) ?></div>
                <?php
            }else{ ?>
                <div class="<?php if(has_post_thumbnail() || !empty($default_image))echo 'banner-adv';?> format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">

                    <?php  if(has_post_thumbnail()){ ?>
                    <a href="<?php the_permalink(); ?>" class="adv-thumb-link">
                        <?php   the_post_thumbnail($image_size);?>
                        </a><?php
                    } else if(!empty($default_image)){ ?>
                        <a href="<?php the_permalink(); ?>" class="adv-thumb-link">
                            <img src="<?php echo esc_url($default_image); ?>">
                        </a>
                    <?php } ?>

                    <audio controls class="audio mb-media-post">
                        <source src="<?php echo esc_url($data_media); ?>" type="audio/mpeg">
                    </audio>
                </div>
                <?php
            }
        } else if(has_post_thumbnail()) { ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail($image_size); ?></a>
            </div>
        <?php } else if(!empty($default_image)){ ?>
            <div class="format-<?php echo esc_attr($format);?> <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>" ><img src="<?php echo esc_url($default_image); ?>"></a>
            </div>
        <?php }
        break;
    default:
        if(has_post_thumbnail()) { ?>
            <div class="format-standard <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($image_size); ?></a>
            </div>
        <?php } else if(!empty($default_image)){ ?>
            <div class="format-standard <?php echo esc_attr($class_style); ?>">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($default_image); ?>"></a>
            </div>
        <?php }
        break;
}
?>

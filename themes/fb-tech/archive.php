<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package 7up-framework
 */

get_header();
$style_blog = s7upf_get_option('s7upf_style_blog'); ?>
<?php do_action('s7upf_before_main_content')?>
    <div class="content-pages <?php if(empty($style_blog)) echo 'df-archive';?>">
        <?php if(empty($style_blog)){ ?>
            <?php the_archive_title('<h1 class="page-title">','</h1>'); ?>
        <?php }else{ ?>
            <div class="shop-title">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="font-bold title30 text-uppercase title-line-after pull-left"><?php the_archive_title(); ?></h2>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <?php s7upf_output_sidebar('left')?>
            <div class="<?php echo esc_attr(s7upf_get_main_class()); ?>">
                <?php if(have_posts()):?>
                    <div class="<?php if('style3'==$style_blog) echo 'blog-gridview'; else echo 'blog-listview '; ?>">
                        <?php if('style3'==$style_blog) echo '<div class="row">'; ?>
                        <?php while (have_posts()) :the_post();?>
                            <?php get_template_part('s7upf_templates/blog-content/content');?>
                        <?php endwhile;?>
                        <?php wp_reset_postdata();?>
                        <?php if('style3'==$style_blog) echo '</div>'; ?>
                    </div>
                    <?php s7upf_paging_nav();?>
                <?php else : ?>
                    <?php get_template_part( 's7upf_templates/blog-content/content', 'none' ); ?>
                <?php endif;?>
            </div>
            <?php s7upf_output_sidebar('right')?>
        </div>
    </div>
<?php do_action('s7upf_affter_main_content')?>
<?php get_footer(); ?>
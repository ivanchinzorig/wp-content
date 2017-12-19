<?php
/**
 * The template for displaying search results pages.
 *
 * @package 7up-framework
 */

get_header();
$style_blog = s7upf_get_option('s7upf_style_blog_search');?>
	<div class="content-pages <?php if(empty($style_blog)) echo 'df-page-search';?>">
        <?php if(empty($style_blog)){ ?>
            <h1 class="page-title"><?php printf( esc_html__( 'Search results for: %s', 'fb-tech' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php }else{ ?>
        <div class="shop-title">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="font-bold title30 text-uppercase title-line-after pull-left"><?php printf( esc_html__( 'Search results for: %s', 'fb-tech' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <?php s7upf_output_sidebar('left')?>
            <div class="<?php echo esc_attr(s7upf_get_main_class()); ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="<?php if('style3'==$style_blog) echo 'blog-gridview'; else echo 'blog-listview '; ?>">
                        <?php if('style3'==$style_blog) echo '<div class="row">'; ?>
                        <?php while (have_posts()) :the_post();?>
                            <?php get_template_part('s7upf_templates/blog-content/content');?>
                        <?php endwhile;?>
                        <?php wp_reset_postdata();?>
                        <?php if('style3'==$style_blog) echo '</div>'; ?>
                    </div>
                    <?php s7upf_paging_nav();?><!-- Display navigation-->
                <?php else : ?>

                    <?php get_template_part( 's7upf_templates/blog-content/content', 'none' ); ?>

                <?php endif; ?>
            </div>
            <?php s7upf_output_sidebar('right')?>
        </div>
	</div>
<?php get_footer();
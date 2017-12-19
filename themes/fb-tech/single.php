<?php
/**
 * The template for displaying all single posts.
 *
 * @package 7up-framework
 */
?>
<?php get_header();?>
    <div class="content-pages  s7up-blog-single"><!-- blog-single -->

        <div class="row">
            <?php s7upf_output_sidebar('left')?>
            <div class="<?php echo esc_attr(s7upf_get_main_class()); ?>">
                <div class="content-blog-detail">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 's7upf_templates/single-content/content',get_post_format() );
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fb-tech' ),
                            'after'  => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) ); ?>
                        <?php s7upf_display_metabox('share-single'); ?>
                        <?php s7upf_display_metabox('single-info-author'); ?>
                        <?php s7upf_display_metabox('post-control'); ?>
                        <?php
                        if ( comments_open() || get_comments_number() ) { comments_template(); }
                    endwhile; ?>

                </div>
            </div>
            <?php s7upf_output_sidebar('right')?>
        </div>
    </div>
<?php get_footer();?>
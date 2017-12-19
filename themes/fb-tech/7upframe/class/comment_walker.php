<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 08/11/2016
 * Time: 17:14 CH
 */

if (!class_exists('s7upf_Comment_Walker')) {
    class s7upf_Comment_Walker extends Walker_Comment
    {
        var $tree_type = 'comment';
        var $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');

        // constructor – wrapper for the comments list
        function __construct()
        { ?>

            <ol class="comment-list list-none">

        <?php }

        // start_lvl – wrapper for child comments list
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 2; ?>

        <ul class="children">

    <?php }

        // end_lvl – closing wrapper for child comments list
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 2; ?>

        </ul>

    <?php }

        // start_el – HTML for comment template
    function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
    {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = (empty($args['has_children']) ? '' : 'parent');

        if ('article' == $args['style']) {
            $tag = 'article';
            $add_below = 'comment';
        } else {
            $tag = 'article';
            $add_below = 'comment';
        } ?>

        <li <?php comment_class(empty($args['has_children']) ? '' : 'parent comments-list') ?>
            id="comment-<?php comment_ID() ?>">
        <div class="item-comment">
            <div class="commnent-thumb">
                <a class="comment-author" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                    <?php echo get_avatar($comment, 70); ?>
                </a>
            </div>
            <div class="comment-info">
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="font-bold  silver">
                    <?php echo get_the_author(); ?>
                </a><span class=" silver"><?php echo esc_html__('says:','fb-tech')?></span>
                <ul class="post-date-comment">
                    <li><span class="color"><?php comment_date('d M, Y'); ?></span></li>
                    <li><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></li>
                </ul>
                <div class="desc silver "><?php comment_text() ?></div>
            </div>
        </div>

    <?php }
        // end_el – closing HTML for comment template
    function end_el(&$output, $comment, $depth = 0, $args = array())
    { ?>
        </li>
    <?php }
        // destructor – closing wrapper for the comments list
        function __destruct()
        { ?>
            </ol>
        <?php }

    }
}
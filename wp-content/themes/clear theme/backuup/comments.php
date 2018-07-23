<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'gt3_theme_localization'); ?></p>
    <?php return;
}
?>
<div id="comments">
    <?php

    #Required for nested reply function that moves reply inline with JS
    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }

    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
        die ('Please do not load this page directly. Thanks!');
    }

    if (have_comments()) { ?>
        <div class="row">
            <div class="span12">
                <h4 class="postcomment"><?php echo __('Comments', 'gt3_theme_localization'); ?>:</h4>
                <ul class="commentlist nolist">
                    <?php wp_list_comments('type=comment&callback=gt3_theme_comment'); ?>
                </ul>

                <div class="dn"><?php paginate_comments_links(); ?></div>
            </div>
        </div>
    <?php }

    if ($post->comment_status == 'open') { ?>
        <div class="row">
            <div class="span12">
                <?php

                $comment_form = array(
                    'fields' => apply_filters('comment_form_default_fields', array(
                        'author' => '<label class="label-name"></label><input type="text" placeholder="' . __('Name *', 'gt3_theme_localization') . '" title="' . __('Name *', 'gt3_theme_localization') . '" id="author" name="author" class="form_field">',
                        'email' => '<label class="label-email"></label><input type="text" placeholder="' . __('Email *', 'gt3_theme_localization') . '" title="' . __('Email *', 'gt3_theme_localization') . '" id="email" name="email" class="form_field">',
                        'url' => '<label class="label-web"></label><input type="text" placeholder="' . __('URL', 'gt3_theme_localization') . '" title="' . __('URL', 'gt3_theme_localization') . '" id="web" name="url" class="form_field">'
                    )),
                    'comment_field' => '<label class="label-message"></label><textarea name="comment" cols="45" rows="5" placeholder="' . __('Message...', 'gt3_theme_localization') . '" id="comment-message" class="form_field"></textarea>',
                    'comment_form_before' => '',
                    'comment_form_after' => '',
                    'must_log_in' => __('You must be logged in to post a comment.', 'gt3_theme_localization'),
                    'title_reply' => __('Leave A Reply', 'gt3_theme_localization'),
                    'label_submit' => __('Submit Comment', 'gt3_theme_localization'),
                    'logged_in_as' => '<p class="logged-in-as">' . __('Logged in as', 'gt3_theme_localization') . ' <a href="' . admin_url('profile.php') . '">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '">' . __('Log out?', 'gt3_theme_localization') . '</a></p>',
                );
                comment_form($comment_form, $post->ID);
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
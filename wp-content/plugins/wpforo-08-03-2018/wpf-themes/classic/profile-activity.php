<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wpforo-activity-content">
	<?php if(empty($activities)) : ?><p class="wpf-p-error"> <?php wpforo_phrase('No activity found for this member.') ?> </p><?php endif ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	   <?php $bg = FALSE; foreach( $activities as $activity ) : ?>
		  <tr<?php echo ( $bg ? ' class="wpfbg-9"' : '' ) ?>>
			<td class="activity-icon"><i class="fa fa-file-text-o fa-1x wpfcl-2"></i></td>
			<td class="activity-title">
                <?php
                    if( $activity['is_first_post'] ){
                        $href = esc_url($wpforo->topic->get_topic_url($activity['topicid']));
                        $link_text = wpforo_text( $activity['title'], 60, FALSE );
                    }else{
                        $href = esc_url($wpforo->post->get_post_url($activity['postid']));
                        if( !$link_text = wpforo_text( $activity['body'], 60, FALSE ) ){
                            $link_text = wpforo_text( $activity['title'], 60, FALSE );
                        }
                    }
                    if(!$href) $href = '#';
                    if(!$link_text) $link_text = wpforo_phrase('post link', false);

                    printf('<a href="%s">%s</a>', $href, $link_text);
                ?>
            </td>
			<td class="activity-date"><?php wpforo_date($activity['created']); ?></td>
		  </tr>
		<?php $bg = ( $bg ? FALSE : TRUE ); endforeach ?>
   </table>
   <div class="activity-foot">
        <?php $wpforo->tpl->pagenavi( $paged, $items_count ); ?>
    </div>
</div>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<table class="form-table">
<tbody> 
<tr valign="top">
<th scope="row"><label for="name"><?php echo __('Pay Name', 'donate-author-post');?>:</label></th>
<td>
<input name="name" type="text" value="<?php echo $pay['name']; ?>" class="regular-text code">
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="note"><?php echo __('Pay Note', 'donate-author-post');?>:</label></th>
<td>
<?php
wp_editor($pay['note'], 'donate_author_post_new_channel_note', 
array(
    'textarea_name'=>'note',
    'textarea_rows'=>12,
    'wpautop'=>true
));
?>
</td>
</tr>

<tr>
<th scope="row"><label for="display"><?php echo __('Display', 'donate-author-post');?>:</label></th>
<td>
<select name="display" id="display">
<option value='yes' <?php echo selected( $pay['display'], 'yes', false);?>><?php echo __('Yes', 'donate-author-post');?></option>
<option value='no' <?php echo selected( $pay['display'], 'no', false);?>><?php echo __('No', 'donate-author-post');?></option>
</select>
</td>
</tr>
</tbody>
</table>
<p><input type="submit" class="pay-update" value="<?php echo __('Update', 'donate-author-post');?>"></p>
<input type=hidden name=pay_id value="<?php echo $tab;?>"/>
<input type=hidden name=act value=update />
</form>

<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<p>
    <input type="submit" class="pay-delete" value="<?php echo __('Delete', 'donate-author-post');?>">
</p>
<input type=hidden name=pay_id value="<?php echo $tab;?>"/>
<input type=hidden name=act value=delete />
</form>

<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<table class="form-table">
<tbody> 
<tr valign="top">
<th scope="row"><label for="name"><?php echo __('Pay Name', 'donate-author-post');?>:</label></th>
<td>
<input name="name" type="text" value="" class="regular-text code">
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="note"><?php echo __('Pay Note', 'donate-author-post');?>:</label></th>
<td>
<?php
wp_editor($options['note'], 'donate_author_post_channel_note', 
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

<option value='yes'><?php echo __('Yes', 'donate-author-post');?></option>
<option value='no'><?php echo __('No', 'donate-author-post');?></option>

</select>
</td>
</tr>


</tbody>

</table>
<p class="submit"><input type="submit" class="button button-primary" value="<?php echo __('Add', 'donate-author-post');?>"></p>
<input type=hidden name=act value="insert"/>
</form>

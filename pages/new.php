<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<table class="form-table">
<tbody> 
<tr valign="top">
<th scope="row"><label for="name">Pay Name:</label></th>
<td>
<input name="name" type="text" value="<?php echo $options['name']; ?>" class="regular-text code">
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="note">Pay Note:</label></th>
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
<th scope="row"><label for="display">Display:</label></th>
<td>
<select name="display" id="display">
<option value='yes' <?php echo selected( $options['display'], 'yes', false);?>>Yes</option>
<option value='no' <?php echo selected( $options['display'], 'no', false);?>>No</option>
</select>
</td>
</tr>


</tbody>

</table>
<p class="submit"><input type="submit" class="button button-primary" value="Add"></p>
<input type=hidden name=act value="insert"/>
</form>

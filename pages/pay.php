<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<table class="form-table">
<tbody> 
<tr valign="top">
<th scope="row"><label for="name">Pay Name:</label></th>
<td>
<input name="name" type="text" value="<?php echo $pay['name']; ?>" class="regular-text code">
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="note">Pay Note:</label></th>
<td>
<input name="note" type="text" value="<?php echo $pay['note']; ?>" class="regular-text code">
</td>
</tr>

<tr>
<th scope="row"><label for="display">Display:</label></th>
<td>
<select name="display" id="display">
<option value='yes' <?php echo selected( $pay['display'], 'yes', false);?>>Yes</option>
<option value='no' <?php echo selected( $pay['display'], 'no', false);?>>No</option>
</select>
</td>
</tr>
</tbody>
</table>
<p><input type="submit" class="pay-update" value="Update"></p>
<input type=hidden name=pay_id value="<?php echo $tab;?>"/>
<input type=hidden name=act value=update />
</form>

<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('donate_author_post'); ?>
<p>
    <input type="submit" class="pay-delete" value="Delete">
</p>
<input type=hidden name=pay_id value="<?php echo $tab;?>"/>
<input type=hidden name=act value=delete />
</form>

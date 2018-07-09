<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<?php wp_nonce_field('baidu_index_auto_submit_param'); ?>
<table class="form-table">
<tbody> 
<tr valign="top">
<th scope="row"><label for="site">Pay Name:</label></th>
<td>
<input name="site" type="text" value="<?php echo $options['name']; ?>" class="regular-text code">
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="token">Pay Note:</label></th>
<td>
<input name="token" type="text" value="<?php echo $options['note']; ?>" class="regular-text code">
</td>
</tr>

<tr>
<th scope="row"><label for="type">Display:</label></th>
<td>
<select name="type" id="type">
<option value='original' <?php echo selected( $options['display'], 'yes', false);?>>Yes</option>
<option value='' <?php echo selected( $options['display'], '', false);?>>No</option>
</select>
</td>
</tr>


</tbody>

</table>

<p class="submit"><input type="submit" class="button button-primary" value="Save"></p>
</form>

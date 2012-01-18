<p>
	<?php echo form_open('main/add_link'); ?>
		<label>url shortener</label>
		<input type="text" name="url" id="url" />
		<input type="submit" value="shorten" />
		<?php echo form_error('url'); ?>
	</form>
</p>

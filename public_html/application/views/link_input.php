<p>
	<?php echo form_open('main/add_link'); ?>
		<h1>url shortener</h1>
		<input type="text" name="url" id="url" />
		<br/>
		<input type="submit" value="shorten" />
		<br/><br/>
		<?php echo form_error('url'); ?>
	</form>
</p>

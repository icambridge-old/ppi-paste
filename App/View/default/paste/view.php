<pre id="paste" class="prettyprint lang-<?php echo $syntax; ?> linenums"><?php echo trim(htmlspecialchars($content,ENT_QUOTES)); ?></pre>

<h3>Update Paste</h3>
<form method="post" action="/paste/revise/id/<?php echo $_id; ?>">
	<textarea name="paste_content" cols="100" rows="5"><?php echo trim(htmlspecialchars($content,ENT_QUOTES)); ?></textarea>
	<p><input type="submit" /></p>
</form>

<form method="post" action="/paste/diff/id/<?php echo $_id; ?>">

<h3>Diff</h3>
<?php	for( $i = 1; $i <= 2; $i++){ ?>
		<hr />
		<ul>
	<?php
		 foreach ( $_revs_info as $revision ){
		 if ( $revision->status == "available" ) { ?>
			<li><input type="radio" name="diff_revs[<?echo $i; ?>][]" value="<?php echo $revision->rev ?>" /> - <?php echo $revision->rev; ?></li>
<?php 		}
		} ?>
		</ul>
<?php }?>
	<hr />
	<input type="submit" />
</form>
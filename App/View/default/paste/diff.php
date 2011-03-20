<div id="diff">
	<?php 
		$oldRev = explode("\n",$docs[0]->ok->content);
		$newRev = explode("\n",$docs[1]->ok->content);
		$count = (sizeof($oldRev) > sizeof($newRev)) ? sizeof($oldRev) : sizeof($newRev);
		for ( $line = 0; $line < $count; $line++) {	
			if (isset($oldRev[$line]) && isset($newRev[$line]) && $oldRev[$line] == $newRev[$line]){
				?>
			<span class="same"><label><?php echo $line+1; ?></label> <?php echo htmlspecialchars($oldRev[$line],ENT_QUOTES); ?></span><br />
				<?php
			} else {
				 if (isset($oldRev[$line]) ){ ?>									
				<span class="old"><label><?php echo $line+1; ?></label> <?php echo htmlspecialchars($oldRev[$line],ENT_QUOTES); ?></span><br />
				<?php }
				 if (isset($newRev[$line]) ){ ?>
				<span class="new"><label><?php echo $line+1; ?></label> <?php echo htmlspecialchars($newRev[$line],ENT_QUOTES); ?></span><br />
				<?php	
				}	
			}
		}	
	?>
</div>
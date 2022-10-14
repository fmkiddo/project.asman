
			</div>
		</div>
	</div>
	<footer>
	</footer>
<?php if (isset ($pageAssets)): ?>
<?php foreach ($pageAssets->getScripts () as $script): ?>
	<script src="<?php $script->print (); ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
<?php if (isset ($psassets) && (count ($psassets['scripts']) > 0)): ?>
<?php foreach ($psassets['scripts'] as $psscript): ?>
	<script src="<?php echo $psscript; ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
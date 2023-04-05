<style type="text/css">
		#page { padding-top: 20px; }
</style>


<div class="container" id="page">
	<?php if( $this->id!=='install' ): ?>					
		<?php $this->renderPartial('/_menu'); ?>			
	<?php endif; ?>	
	
	<?php $this->renderPartial('/_flash'); ?>
			
	<?php echo $content; ?>
</div>
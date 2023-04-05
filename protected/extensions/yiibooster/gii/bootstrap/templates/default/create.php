<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<div class="portlet">
    <div class="portlet-heading bg-purple">
        <h3 class="portlet-title">
            <?php echo $this->modelClass; ?>
        </h3>
        <div class="portlet-widgets">
           <?php echo "<?php"; ?> 
			$this->widget(
    		'booster.widgets.TbButton',
	    		array(
	    			'buttonType'=>'link',		        
			        'size' => 'small',
			        'context'=>'purple',
			        'label' => 'Cancel',
			        'url'=>array('admin'),
	    		));
			?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="bg-purple" class="panel-collapse collapse in">
        <div class="portlet-body">
        	<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>	
        </div>
    </div>
</div>
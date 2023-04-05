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
				        'label' => 'Create',
				        'url'=>array('create'),
		    		));
				?>
        </div>
        <div class="clearfix"></div>
    </div>

	<div id="bg-purple" class="panel-collapse collapse in">
        <div class="portlet-body">
        	<div class="table-responsive">
					<?php echo "<?php"; ?> $this->widget('booster.widgets.TbGridView',array(
						'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
						'type'=>'condensed hover',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'columns'=>array(
						<?php
						$count = 0;
						foreach ($this->tableSchema->columns as $column) {
						if (++$count == 7) {
						echo "\t\t/*\n";
						}
						echo "\t\t'" . $column->name . "',\n";
						}
						if ($count >= 7) {
						echo "\t\t*/\n";
						}
						?>
							array(
								'class'=>'booster.widgets.TbButtonColumn',
							),
						),
					)); ?>
			</div>
        </div>
    </div>
</div>
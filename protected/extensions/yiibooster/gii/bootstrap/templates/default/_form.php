<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>


<?php
foreach ($this->tableSchema->columns as $column) {
	if ($column->autoIncrement) {
		continue;
	}
	?>
	<?php echo "<?php echo " . $this->generateActiveGroup($this->modelClass, $column) . "; ?>\n"; ?>

<?php
}
?>
	<?php echo "<?php \$this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'submit',
		'context'=>'primary',
		'label'=>\$model->isNewRecord ? 'Create' : 'Save',
	)); ?>\n"; ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

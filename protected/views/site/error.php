<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>

<?php
$this->widget(
	'booster.widgets.TbButton',
		array(
			'buttonType'=>'link',
				'size' => 'small',
				'context'=>'success',
				'label' => 'Back',
				'url'=>Yii::app()->HomeUrl,
		));
?>

<?php
$this->breadcrumbs=array(
	'Singkatans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Singkatan','url'=>array('index')),
	array('label'=>'Create Singkatan','url'=>array('create')),
	array('label'=>'View Singkatan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Singkatan','url'=>array('admin')),
	);
	?>

	<h1>Update Singkatan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
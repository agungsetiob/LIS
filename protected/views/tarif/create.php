<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("tarif") ?>">Kembali</a>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("tarif") ?>"> Tarif </a></li>
		<li>Add</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Tambah Tarif</h3>

			<div class="box-tools pull-right">
				
			</div>
		</div>

		<div class="box-body">
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	
		</div>
    </div>
</section>
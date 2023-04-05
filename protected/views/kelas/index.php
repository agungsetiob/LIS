<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("kelas/create") ?>">Tambah Kelas</a>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Kelas</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Kelas</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'kelas-grid',
					'type'=>'condensed bordered striped hover',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(						
						'nama',
						array(
							'class'=>'booster.widgets.TbButtonColumn',
							'template'=>'{update}{delete}',
							'buttons'=>array
            				(
								'update'=>array
								(
									'label'=>'Edit'
								)
							)
						),
					),
				)); ?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function(){
	$("#btn-refresh").on("click",function(e){
		$.fn.yiiGridView.update('kelas-grid',{
			data: $(this).serialize()
		});
	});
});
</script>
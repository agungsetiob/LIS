<section class="content-header">
	<div class="btn-group">
		
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Database</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Database</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'database-grid',
					'type'=>'condensed bordered striped hover',
					'dataProvider' => $dataProvider,
					'columns'=>array(						
						'nama',
						'ukuran',
						'waktu',
						array(
							'class'=>'booster.widgets.TbButtonColumn',
							'template'=>'{download}',
							'deleteConfirmation'=>'Delete Database ?',
							'buttons'=>array
            				(
								'download' => array
								(
									'icon'=>'fa fa-download',
									'label' => 'Download',
									'url'=>'Yii::app()->createUrl("db/download", array("file"=>$data["nama"]))',
								),
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
		$.fn.yiiGridView.update('database-grid',{
			data: $(this).serialize()
		});
	});
});
</script>
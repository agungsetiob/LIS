<section class="content-header">
	<div class="btn-group">
		
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Parameter</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Parameter</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'parameter-grid',
					'type' => 'condensed hover',
					'dataProvider'=>$model->search(),	
					'filter'=>$model,					
					'columns'=>array(
						'jenis',	
						array(
							'class'=>'booster.widgets.TbButtonColumn',
							'template'=>'{view}',
							'buttons'=>array
							(
								'view' => array
								(													
									'url'=>'Yii::app()->createUrl("parameter/view", array("id"=>$data->jenis))',
								),					
							),
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
		$.fn.yiiGridView.update('parameter-grid',{
			data: $(this).serialize()
		});
	});
});
</script>
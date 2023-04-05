<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("dokter/create") ?>">Tambah Dokter</a>
		<button class="btn btn-warning btn-sm" id="bridging">Bridging</button>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li>Dokter</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Dokter</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

		<div class="box-body">
			<div class="table-responsive">
				<?php $this->widget('booster.widgets.TbGridView',array(
					'id'=>'dokter-grid',
					'type'=>'condensed bordered striped hover',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(		
						'id_dokter',
						'nama',
						'nip',
						array(
							'name'=>'kode',
							'value'=>'Parameter::item("cKodeDokter",$data->kode)',
							'filter'=>Parameter::items("cKodeDokter"),
						),
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

<div class="modal fade" id="modal-bridging">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bridging Data Dokter</h4>
			</div>
			
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label required">ID Dokter <span class="required">*</span></label>
					<input class="col-md-12 col-xs-12 form-control" maxlength="50" style="margin-bottom:10px;" id="PegawaiID" type="text">
				</div>
				<button id="sinkron" class="btn btn-primary" type="button">Sinkron</button>
			</div>								
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#bridging').click(function(e) {
		$('#modal-bridging').modal('show');		
	});

	$('#sinkron').click(function(e) {
		var PegawaiID = $('#PegawaiID').val();
		if(PegawaiID!=""){
			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl("dokter/sinkron"); ?>',
				data: { PegawaiID: PegawaiID },
				success: function(data) {
					if(data=="sukses"){
						alert("Proses berhasil");
						$('#PegawaiID').val("");
						$('#dokter-grid').yiiGridView('update');
					} else {
						$('#PegawaiID').focus().select();
						alert("ID Dokter tidak ditemukan");
					}
				}
			})
		} else {
			$('#PegawaiID').focus();
			alert("ID Dokter harus di isi");
		}
	});

	$("#btn-refresh").on("click",function(e){
		$('#dokter-grid').yiiGridView('update');
	});
});
</script>
<style>
	.modal-dialog {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.modal-content {
		min-height: 100%;
		border-radius: 0;
	}
</style>

<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("periksa") ?>">Refresh</a>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("periksa") ?>"> Pemeriksaan </a></li>
		<li>Add</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Pemeriksaan Laboratorium</h3>

			<div class="box-tools pull-right"></div>
		</div>

		<div class="box-body">
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	
		</div>
    </div>
</section>

<div class="modal fade" id="modal-pending">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pending</h4>
			</div>
			
			<div class="modal-body">
				<?php echo $this->renderPartial('admin', array('model'=>$periksa)); ?>
			</div>								
		</div>
	</div>
</div>

<div class="modal fade" id="modal-pasien">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pasien</h4>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-md-3">
						<input class="col-md-12 col-xs-12 form-control input-sm" id="no_rm" value="" placeholder="No RM">
					</div>
					<div class="col-md-3">
						<button type="button" class="btn btn-warning btn-sm" id="bridging">Bridging</button>
					</div>
				</div>
				<hr>
				<?php $this->renderPartial("/pasien/cari", array("model"=>$pasien)); ?>
			</div>								
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){	
	$('#btn-pending').click(function() {
		$.fn.yiiGridView.update('periksa-grid',{
			data: $(this).serialize()
		});
		$('#modal-pending').modal('show');
	});
	
	$('#cari-pasien').click(function(e) {
		e.preventDefault();
		$.fn.yiiGridView.update('pasien-grid',{
			data: $(this).serialize()
		});
		$('#modal-pasien').modal('show');
	});

	$('#bridging').click(function(e) {
		var no_rm = $("#no_rm").val();
		
		$.ajax({
			url: '<?php echo Yii::app()->createUrl("periksa/pasien"); ?>',
			data: {
				no_rm: no_rm
			},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.status == "sukses") {
					$("#Periksa_id_pasien").val(data.id);
					$("#Periksa_nama_pasien").val(data.nama);
					$('#modal-pasien').modal('hide');
				} else {
					alert("gagal");
				}
			}
		});
	});
});
</script>
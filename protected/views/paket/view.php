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
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("paket") ?>">Kembali</a>
	</div>

	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("paket") ?>"> Paket </a></li>
		<li>Detail</li>
	</ol>
</section>

<section class="content">
    <div class="box box-info">
	<div class="box-header with-border">
			<h3 class="box-title"><?= $model->nama ?></h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" id="btn-refresh" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></button>
			</div>
		</div>

        <div class="box-body">
            <div class="tab-pane" id="tchild">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50%;">Nama</th>
                            <th>LIS</th>
                            <th width="5%;" class="text-center"><button class="btn btn-primary btn-xs" id="btn-kode-manual"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="child"></tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-kode">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Kode Lab</h4>
			</div>

			<div class="modal-body">
				<?php $this->renderPartial("/kode/lookup2", array("model"=>$kode)); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-kode-manual">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kode Manual</h4>
            </div>

            <div class="modal-body">
                <?php echo $this->renderPartial('/kode/lookup_paket', array('model'=>$modelKode,'idParent'=>$model->id)); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
    $("#child").load("<?php echo Yii::app()->createUrl("paket/detail", array("id"=>$model->id)); ?>");

	$("#btn-kode-manual").click(function() {
		$("#modal-kode-manual").modal('show');
	});

    $('#cari-kode').click(function(e) {
		e.preventDefault();
		$.fn.yiiGridView.update('kode-grid',{
			data: $(this).serialize()
		});
		$('#modal-kode').modal('show');
	});

    $("#addChild").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl("paket/kode"); ?>',
			data: {
				idParent: <?= $model->id ?>,
				id: $("#LaporanKode_kode").val()
			},
			type: "POST",
			success: function(data){
				$("#child").load("<?php echo Yii::app()->createUrl("paket/child", array("id"=>$model->id)); ?>");
				$("#LaporanKode_kode").val('0');
				$("#Laporan_nama_kode").val('');
				$("#Laporan_lis").val('');
			}
		});
	});

	$("#btn-refresh").on("click",function(e){
		$("#child").load("<?php echo Yii::app()->createUrl("paket/detail", array("id"=>$model->id)); ?>");
	});
});
</script>
<section class="content-header">
	<div class="btn-group">
		<button type="button" class="btn btn-info btn-sm"><i class="fa fa-chevron-left"></i></button>
		<a class="btn btn-bitbucket btn-sm" href="<?= Yii::app()->createUrl("parameter") ?>">Kembali</a>
	</div>
	  
	<ol class="breadcrumb">
		<li><a href="<?= Yii::app()->createUrl("dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>
		<li><a href="<?= Yii::app()->createUrl("parameter") ?>"> Parameter </a></li>
		<li>Detail</li>
	</ol>
</section>


<section class="content">
    <div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Detail Parameter</h3>

			<div class="box-tools pull-right">
				
			</div>
		</div>

		<div class="box-body">
			<table  class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Jenis</th>						
						<th>ID</th>						
						<th>Parameter</th>
						<th>Order</th>
						<th width='5%'></th>
					</tr>
				</thead>
				<tbody>
					<tr>					
						<td><input type="text" class="form-control input-sm col-md-12" id="jenis" readonly="" value="<?= $model->jenis ?>"></td>
						<td><input type="text" class="form-control input-sm col-md-12" id="id" autocomplete="off"></td>
						<td><input type="text" class="form-control input-sm col-md-12" id="nama" autocomplete="off"></td>	
						<td><input type="text" class="form-control input-sm col-md-12" id="order" autocomplete="off"></td>	
                        <td class='text-center'><button class="btn btn-primary btn-xs"><i class="fa fa-plus add"></i></button></td>				
					</tr>
				</tbody>
				<tbody id="detail">
				</tbody>
			</table>
		</div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function(e){
	$("#detail").load("<?php echo Yii::app()->createUrl("parameter/detail", array("id"=>$model->jenis)); ?>");

	$(".add").click(function(){
		var dataForm = {
			jenis: $("#jenis").val(),
			id: $("#id").val(),
			nama: $("#nama").val(),
			order: $("#order").val(),
		};

		$.ajax({
			url: '<?php echo Yii::app()->createUrl("parameter/add"); ?>',
			data: dataForm,
			type: "POST",
			success: function(data){
				$("#detail").load("<?php echo Yii::app()->createUrl("parameter/detail", array("id"=>$model->jenis)); ?>");
				$("#id").val('');
				$("#nama").val('');
				$("#order").val('');
			}
		});
	});
});
</script>
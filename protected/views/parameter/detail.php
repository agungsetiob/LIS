<?php
    foreach ($model as $data) {
        echo "<tr>
            <td>$data->jenis</td>
            <td>$data->id</td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-jenis='$data->jenis' data-id='$data->id' value='$data->nama'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah2' data-jenis='$data->jenis' data-id='$data->id' value='$data->order'></td>
            <td class='text-center'><button class='btn btn-danger btn-xs delete' data-jenis='$data->jenis' data-id='$data->id'><i class='fa fa-trash'></i></button></td>
        </tr>";
    }
?>

<script type="text/javascript">
$(document).ready(function(){
	$(".delete").on("click",function(e){
        var dataForm = {
			id: $(this).attr("data-id"),
			jenis: $(this).attr("data-jenis"),
		};

        $.ajax({
            type:"POST",
            url:"<?php echo Yii::app()->createUrl("parameter/delete"); ?>",
            data: dataForm,
            success:function(data){
                $("#detail").load("<?php echo Yii::app()->createUrl("parameter/detail", array("id"=>$id)); ?>");
            }
        });
	});

    $(".ubah").change(function(){
         var dataForm = {
			id: $(this).attr("data-id"),
			jenis: $(this).attr("data-jenis"),
			nama: $(this).val(),
		};

		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("parameter/edit"); ?>',
            data: dataForm,
        });
	});

     $(".ubah2").change(function(){
         var dataForm = {
			id: $(this).attr("data-id"),
			jenis: $(this).attr("data-jenis"),
			order: $(this).val(),
		};

		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("parameter/edit2"); ?>',
            data: dataForm,
        });
	});
});
</script>
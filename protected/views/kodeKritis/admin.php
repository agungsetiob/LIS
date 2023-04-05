<?php
    foreach ($model as $data) {
        echo "<tr>
            <td><select class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='sex'>
                <option value='0'></option>";
                    foreach (Parameter::getItems('cSex') as $sex) {
                        if($data->sex==$sex->id){
                            echo "<option value='$sex->id' selected>$sex->nama</option>";
                        } else {
                            echo "<option value='$sex->id'>$sex->nama</option>";
                        }
                    }
            echo "</select></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='umur1' value='$data->umur1'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='umur2' value='$data->umur2'></td>
            <td><select class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='waktu'>
                <option value='0'></option>";
                    foreach (Parameter::getItems('cWaktu') as $waktu) {
                        if($data->waktu==$waktu->id){
                            echo "<option value='$waktu->id' selected>$waktu->nama</option>";
                        } else {
                            echo "<option value='$waktu->id'>$waktu->nama</option>";
                        }
                    }
            echo "</select></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='nk1' value='$data->nk1'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah1' data-id='$data->id' data-field='nk2' value='$data->nk2'></td>
            <td><button class='btn btn-danger btn-xs delete1' data-id='$data->id'><i class='fa fa-trash'></i></button></td>
        </tr>";
    }
?>

<script type="text/javascript">
$(document).ready(function(){
	$(".delete1").on("click",function(e){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"<?php echo Yii::app()->createUrl("KodeKritis/delete"); ?>",
            data:{ id : id },
            success:function(data){
                $("#detailKritis").load("<?php echo Yii::app()->createUrl("KodeKritis/admin", array("id"=>$id)); ?>");
            }
        });
	});

    $(".ubah1").change(function(){
		var id = $(this).attr("data-id");
		var field = $(this).attr("data-field");
		var value = $(this).val();

		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("KodeKritis/ubah"); ?>',
			data: {
				id : id,
				field : field,
				value : value,
			}
        });
	});
});
</script>
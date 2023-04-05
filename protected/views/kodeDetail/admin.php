<?php
    foreach ($model as $data) {
        echo "<tr>
            <td><select class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='sex'>
                <option value='0'></option>";
                    foreach (Parameter::getItems('cSex') as $sex) {
                        if($data->sex==$sex->id){
                            echo "<option value='$sex->id' selected>$sex->nama</option>";
                        } else {
                            echo "<option value='$sex->id'>$sex->nama</option>";
                        }
                    }
            echo "</select></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='umur1' value='$data->umur1'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='umur2' value='$data->umur2'></td>
            <td><select class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='waktu'>
                <option value='0'></option>";
                    foreach (Parameter::getItems('cWaktu') as $waktu) {
                        if($data->waktu==$waktu->id){
                            echo "<option value='$waktu->id' selected>$waktu->nama</option>";
                        } else {
                            echo "<option value='$waktu->id'>$waktu->nama</option>";
                        }
                    }
            echo "</select></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='nr1' value='$data->nr1'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='nr2' value='$data->nr2'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='nr' value='$data->nr'></td>
            <td><input type='text' class='form-control input-sm col-md-12 ubah' data-id='$data->id' data-field='keterangan' value='$data->keterangan' maxlength='25'></td>
            <td><button class='btn btn-danger btn-xs delete' data-id='$data->id'><i class='fa fa-trash'></i></button></td>
        </tr>";
    }
?>

<script type="text/javascript">
$(document).ready(function(){
	$(".delete").on("click",function(e){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"<?php echo Yii::app()->createUrl("KodeDetail/delete"); ?>",
            data:{ id : id },
            success:function(data){
                $("#detail").load("<?php echo Yii::app()->createUrl("KodeDetail/admin", array("id"=>$id)); ?>");
            }
        });
	});

    $(".ubah").change(function(){
		var id = $(this).attr("data-id");
		var field = $(this).attr("data-field");
		var value = $(this).val();

		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createUrl("KodeDetail/ubah"); ?>',
			data: {
				id : id,
				field : field,
				value : value,
			}
        });
	});
});
</script>
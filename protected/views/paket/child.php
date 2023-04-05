<?php
    foreach ($model as $data) {
        echo "<tr>
            <td>$data->nama</td>
            <td>$data->lis</td>
            <td class='text-center'><button class='btn btn-danger btn-xs delete' data-id='$data->id'><i class='fa fa-trash'></i></button></td>
        </tr>";
    }
?>

<script type="text/javascript">
$(document).ready(function(){
	$(".delete").on("click",function(e){
        var id = $(this).attr("data-id");
        $.ajax({
            type:"POST",
            url:"<?php echo Yii::app()->createUrl("paket/kdelete"); ?>",
            data:{ id : id, idPaket : <?= $_GET['id'] ?> },
            success:function(data){
                $("#child").load("<?php echo Yii::app()->createUrl("paket/child", array("id"=>$id)); ?>");
            }
        });
	});
});
</script>
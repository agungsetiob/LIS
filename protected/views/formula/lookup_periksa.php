<div class="table-responsive">
    <table id="datatableFormula" class="items table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th></th>
                <th>LIS</th>
                <th>Formula</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $data) {
                echo "<tr>
                    <td><input type='checkbox' class='chk' value='$data->id'></td>
                    <td>$data[lis]</td>
                    <td>$data[isi_formula]</td>
                </tr>";

                $no++;
            }
            ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-1">
            <button class="btn btn-danger btn-sm" id="prosesFormula">Proses</button>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
    $('#datatableFormula').dataTable();

    $("#prosesFormula").on("click",function(e){
        id_array= new Array();
		i=0;
		var oTable = $('#datatableFormula').dataTable();
		var rowcollection =  oTable.$(".chk:checked", {"page": "all"});
		rowcollection.each(function(index,elem){
			id_array[i] = $(elem).val();
			i++;
		});

        if(id_array.length > 0) {
			var sure = confirm("Proses Pemeriksaan Manual ?");
			if(sure){
				$.ajax({
					url: '<?php echo Yii::app()->createUrl("periksa/formula&id=".$KodePatient); ?>',
					data: "kode="+id_array,
					type: "POST",
					success: function(data){
						if(data=="sukses"){
							location.reload();
						} else {
							alert("Gagal");
						}
					}
				})
			}
		} else {
			alert("Pilih formula terlebih dahulu");
		}
    });
});
</script>

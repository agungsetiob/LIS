<div class="table-responsive">
    <table id="datatable" class="items table table-condensed table-hover table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Pemeriksaan</th>
                <th>Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $data) {
                echo "<tr>
                    <td><input type='checkbox' class='chk' value='$data->id'></td>
                    <td>$data->pemeriksaan</td>
                    <td>" . Yii::app()->indoFormat->number($data->tarif) . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-1">
            <button class="btn btn-danger btn-sm" id="proses">Proses</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
        $('#datatable').dataTable({});

        $("#proses").on("click", function(e) {
            id_array = new Array();
            i = 0;
            var oTable = $('#datatable').dataTable();
            var rowcollection = oTable.$(".chk:checked", {
                "page": "all"
            });
            rowcollection.each(function(index, elem) {
                id_array[i] = $(elem).val();
                i++;
            });

            if (id_array.length > 0) {
                var sure = confirm("Proses Tarif Pemeriksaan ?");
                if (sure) {
                    $.ajax({
                        url: '<?php echo Yii::app()->createUrl("periksa/tarif&id=" . $_GET['id']); ?>',
                        data: "kode=" + id_array,
                        type: "POST",
                        success: function(data) {
                            if (data == "sukses") {
                                location.reload();
                            } else {
                                alert("Gagal");
                            }
                        }
                    })
                }
            } else {
                alert("Pilih tarif terlebih dahulu");
            }
        });
    });
</script>
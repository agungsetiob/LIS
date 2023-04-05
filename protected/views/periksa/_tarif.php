<p>
    <?php if ($model->total == 0) : ?>
    <?php else : ?>
    <?php endif; ?>

    <button type="button" class="btn btn-primary" id="btn-tarif">Tarif Pemeriksaan</button>
    <!-- <button type="button" class="btn btn-success" id="btn-selesai">Selesai</button> -->
    <button type="button" class="btn btn-danger" id="btn-cetak">Cetak</button>
</p>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Pemeriksaan</th>
            <th width="15%" class="text-right">Tarif</th>
            <th width="15%" class="text-center">Qty</th>
            <th width="15%" class="text-right">Sub Total</th>
            <th width="5%"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($modelBiaya as $data) {
            $subtotal = $data->tarif * $data->qty;
            // $delete = ($model->total == 0) ? "<button class='btn btn-danger btn-xs delete' data-id='$data->id'><i class='fa fa-trash'></i></button>" : "";
            $delete = "<button class='btn btn-danger btn-xs delete' data-id='$data->id'><i class='fa fa-trash'></i></button>";

            echo "<tr>
                <td>" . $data->tarif0->pemeriksaan . "</td>
                <td class='text-right'>" . Yii::app()->indoFormat->number($data->tarif) . "</td>
                <td class='text-center'>$data->qty</td>
                <td class='text-right'>" . Yii::app()->indoFormat->number($subtotal) . "</td>
                <td class='text-center'>$delete</td>
            </tr>";

            $total += $subtotal;
        }

        echo "<tr>
            <th colspan='3'>Total</th>
            <th class='text-right'>" . Yii::app()->indoFormat->number($total) . "</th>
        </tr>";
        ?>
    <tbody>
</table>

<div class="modal fade" id="modal-tarif">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tarif Pemeriksaan</h4>
            </div>

            <div class="modal-body">
                <?php echo $this->renderPartial('/tarif/lookup', array('model' => $modelTarif)); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btn-refresh").click(function() {
            location.reload();
        });

        $("#btn-tarif").click(function() {
            $("#modal-tarif").modal('show');
        });

        $(".delete").on("click", function(e) {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl("periksa/bdelete"); ?>",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        });

        $('#btn-selesai').click(function() {
            var sure = confirm("Selesai Biaya Pemeriksaan ?");

            if (sure) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->createUrl("periksa/sbayar"); ?>',
                    data: {
                        id: <?= $_GET['id'] ?>,
                        total: <?= $total ?>,
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        });

        $("#btn-cetak").click(function() {
            url = 'index.php?r=periksa/cetakbiaya&id=<?= $model->id ?>&t=<?= $total ?>';
            var win = window.open(url, '_blank');
            win.focus();
        });
    });
</script>
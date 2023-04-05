<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                Sampel
            </div>
            <div class="col-md-9">
                : <b><?= $sampel ?> | <?= $alat ?></b>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                Tanggal
            </div>
            <div class="col-md-9">
                : <b><?= $tgl ?></b>
            </div>
        </div>
    </div>
</div>

<hr>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class='text-center'>No</th>
            <th class='text-center'>Parameter</th>
            <th class='text-center'>Nilai</th>
            <th class='text-center'>LIS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($model as $data) {
            echo "<tr>
                <td class='text-center'>$no</td>
                <td class='text-center'>$data[KodeParamater]</td>
                <td class='text-center'>$data[Nilai]</td>
                <td class='text-center'>" . Kode::getFieldByLis($data['KodeParamater'], 'nama') . "</td>
            </tr>";

            $no++;
        }
        ?>
    </tbody>
</table>
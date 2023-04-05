<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="250px">Pemeriksaaan </th>
            <th class='text-center' width="150px">Hasil</th>
            <th class='text-center'>Flag</th>
            <th class='text-center'>N Rujukan</th>
            <th class='text-center'>ACC</th>
            <th class='text-center'>Satuan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $waktu = VPasien::getField($model->id_pasien, 'umur');
        $kritisHeader = 0;
        $noid = 1;
        if (!isset($_GET['group'])) {
            $sql0 = "SELECT b.grup1 FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis LEFT JOIN v_grup c ON b.grup1=c.nama WHERE a.KodePatient LIKE '%$model->nomor%' GROUP BY b.grup1 ORDER BY c.order";
            $detail0 = Yii::app()->db->createCommand($sql0)->queryAll();

            foreach ($detail0 as $data0) {
                $acc = Result::getGrupAcc($model->nomor, $data0['grup1']);

                echo "<tr><th colspan='4'>$data0[grup1]</th>";

                if ($acc == 0) {
                    echo "<th class='text-center'><input type='checkbox' data-id='$data0[grup1]' disabled data-nomor='$model->nomor' class='gacc' checked ></th>";
                } else {
                    echo "<th class='text-center'><input type='checkbox' data-id='$data0[grup1]' disabled data-nomor='$model->nomor' class='gacc'></th>";
                }

                echo "<th colspan='5'></th></tr>";

                $sql = "SELECT b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan, a.KodeAlat, b.pilihan FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND b.grup1='$data0[grup1]' ORDER BY b.order";
                $detail = Yii::app()->db->createCommand($sql)->queryAll();

                foreach ($detail as $data) {
                    if ($data['pembulatan'] == 0) {
                        $nilai = round($data['Nilai']);
                    } else if ($data['pembulatan'] == 99) {
                        $nilai = $data['Nilai'];
                    } else {
                        $nilai = round($data['Nilai'], $data['pembulatan']);
                    }

                    $nilaiFormula = Formula::getNilai($data['KodeParamater'], $KodePatient);
                    if ($nilaiFormula != 0) {
                        $nilai = $nilaiFormula;
                    }

                    $delete = "none";
                    if ($data['KodeAlat'] == '-') {
                        $delete = "";
                    }

                    $inputNilai = $nilai;

                    $flag = VKode::getFlag($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, $nilai);
                    $kritis = VKode::getKritis($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, $nilai);
                    $nr = VKode::getField($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, 'nr');

                    $bgcolor = "";

                    if ($kritis == '#') {
                        $flag = "<span class='label label-danger'>!</span>";
                        $bgcolor = "danger";
                        $kritisHeader++;
                    }

                    echo "<tr class='$bgcolor'>
                    <td>$data[nama]</td>
                    <td class='text-center'>$inputNilai</td>
                    <td class='text-center'>$flag</td>
                    <td class='text-center'>$nr</td>";

                    if ($data['acc'] == 1) {
                        echo "<td class='text-center'><input type='checkbox' disabled class='acc' data-id='$data[id]' checked></td>";
                    } else {
                        echo "<td class='text-center'><input type='checkbox' disabled class='acc' data-id='$data[id]'></td>";
                    }

                    echo "<td class='text-center'>$data[satuan]</td>
                            </tr>";

                    $noid++;
                }
            }
        }
        ?>
    <tbody>
</table>
<hr>
<div class="btn-group">
    <button type="button" class="btn btn-success" id="btn-cetak" style='display: <?= $displayCetak ?>;'>Cetak</button>
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style='display: <?= $displayCetak ?>;'>
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#" id="btn-antigen">Format Antigen</a></li>
        <li><a href="#" id="btn-cetak-gdt">Format MDT</a></li>
    </ul>
</div>
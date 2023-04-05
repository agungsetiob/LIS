    <p><button type="button" class="btn btn-primary" id="btn-kode-manual">Pemeriksaan Manual</button>
        <button type="button" class="btn btn-success" id="btn-kode-alat">Pemeriksaan Alat</button>
    </p>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th width="250px">Pemeriksaaan</th>
                <th class='text-center' width="150px">Hasil</th>
                <th class='text-center'>Flag</th>
                <th class='text-center'>N Rujukan</th>
                <th class='text-center'>ACC</th>
                <th class='text-center'>Satuan</th>
                <th class='text-center'></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $waktu = VPasien::getField($model->id_pasien, 'umur_hari');
            $kritisHeader = 0;
            $noid = 1;
            if (!isset($_GET['group'])) {
                $sql0 = "SELECT b.grup1 
            FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis LEFT JOIN v_grup c ON b.grup1=c.nama WHERE a.KodePatient LIKE '%$model->nomor%' AND b.grup1 IS NOT NULL GROUP BY b.grup1 ORDER BY c.order";
                $detail0 = Yii::app()->db->createCommand($sql0)->queryAll();

                foreach ($detail0 as $data0) {
                    $acc = Result::getGrupAcc($model->nomor, $data0['grup1']);

                    echo "<tr><th colspan='4'>$data0[grup1]</th>";

                    if ($acc == 0) {
                        echo "<th class='text-center'><input type='checkbox' data-id='$data0[grup1]' data-nomor='$model->nomor' class='gacc' checked ></th>";
                    } else {
                        echo "<th class='text-center'><input type='checkbox' data-id='$data0[grup1]' data-nomor='$model->nomor' class='gacc'></th>";
                    }

                    echo "<th colspan='5'></th></tr>";

                    $sql = "SELECT b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan, a.KodeAlat, b.pilihan FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND b.grup1='$data0[grup1]' GROUP BY b.nama ORDER BY b.order";
                    $detail = Yii::app()->db->createCommand($sql)->queryAll();

                    foreach ($detail as $data) {
                        $idKode = Kode::getFieldByLis($data['KodeParamater'], 'id');
                        
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

                        $inputNilai = "<input type='text' class='form-control nilai col-md-12 text-center' data-id='$data[id]' data-no='$noid' id='$noid' value='$nilai'>";

                        $flag = VKode::getFlag($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, $nilai);
                        $kritis = VKode::getKritis($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, $nilai);
                        $nr = VKode::getField($data['KodeParamater'], $data['parameter'], $waktu, $model->idPasien->gender, 'nr');

                        if ($kritis == '#') {
                            $flag = "<span class='label label-danger'>!</span>";
                            $kritisHeader++;
                        }


                        echo "<tr>
                        <td><a href='index.php?r=kode/view&id=$idKode' target='_blank'>$data[nama]</a></td>
                    <td>";

                        if ($data['pilihan'] != 0) {
                            $pilihan = 'cHasil' . $data['pilihan'];
                            echo "<select class='form-control nilai col-md-12' data-id='$data[id]'> <option value='-' $nilai>-</option>";

                            $mp = Parameter::model()->findAll(array('condition' => 'jenis=:id', 'params' => array(':id' => $pilihan)));
                            foreach ($mp as $dp) {
                                if ($nilai == $dp->nama) {
                                    echo "<option value='$dp->nama' selected>$dp->nama</option>";
                                } else {
                                    echo "<option value='$dp->nama'>$dp->nama</option>";
                                }
                            }
                        } else {
                            echo $inputNilai;
                        }

                        echo "</td>
                            <td class='text-center'>$flag</td>
                            <td class='text-center'>$nr</td>";

                            if ($data['acc'] == 1) {
                                echo "<td class='text-center'><input type='checkbox' $disabled class='acc' data-id='$data[id]' checked></td>";
                            } else {
                                echo "<td class='text-center'><input type='checkbox' $disabled class='acc' data-id='$data[id]'></td>";
                            }

                            echo "<td class='text-center'>$data[satuan]</td>
                                    <td class='text-center'><button class='btn btn-danger btn-xs delete' style='display: $delete;' data-id='$data[id]'><i class='fa fa-trash'></i></button></td>
                            </tr>";

                        $noid++;
                    }
                }
            } else {
                // GRUP BY ALAT
                if ($_GET['group'] == 'alat') {
                    $sql0 = "SELECT KodeAlat FROM result WHERE KodePatient LIKE '%$model->nomor%' GROUP BY KodeAlat";
                    $detail0 = Yii::app()->db->createCommand($sql0)->queryAll();

                    foreach ($detail0 as $data0) {
                        echo "<tr>
                        <th colspan='9'>$data0[KodeAlat]</th>
                    </tr>";

                        $sql = "SELECT b.nama, a.Nilai, a.keterangan, b.satuan, b.metoda, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan, a.KodeAlat FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient LIKE '%$model->nomor%' AND a.KodeAlat='$data0[KodeAlat]'";
                        $detail = Yii::app()->db->createCommand($sql)->queryAll();

                        foreach ($detail as $data) {
                            echo "<tr>
                    <td>$data[nama]</td>
                    <td class='text-center'>$data[Nilai]</td>
                    <td class='text-center'></td>
                    <td></td>
                    <td></td>";
                            echo "<td class='text-center'>$data[satuan]</td>
                        <td class='text-center'></td>
                        <td class='text-center'></td>
                    </tr>";
                        }
                    }
                }

                // GRUP BY GDT
                else {
                    $sql = "SELECT b.nama, a.Nilai, a.KodeParamater, a.acc, a.id, b.parameter, b.pembulatan, a.KodeAlat FROM result a LEFT JOIN kode b ON a.KodeParamater=b.lis WHERE a.KodePatient = '$model->nomor' ORDER BY b.order";
                    $detail = Yii::app()->db->createCommand($sql)->queryAll();

                    foreach ($detail as $data) {
                        if ($data['pembulatan'] == 0) {
                            $nilai = round($data['Nilai']);
                        } else if ($data['pembulatan'] == 99) {
                            $nilai = $data['Nilai'];
                        } else {
                            $nilai = round($data['Nilai'], $data['pembulatan']);
                        }

                        $inputNilai = "<textarea class='form-control nilai col-md-12' data-id='$data[id]' data-no='$noid' id='$noid'>$nilai</textarea>";

                        echo "<tr>
                    <td>$data[nama]</td>
                    <td colspan='6'>$inputNilai</td>";
                        if ($data['acc'] == 1) {
                            echo "<td class='text-center'><input type='checkbox' $disabled class='acc' data-id='$data[id]' checked></td>";
                        } else {
                            echo "<td class='text-center'><input type='checkbox' $disabled class='acc' data-id='$data[id]'></td>";
                        }
                        echo "<td class='text-center'><button class='btn btn-danger btn-xs delete' data-id='$data[id]'><i class='fa fa-trash'></i></button></td></tr>";

                        $noid++;
                    }
                }
            }
            if ($kritisHeader != 0) {
                $model->kritis = 1;
                $model->save(false);
            } else {
                $model->kritis = 0;
                $model->save(false);
            }
            ?>
        <tbody>
    </table>
    <hr>
    <button type="button" class="btn btn-danger" id="btn-selesai" style='display: <?= $displaySelesai ?>;'>Selesai</button>

    <?php if (Yii::app()->user->checkAccess('ValidasiHasil')) : ?>
        <button type="button" class="btn btn-primary" id="btn-validasi" style='display: <?= $displayValidasi ?>;'>Validasi</button>
    <?php endif ?>

    <div class="btn-group">
        <button type="button" class="btn btn-success" id="btn-cetak" style='display: <?= $displayCetak ?>;'>Cetak</button>
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style='display: <?= $displayCetak ?>;'>
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="btn-antigen">Format Antigen</a></li>
            <li><a href="#" id="btn-cetak-gdt">Format MDT</a></li>
            <!-- <li><a href="#" id="btn-cetak-pcr">Format PCR</a></li>
            <li><a href="#" id="btn-surat-pcr">Surat PCR</a></li> -->
        </ul>
    </div>

    <div class="modal fade" id="modal-kode-manual">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pemeriksaan Manual</h4>
                </div>

                <div class="modal-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#periksaKodeManual" data-toggle="tab" aria-expanded="true">Kode</a></li>
                            <li class=""><a href="#periksaKodeFaket" data-toggle="tab" aria-expanded="false">Paket</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="periksaKodeManual">
                                <?php echo $this->renderPartial('/kode/lookup_periksa', array('model' => $modelKode, 'KodePatient' => $KodePatient)); ?>
                            </div>

                            <div class="tab-pane" id="periksaKodeFaket">
                                <?php echo $this->renderPartial('/paket/lookup_periksa', array('model' => $modelPeriksa, 'KodePatient' => $KodePatient)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-kode-alat">
        <div class="modal-dialog modal-full">
            <div class="modal-content modal-content-full">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pemeriksaan Alat</h4>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <?php $this->widget('booster.widgets.TbGridView', array(
                            'id' => 'result-grid',
                            'type' => 'condensed hover',
                            'dataProvider' => $modelResult->search(),
                            'filter' => $modelResult,
                            'columns' => array(
                                'KodePatient',
                                array(
                                    'name' => 'KodeAlat',
                                    'filter' => VResult::alat(),
                                ),
                                'tgl',
                                array(
                                    'class' => 'booster.widgets.TbButtonColumn',
                                    'template' => '{detail}{view}',
                                    'buttons' => array(
                                        'detail' =>
                                        array(
                                            'label' => 'Detail',
                                            'icon' => 'glyphicon glyphicon-eye-open',
                                            'url' => 'Yii::app()->createUrl("result/detail", array("alat" => $data->KodeAlat, "sampel" => $data->KodePatient,  "tgl" => $data->tgl, "tanggal" => $data->tanggal))',
                                            'options' => array(
                                                'onclick' => '$("#modal-pemeriksaan").modal("show");',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'url' => "js:$(this).attr('href')",
                                                    'update' => '.modal-body-pemeriksaan',
                                                ),
                                            ),
                                        ),
                                        'view' =>
                                        array(
                                            'label' => 'Proses',
                                            'icon' => 'glyphicon glyphicon-check',
                                            'url' => 'Yii::app()->createUrl("periksa/alat", array("id" => ' . $_GET['id'] . ', "nomor" => ' . $model->nomor . ', "sampel" => $data->KodePatient, "tanggal" => $data->tanggal))',
                                        ),
                                    ),
                                ),
                            ),
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pemeriksaan" style="z-index:1000000000">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Pemeriksaan Alat</h4>
                </div>

                <div class="modal-body">
                    <div class="modal-body-pemeriksaan">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-kode-manual").click(function() {
                $("#modal-kode-manual").modal('show');
            });
        });
    </script>
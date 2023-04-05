<table  class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No Lab</th>
            <th>Tanggal</th>
            <th>Pemeriksaaan </th>
            <th width="200px">Hasil</th>
            <th>Flag</th>
            <th>N Rujukan</th>
            <th>Satuan</th>
            <th>Metoda</th>
            <th>Kode</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $umur = Pasien::umur($pasien->tgl_lahir);
        $aumur = explode(",",$umur);
        $waktu =  count($aumur);

        foreach ($model as $data) {
            if($data['pembulatan']==0){
                $nilai = round($data['Nilai']);
            }
            else if($data['pembulatan']==99){
                $nilai = $data['Nilai'];
            }
            else {
                $nilai = round($data['Nilai'],$data['pembulatan']);
            }

            echo "<tr>
                <td>$data[nomor]</td>
                <td>$data[tanggal]</td>
                <td>$data[nama]</td>
                <td>$nilai</td>
                <td>".VKode::getFlag($data['KodeParamater'],$data['parameter'],$waktu,$pasien->gender,$nilai)."</td>
                <td>".VKode::getField($data['KodeParamater'],$data['parameter'],$waktu,$pasien->gender,'nr')."</td>
                <td>$data[satuan]</td>
                <td>$data[metoda]</td>
                <td>$data[KodeParamater]</td>
            </tr>";
        }
    ?>
    </tbody>
</table>
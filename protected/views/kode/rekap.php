<h3>Nilai Rujukan</h3>
<table width="100%" border="1">
    <tr>
        <th>No</th>
        <th>LIS</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Parameter</th>
        <th>Sex</th>
        <th>Umur 1</th>
        <th>Umur 2</th>
        <th>Waktu</th>
        <th>NR 1</th>
        <th>NR 2</th>
        <th>Rujukan</th>
    </tr>
    <?php
        $no=1;
        $lis = '';            
        foreach ($model as $data) {
            $jenis = 'MANUAL';

            if($data['lis']!=$lis){
                $lis=$data['lis'];

                echo "<tr>
                    <td width='50px' align='center'>$no</td>
                    <td><a href=".Yii::app()->createUrl("kode/view", array('id'=>$data['id']))." target='_blank'>$lis</a></td>
                    <td>$data[nama]</td>
                    <td>$jenis</td>
                    <td>".Parameter::item("cParameter",$data['parameter'])."</td>                
                    <td>".Parameter::item("cSex",$data['sex'])."</td>                
                    <td>$data[umur1]</td>
                    <td>$data[umur2]</td>
                    <td>".Parameter::item("cWaktu",$data['waktu'])."</td>
                    <td>$data[nr1]</td>
                    <td>$data[nr2]</td>             
                    <td>$data[nr]</td>             
                </tr>";
                
                $no++;
            } else {
                echo "<tr>
                    <td></td>   
                    <td></td>   
                    <td></td>
                    <td></td>
                    <td></td>                
                    <td>".Parameter::item("cSex",$data['sex'])."</td>                
                    <td>$data[umur1]</td>
                    <td>$data[umur2]</td>
                    <td>".Parameter::item("cWaktu",$data['waktu'])."</td>
                    <td>$data[nr1]</td>
                    <td>$data[nr2]</td>             
                    <td>$data[nr]</td>             
                </tr>";
            }
        }
    ?>
</table>

<h3>Nilai Kritis</h3>
<table width="100%" border="1">
    <tr>
        <th>No</th>
        <th>LIS</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Parameter</th>
        <th>Sex</th>
        <th>Umur 1</th>
        <th>Umur 2</th>
        <th>Waktu</th>
        <th>NK 1</th>
        <th>NK 2</th>
    </tr>
    <?php
        $no=1;
        $lis2 = '';
        foreach ($model2 as $data2) {
            $jenis2 = ($data2['alat'] == 1 ? 'ALAT' : 'MANUAL');

            if($data2['lis']!=$lis2){
                $lis2=$data2['lis'];

                echo "<tr>
                    <td width='50px' align='center'>$no</td>
                    <td><a href=".Yii::app()->createUrl("kode/view", array('id'=>$data2['id']))." target='_blank'>$lis2</a></td>
                    <td>$data2[nama]</td>
                    <td>$jenis2</td>
                    <td>".Parameter::item("cParameter",$data['parameter'])."</td>                
                    <td>".Parameter::item("cSex",$data2['sex'])."</td>                
                    <td>$data2[umur1]</td>
                    <td>$data2[umur2]</td>
                    <td>".Parameter::item("cWaktu",$data2['waktu'])."</td>
                    <td>$data2[nk1]</td>
                    <td>$data2[nk2]</td>             
                </tr>";

                $no++;
            } else {
                echo "<tr>
                    <td></td>                
                    <td></td>                
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>".Parameter::item("cSex",$data2['sex'])."</td>                
                    <td>$data2[umur1]</td>
                    <td>$data2[umur2]</td>
                    <td>".Parameter::item("cWaktu",$data2['waktu'])."</td>
                    <td>$data2[nk1]</td>
                    <td>$data2[nk2]</td>             
                </tr>";

            }
        }
    ?>
</table>
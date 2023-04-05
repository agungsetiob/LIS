<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No. Lab</th>
            <th>Grup</th>
            <th>Kode</th>
            <th>Nama</th>
            <th></th>
        </tr>
    </thead>
    <?php
        $sql = "SELECT * FROM periksa_simrs WHERE no_lab = '$model->no_reg'";
        $model = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($model as $data) {
            echo "<tr>
                <td>$data[no_lab]</td>
                <td>$data[grup]</td>
                <td>$data[kode]</td>
                <td>$data[nama]</td>
            </tr>";
        }
    ?>
</table>
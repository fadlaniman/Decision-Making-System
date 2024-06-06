<div class="container-fluid">
    <h5>Data Nilai Awal</h5>
    <table id="example2" class="table table-bordered table-hover bg-white">
        <thead>
            <tr>
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Alternatif</th>
                <th colspan="<?= count($kriteria) ?>" class="text-center">Kriteria</th>
            </tr>
            <tr>
                <?php foreach ($kriteria as $k) : ?>
                    <th style="width: <?= 70 / count($kriteria) ?>%;"><?= $k[1] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            foreach ($alternatif as $a) {
                echo '<tr>';
                echo '<td>' . $index++ . '</td>';
                echo '<td>' . $a[1] . '</td>';
                foreach ($kriteria as $k) {
                    $found = false;
                    foreach ($data as $row) {
                        if ($row[2] == $k[0] && $row[4] == $a[0]) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        echo '<td></td>';
                    } else {
                        echo '<td>' . $row[1] . '</td>';
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Bobot</th>
                <?php foreach ($kriteria as $k) {
                    echo '<th>' . $k[3] / 10 . '</th>';
                } ?>
            </tr>
            <tr>
                <th colspan="2">Jenis</th>
                <?php foreach ($kriteria as $k) {
                    echo '<th>' . $k[2] . '</th>';
                } ?>
            </tr>
        </tfoot>
    </table>
</div>
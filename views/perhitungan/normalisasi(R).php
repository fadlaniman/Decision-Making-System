<div class="container py-3">
    <h5>Normalisasi Matriks ('R)</h5>
    <table id="example2" class="table table-bordered table-hover bg-white">
        <thead>
            <tr>
                <?php
                $index = 1;
                echo '<th></th>';
                foreach ($kriteria as $k) : ?>
                    <th><?= 'C' . $index++ ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            foreach ($alternatif as $a) {
                echo '<tr>';
                echo '<td>' . 'A' . $index++ . '</td>';
                foreach ($kriteria as $k) {
                    $value = 0;
                    $score = 0;
                    $found = false;
                    foreach ($data as $row) {
                        if ($row[2] == $k[0]) {
                            $value += $row[1] ** 2;
                        }
                        if ($row[2] == $k[0] && $row[4] == $a[0]) {
                            $score += $row[1];
                            $found = true;
                        }
                    }
                    if (!$found) {
                        echo '<td></td>';
                    } else {
                        echo '<td>' . $score / sqrt($value) . '</td>';
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

</div>
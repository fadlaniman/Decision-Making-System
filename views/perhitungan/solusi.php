<div class="container py-3">
    <h5>Solusi Ideal</h5>
    <table id="example2" class="table table-bordered table-hover bg-white">
        <tbody>
            <?php
            // Initialize arrays to store the ideal and negative-ideal solutions
            $idealSolution = [];
            $negativeIdealSolution = [];

            // Initialize arrays to store the normalized values for all alternatives
            $normalizedValues = [];

            // Step 1: Normalize the decision matrix
            foreach ($kriteria as $k) {
                $sum = 0;
                foreach ($data as $row) {
                    if ($row[2] == $k[0]) {
                        $sum += $row[1] ** 2;
                    }
                }
                if ($sum > 0) {
                    foreach ($alternatif as $a) {
                        foreach ($data as $row) {
                            if ($row[2] == $k[0] && $row[4] == $a[0]) {
                                $normalizedValues[$a[0]][$k[0]] = $row[1] / sqrt($sum);
                            }
                        }
                    }
                }
            }

            // Step 2: Multiply by the criteria weights
            $weightedMatrix = [];
            foreach ($alternatif as $a) {
                foreach ($kriteria as $k) {
                    if (isset($normalizedValues[$a[0]][$k[0]])) {
                        $weightedMatrix[$a[0]][$k[0]] = $normalizedValues[$a[0]][$k[0]] * ($k[3] / 10);
                    }
                }
            }

            // Step 3: Determine the ideal and negative-ideal solutions
            foreach ($kriteria as $k) {
                $column = array_column($weightedMatrix, $k[0]);
                if (!empty($column)) {
                    if ($k[2] == 'benefit') {
                        $idealSolution[$k[0]] = max($column);
                        $negativeIdealSolution[$k[0]] = min($column);
                    } else {
                        $idealSolution[$k[0]] = min($column);
                        $negativeIdealSolution[$k[0]] = max($column);
                    }
                }
            }

            // Step 4: Calculate the separation measures
            $separationFromIdeal = [];
            $separationFromNegativeIdeal = [];
            foreach ($alternatif as $a) {
                $sumIdeal = 0;
                $sumNegativeIdeal = 0;
                foreach ($kriteria as $k) {
                    if (isset($weightedMatrix[$a[0]][$k[0]])) {
                        $sumIdeal += ($weightedMatrix[$a[0]][$k[0]] - $idealSolution[$k[0]]) ** 2;
                        $sumNegativeIdeal += ($weightedMatrix[$a[0]][$k[0]] - $negativeIdealSolution[$k[0]]) ** 2;
                    }
                }
                if ($sumIdeal > 0) {
                    $separationFromIdeal[$a[0]] = sqrt($sumIdeal);
                }
                if ($sumNegativeIdeal > 0) {
                    $separationFromNegativeIdeal[$a[0]] = sqrt($sumNegativeIdeal);
                }
            }

            // Display the separation measures for each alternative
            foreach ($alternatif as $a) {
                echo '<tr>';
                echo '<td>' . 'D+' . '</td>';
                echo '<td>' . (isset($separationFromIdeal[$a[0]]) ? $separationFromIdeal[$a[0]] : '') . '</td>';
                echo '<td>' . 'D-' . '</td>';
                echo '<td>' . (isset($separationFromNegativeIdeal[$a[0]]) ? $separationFromNegativeIdeal[$a[0]] : '') . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
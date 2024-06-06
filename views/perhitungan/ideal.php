<div class="container py-3">
    <h5>Nilai Solusi Ideal</h5>
    <table id="example2" class="table table-bordered table-hover bg-white">
        <tbody>
            <?php
            // Initialize arrays to store the ideal and negative-ideal solutions
            $idealSolution = [];
            $negativeIdealSolution = [];

            // Initialize arrays to store the normalized values for all alternatives
            $normalizedValues = [];

            // Iterate over each alternative
            foreach ($alternatif as $a) {
                $normalizedValues[$a[0]] = [];
                foreach ($kriteria as $k) {
                    $value = 0;
                    $score = 0;
                    $bobot = $k[3] / 10;  // Assuming $k[3] contains the weight of the criterion

                    // Calculate the sum of squares for the normalization
                    foreach ($data as $row) {
                        if ($row[2] == $k[0]) {
                            $value += $row[1] ** 2;
                        }
                    }

                    // Calculate the normalized score for the current alternative and criterion
                    foreach ($data as $row) {
                        if ($row[2] == $k[0] && $row[4] == $a[0]) {
                            $score = $row[1];
                            $normalizedScore = $score / sqrt($value) * $bobot;
                            $normalizedValues[$a[0]][$k[0]] = $normalizedScore;

                            // Update ideal and negative-ideal solutions
                            if ($k[2] == 'cost') {
                                if (!isset($idealSolution[$k[0]]) || $normalizedScore < $idealSolution[$k[0]]) {
                                    $idealSolution[$k[0]] = $normalizedScore;
                                }
                                if (!isset($negativeIdealSolution[$k[0]]) || $normalizedScore > $negativeIdealSolution[$k[0]]) {
                                    $negativeIdealSolution[$k[0]] = $normalizedScore;
                                }
                            } else if ($k[2] == 'benefit') {
                                if (!isset($idealSolution[$k[0]]) || $normalizedScore > $idealSolution[$k[0]]) {
                                    $idealSolution[$k[0]] = $normalizedScore;
                                }
                                if (!isset($negativeIdealSolution[$k[0]]) || $normalizedScore < $negativeIdealSolution[$k[0]]) {
                                    $negativeIdealSolution[$k[0]] = $normalizedScore;
                                }
                            }
                        }
                    }
                }
            }

            // Display the ideal solution
            echo '<tr>';
            echo '<td>' . 'A+' . '</td>';
            foreach ($kriteria as $k) {
                echo '<td>' . (isset($idealSolution[$k[0]]) ? $idealSolution[$k[0]] : '') . '</td>';
            }
            echo '</tr>';

            // Display the negative-ideal solution
            echo '<tr>';
            echo '<td>' . 'A-' . '</td>';
            foreach ($kriteria as $k) {
                echo '<td>' . (isset($negativeIdealSolution[$k[0]]) ? $negativeIdealSolution[$k[0]] : '') . '</td>';
            }
            echo '</tr>';
            ?>
        </tbody>

    </table>
</div>
<?php

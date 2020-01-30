<div class="col-xl-4 mx-auto">
    <div class="col-xl-9 border rounded mx-auto p-2 text-center">
    <div><p class="sinfonie text-left">Made by Sinfonie</p></div>
    <!-- first -->
        <div class="col-xl-9 mx-auto input-group input-group-md rounded mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-white bg-dark" id="basic-addon2">Wynik: </span>
            </div>
            <div class="form-control alert-secondary text-right text-break"><?php echo $showNumberMemory . ' ' . $showOperatorMemory ?></div>
        </div>
    <!-- second -->
        <div class="col-xl-9 mx-auto input-group input-group-md rounded mb-3">
            <div class="form-control alert-secondary text-right text-break"><?php echo $showNumber ?></div>
        </div>
        <form action="index.php" method="POST">
<?php

$array = array(1, 2, 3, '+', 4, 5, 6, '-', 7, 8, 9, '*', '=', 0, '.', '/', '%', 'o', 'p', 'c');

for ($y = 0; $y < 20; $y = $y + 4) {
    echo '<div class="col-12 row justify-content-center m-0 p-0">';
    for ($x = $y; $x <= $y + 3; $x++) {
        if ($array[$x] === 'p') {
            $character = 'x<sup>2</sup>';
        } elseif ($array[$x] === 'o') {
            $character = '&#8730';
        } elseif ($array[$x] === '.') {
            $character = ',';
        } elseif ($array[$x] === 'c') {
            $character = 'C';
        } else {
            $character = $array[$x];
        }

        if (is_numeric($array[$x])) {
            $button = 'btn-dark';
        } else {
            $button = 'btn-outline-dark';
        }
        echo '<button type="submit" class="col-2 btn ' . $button . ' m-1" name="character" value="' . $array[$x] . '"><div class="p-2">' . $character . '</div></button>';
    }
    echo '</div>';
}

if ($showStatement) {
    echo "<div class=\"col-lg-9 border rounded mx-auto p-2 text-center text-danger\">$showStatement</div>";
}
?>
        </form>
    </div>
</div>

<?php

function followPath($matrix) {
    $currentPosition = getStartingPosition($matrix);
    $previousPosition = null;
    $currentChar = $matrix[$currentPosition[0]][$currentPosition[1]];

    $letters = "";
    $path = "";

    while ($currentChar !== 's') {
        $path .= $currentChar;                    
        $nextPosition = getNextPosition($matrix, $currentPosition, $previousPosition);
        if ($nextPosition === null) {
            break;
        }
        $nextChar = $matrix[$nextPosition[0]][$nextPosition[1]];

        if (ctype_upper($nextChar)) {
            $letters .= $nextChar;
        }
        $previousPosition = $currentPosition;
        $currentPosition = $nextPosition;
        $currentChar = $nextChar;
    }

    $path .= 's';
    echo "Path: " . $path . "<br>";
    echo "Letters: " . $letters;
}


function getNextPosition($matrix, $currentPosition, $previousPosition = null) {
    $y = $currentPosition[0];
    $x = $currentPosition[1];

    // Always move right from the starting position
    if ($previousPosition === null && $currentPosition === getStartingPosition($matrix)) {
        return [$y, $x + 1];
    }

    $directions = [
        [0, -1], // go left x
        [0, 1],  // go right x
        [1, 0],  // go down y
        [-1, 0]  // go Up y
    ];

    foreach ($directions as $direction) {
        $newY = $y + $direction[0];
        $newX = $x + $direction[1];

        if (isset($matrix[$newY][$newX]) &&
            $matrix[$newY][$newX] != ' ' &&
            [$newY, $newX] != $previousPosition) {
            return [$newY, $newX];
        }
    }

    return null;
}

function getStartingPosition($matrix) {
    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix[$i]); $j++) {
            if ($matrix[$i][$j] === '>') {
                return [$i, $j];
            }
        }
    }
}
$matrixExample = [
    [">", "-", "-", "-", "A", "-", "-", "-", "+"],
    [" ", " ", " ", " ", " ", " ", " ", " ", "|"],
    ["s", "-", "B", "-", "+", " ", " ", " ", "C"],
    [" ", " ", " ", " ", "|", " ", " ", " ", "|"],
    [" ", " ", " ", " ", "+", "-", "-", "-", "+"]
 ];

$matrixAssignment = [
    [">", "-", "-", "-", "A", "-", "@", "-", "+"],
    [" ", " ", " ", " ", " ", " ", " ", " ", "|"],
    ["+", "-", "U", "-", "+", " ", " ", " ", "C"],
    ["|", " ", " ", " ", "|", " ", " ", " ", "|"],
    ["s", " ", " ", " ", "C", "-", "-", "-", "+"]
 ];


?>
<h1>Pabau internship Challenge</h1>
<div style="display:flex">
    <div style="border:2px solid black; border-radius: 5px; width:33%; padding:20px; margin-right:30px">
        <h2>Matrix Example</h2>
        <p><?= followPath($matrixExample) ?></p>
    </div>

    <div style="border:2px solid black; border-radius: 5px; width:33%; padding:20px;">
        <h2>Matrix Assignement</h2>
        <p><?= followPath($matrixAssignment) ?></p>
    </div>
</div>
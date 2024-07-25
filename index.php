<?php
$matrix = [
   [">","-","-","-","A","-","@","-","+"],
   [" "," "," "," "," "," "," "," ","|"],
   ["+","-","U","-","+"," "," "," ","C"],
   ["|"," "," "," ","|"," "," "," ","|"],
   ["s"," "," "," ","C","-","-","-","+"]
];

function followPath($matrix) {
    //Im initially setting the current position to the start position
    $currentPosition = getStartingPosition($matrix); 

    //No previus position since we just started iterating
    $previousPosition = null;

    // first character is >
    $currentChar = $matrix[$currentPosition[0]][$currentPosition[1]];

    //initializing empty variables
    $letters = "";
    $path = "";

    while ($currentChar === 's'){
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
    };

    $path .= 's';
    echo "<h2>Path: " . $path . "</h2>";
    echo "<h2>Letters: " . $letters . "</h2>";
}

function getNextPosition($matrix, $currentPosition, $previousPosition = null) {
    $y = $currentPosition[0];
    $x = $currentPosition[1];

    //always move right from the starting position
    if ($previousPosition === null && $currentPosition === getStartingPosition($matrix)) {
        return [$y, $x + 1];
    }

    $directions = [
        [0, -1], // go left x
        [0, 1],  // go right x
        [1, 0],  // go down y
        [-1, 0]  // go up y
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

followPath($matrix);
?>

<?php

// follow a path of characters
// collect letters

// start at ">"
// Follow the path
// Collect letters
// Stop on s

// Input: A matrix representing the grid, it can be constant

// Output:
// - Path
// - Letters

// ● The only valid characters are all uppercase letters (A-Z)
// ● Turns can be letters or +

$matrix = [
    [">","-","-","-","A","-","@","-","+"],
    [" "," "," "," "," "," "," "," ","|"],
    ["+","-","U","-","+"," "," "," ","C"],
    ["|"," "," "," ","|"," "," "," ","|"],
    ["s"," "," "," ","C","-","-","-","+"]
];

function followPath($matrix) {
    $currentPosition = getStartingPosition($matrix);
    $previousPosition = "";
    $letters = "";
    $path = "";

    while ($currentChar !== 's') {
        $currentChar = $matrix[$currentPosition[0]][$currentPosition[1]];
        $path .= $currentChar;

        if (isUpperCaseLetter($currentChar)) {
            $letters .= $currentChar;
        }

        $nextPosition = getNextPosition($matrix, $currentPosition, $previousPosition);

        // Stop if no movement is possible or reached the end
        if ($nextPosition == $currentPosition) {
            break;
        }

        // Update previous and current positions
        $previousPosition = $currentPosition;
        $currentPosition = $nextPosition;
    }

    echo "Path: " . $path . "<br>";
    echo "Letters: " . $letters . "<br>";
}


function getNextPosition($matrix, $currentPosition, $previousPosition = "") {

    $x = $currentPosition[0];
    $y = $currentPosition[1];

    //always move right from the starting position
    if ($previousPosition === "" && [$x, $y] === getStartingPosition($matrix)) {
        return [$x, $y + 1];
    }

    $directions = [
        [0, -1], // go left
        [0, 1],  // go right
        [1, 0],  // go down
        [-1, 0]  // goup
    ];

    foreach ($directions as $direction) {
        $newX = $x + $direction[0];
        $newY = $y + $direction[1];

        if (($matrix[$newX][$newY] === 's')) {
            return false;
        }

        if (($matrix[$newX][$newY] != ' ') &&
            ([$newX, $newY] != $previousPosition)) {
            return [$newX, $newY];
        }
    }

}

// Helper functions
function getStartingPosition($matrix) {
    for ($i = 0; $i < count($matrix); $i++){
        for ($j = 0; $j < count($matrix[$i]); $j++){  
            if (isMatch($matrix[$i][$j], '>')){
                return [$i, $j];
            }
        }
    }
}

function isMatch($coordinates, $character) {
        return $coordinates === $character;
}

function isUpperCaseLetter($character) {
    return ctype_upper($char);
}

followPath($matrix);
?>

<!-- function followPath($matrix){
    $startingPosition = getStartingPosition($matrix);
    $currentPosition = $startingPosition;
    $previousPosition = "";
    $letters = "";
    $path = "";

    while ($currentPosition !== 's'){
        $nextPosition = getNextPosition($matrix,$currentPosition,$previousPosition);

        if (isUpperCaseLetter($nextPosition)) {
            $letters .= $matrix[]
        }

    }
} -->
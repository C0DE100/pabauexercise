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
    $currentChar = $matrix[$currentPosition[0]][$currentPosition[1]];
    $letters = "";
    $path = "";

    while ($currentChar !== 's') {
        $path .= $currentChar;
        $nextPosition = getNextPosition($matrix, $currentPosition,$previousPosition);
        $nextChar = $matrix[$nextPosition[0]][$nextPosition[1]];

        if (isUpperCaseLetter($nextChar)) {
            $letters .= $nextChar;
        }
        $previousPosition = $currentPosition;
        $currentPosition = $nextPosition;
        $currentChar = $nextChar;

    }
}

function getNextPosition($matrix, $currentPosition, $previousPosition = "") {

    $y = $currentPosition[0];
    $x = $currentPosition[1];

    //always move right from the starting position
    if ($previousPosition === "" && [$y, $x] === getStartingPosition($matrix)) {
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

        if (($matrix[$newY][$newX] != ' ') &&
            ([$newY, $newX] != $previousPosition)) {
            return [$newY, $newX];
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
    return ctype_upper($character);
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
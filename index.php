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

function followPath($matrix){
    $startingPosition = getStartingPosition($matrix);
    $currentPosition = $startingPosition;
    $previousPosition = "";
    $letters = "";
    $path = "";

    while ($currentPosition !== 's'){
        $nextPosition = getNextPosition($matrix,$currentPosition,$previousPosition);
        
    }
}

function getNextPosition($matrix, $currentPosition, $previousPosition = "") {

    $x = $currentPosition[0];
    $y = $currentPosition[1];

    //always move right from the starting position
    if([$x, $y] === getStartingPosition($matrix)){
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

echo "Current position given is: <br>";
print_r([0,2]);
echo "<br>";
echo "Next position is: <br>";
print_r(getNextPosition($matrix, [0,2],[0,1]));


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

?>
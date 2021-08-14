<?php

require'sudoku.php';

$sudoku = new sudoku();

echo $sudoku->generate();

echo $sudoku->mask[0][0];
for($i=1 ; $i<10 ; $i++)
{
if($sudoku->changePuzzle(0,0 , $i))
	echo "done";
}

echo $sudoku->generate();

if($sudoku->isEnd())
	echo "end";
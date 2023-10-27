<?php

function arrayGen($length=25):array{
	// echo $length > 9999 ? "Wayyy to many, geez..." : "";
	// $length > 9999 ? $length = 9999 : "" ;

	$authors = ['Möbbus', 'Janne', 'Hummus', 'Mayozaki'];
	$genres = ['Sci-fi', 'Horror', 'Fantasy', 'Moe', 'SoL', 'Adventure', 'Comedy', 'History', 'Mythology',	 'Music'];
	$colors = ['blue', 'red', 'green', 'yellow'];
	
	$books = [];

	for ($i=0; $i < $length; $i++){
		$books[$i]['id'] = $i;
		$books[$i]['author'] = $authors[rand(0,3)];
		$books[$i]['pages'] = rand(80,250);
		$books[$i]['genre'][0] = $genres[rand(0,9)];
		if (rand(0,1)){
			$books[$i]['genre'][1] = $genres[rand(0,9)];
			while ($books[$i]['genre'][1] == $books[$i]['genre'][0])
				$books[$i]['genre'][1] = $genres[rand(0,9)];
		}
		$books[$i]['color'] = $colors[rand(0,3)];
	}

	return $books;
}
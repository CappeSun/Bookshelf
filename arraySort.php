<?php

/*
function sortBy(array &$array, array $sort):array{
	$sorted = [];
	foreach ($sort as $category){
		$rev = false;		//Reversed
		$mltlev = false;	//Two levels deep (only used by sortGenre())
		foreach ($array as $book){
			switch ($category){
				case 'id':
					sortId($sorted, $book);
					break;
				case 'idR':
					sortId($sorted, $book);
					$rev = true;
					break;
				case 'author':
					sortAuthor($sorted, $book);
					break;
				case 'authorR':
					sortAuthor($sorted, $book);
					$rev = true;
					break;
				case 'genre':
					sortGenre($sorted, $book);
					$mltlev = true;
					break;
				case 'genreR':
					sortGenre($sorted, $book);
					$mltlev = true;
					$rev = true;
					break;
				case 'color':
					sortColor($sorted, $book);
					break;
				case 'colorR':
					sortColor($sorted, $book);
					$rev = true;
					break;
				default:
					echo "Oof! (herp did a derp :p)";
					break;
			}
		}

		// if ($rev){
		// 	krsort($sorted);
		// 	if ($mltlev)
		// 		foreach ($sorted as $array)
		// 			krsort($array);
		// }else{
		// 	ksort($sorted);
		// 	if ($mltlev)
		// 		foreach ($sorted as $array)
		// 			ksort($array);
		// }
	}

	return $sorted;
}

function sortId(&$sorted, $book){
	$sorted[$book['id']][] = $book['id'];
}

function sortAuthor(&$sorted, $book){
	$sorted[$book['author']][] = $book['id'];
}

function sortGenre(&$sorted, $book){
	if (isset($book['genre'][1]))
		$sorted[$book['genre'][0]][$book['genre'][1]][] = $book['id'];
	else
		$sorted[$book['genre'][0]]['-'][] = $book['id'];
}

function sortColor(&$sorted, $book){
	$sorted[$book['color']][] = $book['id'];
}
*/

### New Sort Test ###

function sortBy(array $array, array $sort=['id'], string $search=null):array{
	$sort = array_reverse($sort);
	$sorted = [];

	if ($search){
		foreach ($array as $book)
			if (str_contains(implode(' ', $book['genre']), $search) || str_contains($book['author'], $search))
				$sorted[] = $book;
	}else
		$sorted = $array;

	foreach ($sort as $category)
		uasort($sorted, $category);

	return $sorted;
}

function id($a, $b){
	return ($a['id'] <=> $b['id']);
}

function rid($a, $b){
	return ($b['id'] <=> $a['id']);
}

function author($a, $b){
	return ($a['author'] <=> $b['author']);
}

function rauthor($a, $b){
	return ($b['author'] <=> $a['author']);
}

function genre($a, $b){
	if ($a['genre'][0] != $b['genre'][0])
		return ($a['genre'][0] <=> $b['genre'][0]);
	if (!isset($a['genre'][1]) && isset($b['genre'][1]))
		return -1;
	if (!isset($b['genre'][1]))
		return 1;
	return ($a['genre'][1] <=> $b['genre'][1]);
}

function rgenre($a, $b){
	if ($b['genre'][0] != $a['genre'][0])
		return ($b['genre'][0] <=> $a['genre'][0]);
	if (!isset($b['genre'][1]) && isset($a['genre'][1]))
		return -1;
	if (!isset($a['genre'][1]))
		return 1;
	return ($b['genre'][1] <=> $a['genre'][1]);
}

function color($a, $b){
	return ($a['color'] <=> $b['color']);
}

function rcolor($a, $b){
	return ($b['color'] <=> $a['color']);
}

function pages($a, $b){
	return ($a['pages'] <=> $b['pages']);
}

function rpages($a, $b){
	return ($b['pages'] <=> $a['pages']);
}
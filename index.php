<?php

require 'arrayGen.php';
require 'arraySort.php';

session_start();

if (isset($_GET['arraySize'][0]))
	$bookshelf = arrayGen($_GET['arraySize']);
else if (isset($_GET['arraySize']) && $_GET['arraySize'] == '')
	$bookshelf = arrayGen();
else if (isset($_SESSION['bookshelf']))
	$bookshelf = $_SESSION['bookshelf'];
else
	$bookshelf = arrayGen();

$_SESSION['bookshelf'] = $bookshelf;

$categories = ['id', 'rid', 'author', 'rauthor', 'genre', 'rgenre', 'color', 'rcolor', 'pages', 'rpages'];

$catSort = [];
$search = null;

foreach ($_GET as $cat)
	if (in_array($cat, $categories))
		$catSort[] = $cat;

if (isset($_GET['search']))
	$search = $_GET['search'];

$sorted = sortBy($bookshelf, $catSort, $search);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sorting Demo</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="https://sputnik.zone/-stuff/-fonts/fonts.css">
</head>
<body>
	<h1 class="pageTitle">Sorting Demo</h1>
	<h3 class="pageSub">This my entry to the second of the projects for Problem Week 1</h3>
	<div class="input">
		<form action="index.php" class="genCont">
			<label for="arraySize">Generate new bookshelf with</label>
			<input type="text" name="arraySize" id="arraySize" placeholder="25" class="arraySize">
			<label for="arraySize">books</label>
		 	<input type="submit" value="Generate" class="btn">
		</form>
		<div class="sortCont">
			<p class="sortTitle">Sort and search current bookshelf</p>
			<form action="index.php">
				<?php for ($i=1; $i<=4; $i++){ ?>
			 	<select name="cat<?= $i; ?>" id="cat<?= $i; ?>" class="cat">
			 		<option value=""><?= $i == 1 ? 'Sort by...' : 'Then by...'; ?></option>
			 		<option value="id">Id</option>
			 		<option value="rid">Rev. Id</option>
			 		<option value="author">Author</option>
			 		<option value="rauthor">Rev. Author</option>
			 		<option value="color">Color</option>
			 		<option value="rcolor">Rev. Color</option>
			 		<option value="pages">Pages</option>
			 		<option value="rpages">Rev. Pages</option>
			 	</select>
			 	<?php } ?>
			 	<input type="text" name="search" id="search" placeholder="Search" class="search">
			 	<input type="submit" value="Submit" class="btn">
			</form>
		</div>
	</div>
	<div class="bookshelf">
		<?php foreach ($sorted as $book){ ?>
			<div class="book <?= $book['color']; ?>" style="width:<?= $book['pages']/3; ?>px;">
				<p><?= $book['author']; ?></p>
				<div>
					<?php foreach ($book['genre'] as $value){ ?>
						<span><?= $value; ?></span>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</body>
</html>

<?php

// foreach ($books as $value){
// 	var_dump($value);
// 	echo "<br>";
// }

// echo "<br>";

// foreach ($sorted as $value){
// 	var_dump($value);
// 	echo "<br>";
// }
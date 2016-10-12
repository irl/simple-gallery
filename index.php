<!DOCTYPE html> 
<html>
<head>
<meta name=viewport content="width=device-width, initial-scale=1">
<title>Photos</title>
<?php
$images_find = array();
$count = 0;
foreach (glob("photos/*.jpg") as $filename) {
	$images_find[] = $filename;
	$count++;
}
$index = $count;
if (isset($_GET['index'])){
	if ($_GET['index'] > $count){
	} else { 
		$index = $_GET['index'];
	}
}else{
	$index = $count;
	$check = TRUE;
}
?>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div id="wrapper">
	<div id="content">
<div id="header">
<div class="headerleft">
	<span class="instamike">Simple Gallery</span>
	<span class="subtitle">Catchy Subtitles 'r us</span><br />
</div>
<div class="headerright">
<?php

if ($index > 20){
$next = $index - 10;
}else{
$next = 10;
}
if ($index < $count){
	$prev = $index + 10;
}else if($index >= $count){
	$prev = $count;
}
$menu = $index;
if ($menu < $count){
echo "<span class='pages'><a href='index.php?index=" . $prev . "'>Prev</a></span>";
echo "<span class='pages'><a href='index.php?index=" . $count . "'>Home</a></span>";
} else{
echo "<span class='pagesnot'>Prev</span>";
echo "<span class='pagesnot'>Home</span>";	
}
if ($menu > 10){
echo "<span class='pages'><a href='index.php?index=" . $next . "'>Next</a></span>";
}else{
echo "<span class='pagesnot'>Next</span>";
}
?>
</div>
<div class="clearshit"></div>
</div>
<?php
if (file_exists("nav.txt") == 1){
echo '<div id="nav">';
include 'nav.txt';
echo '</div>';
}
?>
</div>
<?php
$total = $index - 10; #must bring down total so index can drop to the same number as total, counting down
if ($index > 0){
while ($index > $total){
		if (file_exists("photos/" . $index . ".jpg") == "True") {
		$exif_data = exif_read_data("photos/" . $index . ".jpg");
		$edate = date("Y-m-d", strtotime($exif_data['DateTimeOriginal']));
		echo "<div class='images'><img src='photos/" . $index . ".jpg' alt='" . $index ."'> <h2><span>" . $edate . ' <br /> <a href="photos/' . $index . '.jpg"> #' . $index ."</a> </span></h2></div>";
	$index--;
}
}
?>
<div class="pagnation">
<span class="subtitle">All images copyright Firstname Lastname, 2016. Gallery by <a href="https://github.com/yakamok/simple-gallery">yakamo</a></span>
<?php
if ($menu < $count){
echo "<span class='pages'><a href='index.php?index=" . $prev . "'>Prev</a></span>";
echo "<span class='pages'><a href='index.php?index=" . $count . "'>Home</a></span>";
} else{
echo "<span class='pagesnot'>Prev</span>";
echo "<span class='pagesnot'>Home</span>";	
}
if ($menu > 10){
echo "<span class='pages'><a href='index.php?index=" . $next . "'>Next</a></span>";
}else{
echo "<span class='pagesnot'>Next</span>";
}
?>
</div>
	</div>
</div>
</body>
</html>

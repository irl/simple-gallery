<title>Photos</title>
<?php
$images_find = array();
foreach (glob("photos/*.jpg") as $filename) {
	$images_find[] = $filename;
	$count++;
}
$index = $count;
$check = $_GET['index'];
if (isset($check)){
        if ($_GET['index'] > $count){
        	$index = $count;
        } else {
		$index = $_GET['index'];
        }
}else{
        $index = $count;
}
?>
<link rel="stylesheet" type="text/css" href="style.css"/>
<div id="header">
	<span class="instamike">photo-gallery-name</span>
	<span class="subtitle">my random photos</span>
</div>
<div id="wrapper">
	<div id="content">
<div class="pagnation">
<?php

if ($index > 20){
$next = $index - 10;
}else{
$next = 10;
}
if ($index < $count){
	$prev = $index + 10;
}else if($index == $count){
	$prev = $count;
}
$menu = $index;
if ($menu < $count){
echo "<span class='pages'><a href='index.php?index=" . $prev . "'>prev</a></span>";
echo "<span class='pages'><a href='index.php?index=" . $count . "'>home</a></span>";
} else{
echo "<span class='pagesnot'>prev</span>";
echo "<span class='pagesnot'>home</span>";	
}
if ($menu > 10){
echo "<span class='pages'><a href='index.php?index=" . $next . "'>next</a></span>";
}else{
echo "<span class='pagesnot'>next</span>";
}
?>
</div>
<?php
$total = $index - 10; #must bring down total so index can drop to the same number as total, counting down

if ($index > 0){
while ($index > $total){
	if (isset($images_find[$index])){

		if (file_exists("photos/" . $index . ".jpg") == "True") {
		$exif_data = exif_read_data("photos/" . $index . ".jpg");
		$edate = $exif_data['DateTime'];
		echo "<div class='images'><img src='photos/" . $index . ".jpg'> " . $edate . " - image-no - " . $index . "</div>";
		}
	}
	$index--;
}
}
?>
<div class="pagnation">
<?php
if ($menu < $count){
echo "<span class='pages'><a href='index.php?index=" . $prev . "'>prev</a></span>";
echo "<span class='pages'><a href='index.php?index=" . $count . "'>home</a></span>";
} else{
echo "<span class='pagesnot'>prev</span>";
echo "<span class='pagesnot'>home</span>";	
}
if ($menu > 10){
echo "<span class='pages'><a href='index.php?index=" . $next . "'>next</a></span>";
}else{
echo "<span class='pagesnot'>next</span>";
}
?>
</div>
	</div>
</div>

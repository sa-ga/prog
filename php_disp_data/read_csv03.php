<?php

setlocale(LC_ALL, 'ja_JP.SJIS');
$fp = fopen('csv/test.csv', 'r');
$array_str = array();

while (($data = fgetcsv($fp)) !== FALSE) {
	// echo '<p>';
    // echo ' No.',$data[0];
    // // $data[1] = mb_convert_encoding($data[1],"utf-8","sjis");
	// echo ' 商品名：',$data[1];
	// echo ' 単価：',$data[2];	
	// echo '</p>';
	array_push($array_str,$data[1]);
}
fclose($fp);

$fruits_count = array_count_values($array_str);



// echo var_dump($array_str);

?>


<html>
	<head>
		<meta charset="utf-8">
		<title>かずかぞえ</title>
	</head>
	<body>

<?php
foreach($fruits_count as $key => $value){
	// echo 'key : '.$key;
	// echo '<br>';
	// echo ' value : '.$value;
	// echo '<br>';


	$img_src = "";
	for($cnt = 0;$cnt<$value;$cnt++){

		if($key=='りんご'){
			$img_src = 'img/ringo.png';
		}elseif($key=='みかん'){
			$img_src = 'img/mikan.png';
		}else{
			$img_src = 'img/ichigo.png';
		}
?>
	<img src="<?php echo $img_src ?>">
<?php
	}
?>
	<br>
<?php
}
?>

  	

	<ul>
	<li><a href="input.php">戻る</a></li>
	</ul>
	</body>
</html>
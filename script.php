<?php
$url = "https://ronreiter-meme-generator.p.mashape.com/meme?bottom=Bottom+text&font=Impact&font_size=50&meme=Condescending+Wonka&top=Top+text";

$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"X-Mashape-Key: GMiLIjGQGQmshGxR898bAzjR1opxp1ZV41Tjsn4CTcQ552SOIl"
  )
);

$context = stream_context_create($options);
$file = file_get_contents($url, false, $context);

print_r($file);
?>
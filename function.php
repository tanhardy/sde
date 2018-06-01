<?php
function getMeme($message_in){

    
// get meme
$meme_url = "https://ronreiter-meme-generator.p.mashape.com/images";
$meme_op = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"X-Mashape-Key: 3AXm18xK3DmshYflu1c7Icp5tMfnp1LoMu3jsnmgcMGN9AbvN5"
  )
);

$context_meme = stream_context_create($meme_op);
$meme = file_get_contents($meme_url, false, $context_meme);
$meme_res = json_decode($meme, true);
$random_meme = array_rand($meme_res);
$meme_res = $meme_res[$random_meme];

$top_text = $message_in;

if(strlen($top_text) >= 16){
      $bottom_text = substr($top_text,16,strlen($top_text));
}



// get image
$url = "https://ronreiter-meme-generator.p.mashape.com/meme?bottom=".urlencode($bottom_text)."&font=Impact&font_size=50&meme=".urlencode($meme_res)."&top=".urlencode($top_text);


$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"X-Mashape-Key: GMiLIjGQGQmshGxR898bAzjR1opxp1ZV41Tjsn4CTcQ552SOIl"
  )
);

$context = stream_context_create($options);
$file = file_get_contents($url, false, $context);

$url_img = "https://api.imgur.com/3/image";

$data = array('image' => base64_encode($file), 'type' => 'base64');

$options_img = array(
  'http'=>array(
    'method'=>"POST",
    'header'=>"Authorization: Client-ID 9df67189cdfab87\r\n"."Content-type: application/x-www-form-urlencoded\r\n",
    'content' => http_build_query($data)
  )
);


$context_img = stream_context_create($options_img);
$file_img = file_get_contents($url_img, false, $context_img);
$file_img = json_decode($file_img, true);

$result = $file_img['data']['link'];

return $result;

}
?>
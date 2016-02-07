<?php

if(count($_GET) < 1){
  exit();
}

function encodeURI($s) {
  return urlencode($s);
}

$file = encodeURI($_GET['q']);

$url = "http://".$_SERVER['HTTP_HOST'];
$p = parse_url($url);
$port = '';
if($p['port']){
  $port = ":${p['port']}";
}else{
  $port = '';
}

$img_link = "${p['scheme']}://${p['host']}${port}/private/lib/server/php/files/${file}";

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex,nofollow">

  <title>Photo</title>

  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <style>
  body {
    padding: 10px;
  }
  </style>
</head>
<body>
  <h2>写真</h2>
  <p>免責事項: <strong style="color:red;">このリンクに直リンクしないでください。適宜削除します。</strong></p>
  <img src="<?php echo $img_link; ?>"/>
</body>
</html>

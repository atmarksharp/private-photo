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
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

  <title>Photo</title>

  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <style>
  body {
    padding: 10px;
  }

  #photo {
    max-width: 100%;
  }
  </style>
</head>
<body>
  <h2>写真</h2>
  <p>注意事項: <strong style="color:red;">このリンクに直リンクしないでください。適宜削除します。</strong></p>
  <img id="photo" src="<?php echo $img_link; ?>"/>
</body>
</html>

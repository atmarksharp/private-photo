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

$img_link = "${p['scheme']}://${p['host']}${port}/private/s/?q=${file}";

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex,nofollow">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <title>認証</title>

  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
  <style>
  body {
    padding: 10px;
  }

  .label {
    display: inline-block;
    width: 110px;
  }
  </style>
  <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="js/md5.js" charset="utf-8"></script>
</head>
<body>
  <div id="contents">
    <h2>認証</h2>
    <p><span class="label">ユーザ名: </span><input id="name" type="text" value=""></p>
    <p><span class="label">パスワード: </span><input id="pass" type="password" value=""></p>
    <p><button type="button" id="login">ログイン</button></p>
  </div>

  <script type="text/javascript">
    function md5(s){
      var ret = CybozuLabs.MD5.calc(s, CybozuLabs.MD5.BY_UTF8);
      return ret;
    }

    function get_cookie( name ){
      var result = null;
      var cookieName = name + '=';
      var allcookies = document.cookie;
      var position = allcookies.indexOf( cookieName );
      if( position != -1 ){
          var startIndex = position + cookieName.length;
          var endIndex = allcookies.indexOf( ';', startIndex );
          if( endIndex == -1 ){
              endIndex = allcookies.length;}
          result = decodeURIComponent(
              allcookies.substring( startIndex, endIndex ) );
      }
      return result;
    }

    if(get_cookie('thflsk') == '02b072947ca6'){
      $('#contents').html('');
      location.href = "<?php echo $img_link; ?>";
    }

    $("#login").click(function(){
      <?php /* NOTE private_user: RZZpUW35Fh */ ?>

      var name = $('#name').val();
      var pass = $('#pass').val();
      var key = ""+name+"|"+pass;
      var md5_key = md5(key);

      console.log(md5_key);

      if(md5_key == '8a3ba92feb6d02b072947ca67b9d71f9'){
        document.cookie = 'thflsk=02b072947ca6; max-age=3600';
        location.href = "<?php echo $img_link; ?>";
      }else{
        alert('ユーザ名またはパスワードが誤っています。')
        $('#name').val('');
        $('#pass').val('');
      }



    });
  </script>
</body>
</html>

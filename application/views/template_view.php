<!DOCTYPE html>
<html>
<head>
  <title><?=$param['title'];?></title>
  <link rel="stylesheet" type="text/css" href="/css/common.css?<?=rand(1,1111111);?>">
  <script type="text/javascript" src="/js/common.js?<?=rand(1,1111111);?>"></script>

    <?php
    if(!empty($param['css']) || is_array($param['css'])) {
      foreach ($param['css'] as $v) {
        echo '<link rel="stylesheet" type="text/css" href="/css/'.$v.'.css?'.rand(1,1111111).'">';
      }
    }
    if(!empty($param['js']) || is_array($param['js'])) {
      foreach ($param['js'] as $v) {
        echo '<script type="text/javascript" src="/js/'.$v.'.js?'.rand(1,1111111).'"></script>';
      }
    } 
  ?>
</head>
<body>

<div id="wrap1">

<div class="head">
  <a class="head_link" href="/">Юрий Гагарин</a>
  <div class="float_r">
    <a class="head_link" href="/quotes">цитаты</a>
    <a class="head_link" href="/photos">фото</a>
    <a class="head_link" href="/questbook">гостевая книга</a>
  </div>
</div>

<div class="content">
  <?php
    include SITE_ROOT.'application/views/'.$content_view;
  ?>
  <div class="clear"></div>
</div>

<div class="footer">
  <a class="footer_link" href="/about">О сайте</a>
  <a class="footer_link" href="/rules">Правила</a>
  <div style="padding-top:6px;">Site © <?=date('Y');?></div>
</div>

</div>

</body>
</html>
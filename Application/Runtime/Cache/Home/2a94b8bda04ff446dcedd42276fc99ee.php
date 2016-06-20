<?php if (!defined('THINK_PATH')) exit();?><html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Index</title>
    <script src="/thinkphp/Public/js/jquery-3.0.0.min.js"></script>
  </head>
  <body>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        var openid = <?php echo ($openid); ?>;
        $('#sign').click(function(){
          $.post('<?php echo U('Index/AjaxQiandao');?>', {openid:openid},function(data){
            if( data.status == 'y' ){
              window.location.reload();
            }else{
              alert(data.msg);
            }
          },'json')
        })
      })
    </script>
  </body>
</html>
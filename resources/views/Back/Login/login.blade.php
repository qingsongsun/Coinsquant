<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>量化币后台</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  {{--<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">--}}
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
{{--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
<!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="//cdn.bootcss.com/iCheck/1.0.2/skins/flat/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>量化币</b>后台管理
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form method="post" id="form_data">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="用户名" name="admin_name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="密码" name="admin_pwd">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4" style="margin-left: 150px">
          <button type="button" class="btn btn-primary btn-block btn-flat" onclick="login()">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 1.9.1 -->
<script type="text/javascript" src="{{ URL::asset('lib/jquery/1.9.1/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="//cdn.bootcss.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="//cdn.bootcss.com/iCheck/1.0.2/icheck.js"></script>
<script src="//cdn.bootcss.com/layer/3.0.3/layer.js"></script>
<script>
    function login() {
        $.post("{{ url('/back/login/check') }}",$('#form_data').serialize(),function(code){
            if(code.code == 200){
                layer.msg(code.msg,{icon:1,time:2000});
                setTimeout(function(){
                    location.href = "/back/";
                },1000);
            }else{
                layer.msg(code.msg,{icon:2});
            }
        })
    }
</script>
</body>
</html>

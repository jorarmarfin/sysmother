<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href={{asset("bootstrap/css/bootstrap.min.css")}}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("dist/css/AdminLTE.min.css")}}>

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>SYS</b>TEM
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Iniciar la sesión</p>
        @include('alerts.errors')
          @if(Session::has('alert'))
            <p class='alert alert-success'>{{Session::get('alert')}}</p>
          @endif
          {!!Form::open(['route'=>'login','method'=>'POST'])!!}
          <div class="form-group has-feedback">
            {!!Form::email('email',old('email'), ['class'=>'form-control','placeholder'=>'Email'])!!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Password'])!!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
              {!!Form::submit('Entrar',['class'=>'btn btn-primary btn-block btn-flat'])!!}
            </div><!-- /.col -->
          </div>
        {!!Form::close()!!}
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src={{asset("plugins/jQuery/jQuery-2.1.4.min.js")}}></script>
    <!-- Bootstrap 3.3.5 -->
    <script src={{asset("bootstrap/js/bootstrap.min.js")}}></script>

  </body>
</html>
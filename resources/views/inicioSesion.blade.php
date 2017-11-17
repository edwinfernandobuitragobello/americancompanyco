
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="{{ url('/admin/iniciandoSesion') }}" method="POST" role="form">
        <h2 class="form-signin-heading">Por favor, iniciar sesion</h2>
        <label for="inputEmail" class="sr-only">Correo electrónico</label>
        <input name="email_session" type="text" id="inputEmail" class="form-control" placeholder="Correo electrónico" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="contrasena_session" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordarme
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
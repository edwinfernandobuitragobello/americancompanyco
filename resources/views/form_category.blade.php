@include('header')
<div>
	<form action="{{ url('/email_contact') }}" method="POST" role="form">
      <div class="form-group">
        <input type="text" id="InputName" name="InputName" placeholder="Nombre">
      </div>

      <div class="form-group">
        <input type="text" id="InputEmail" name="InputEmail" placeholder="Correo">
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
        <div class="col-md-12">
          <center><div class="g-recaptcha" data-sitekey="6LdN5BoUAAAAAGbGcZGmTSlbR2HShhKKy2Zt_Uur"></div></center><br>
        </div>
        <div class="col-md-12">
          <center>
            <button id="enviar" type="submit" class="btn btn-primary" style="">Enviar mensaje</button>
            <button id="enviando" type="submit" class="btn btn-success">&nbsp;&nbsp;Enviando...&nbsp;&nbsp;</button>
          </center>
        </div>
      </div>
    </form>
</div>
@include('footer')
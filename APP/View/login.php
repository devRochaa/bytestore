<?php
ob_start();
session_start();
error_reporting(0);


$error = $_GET["error"];

?>

<link rel="stylesheet" href="../Assets/css/main.css">
<link rel="stylesheet" href="../Assets/css/admin.css">
<script src="../Assets/js/create.js"></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script src="../Assets/js/login.js"></script>



<body>
  <div class="container">
    <div data-aos="fade-in" data-aos-duration="500" class="containerlogin">
      <div class="titulo bordinha">
        <div class="titulo center">
          <h1 style="font-size: 23px !important;">Login</h1><br>
        </div>
        <?php
        if ($error == "true") {
          echo ('<div class="error center"><br><h5 style="color: red; font-size: 16px;">E-mail ou senha incorretos!</h5></div>');
        }

        ?>
        <div class="area1">
          <form action="/verify" method="post">
            <div class="inpt1"><input id="inputemail" required
                style="background-color: #FFFFFF !important; color: #000000 !important;" class="form-control"
                name="txt_email" placeholder="E-mail"><br>
              <input id="inputpass" name="txt_pass" required
                style="background-color: #FFFFFF !important;color: #000000 !important;" class="form-control"
                type="password" placeholder="Senha">
              <h4 style="font-size: 10px; color: grey; margin-top: 5px;">Ao realizar o login, você está concordando com
                os <a href="/tos"> termos de uso</a>.</h4>
              <div class="center">
                <div class="btnslg">
                  <a href="/register"><input class="btn btn-dark bt1"style="text-align: center; line-height: 10px; height: 35px;" value="Criar conta"type="button"></a>
                  <input class="btn btn-dark bt1" style="margin-right: 10px; text-align: center; line-height: 10px;"
                    type="submit" value="Logar-se">
                </div>
              </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
<script>AOS.init();</script>




</html>
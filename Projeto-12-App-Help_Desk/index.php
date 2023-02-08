
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  </head>
  <body>

    <?php
      //Adiciona navbar 
      require_once('assets/navbar.php');

      //Destrói a sessão
      session_start();
      session_destroy();
     ?>

    <div class="container mt-5">    
      <div class="row">
        <div class="col"></div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">

              <form action="valida_login.php" method="post">
                <input name="email" type="email" class="form-control mb-2"  placeholder="E-mail">
                <input name="password" type="password" class="form-control mb-2" placeholder="Senha">

                <?php if(isset($_GET['login']) && $_GET['login'] == 'error'){ ?>
                  <div class="text-danger">
                    Usuário ou senha inválido(s)
                  </div>
                <?php } ?>

                <?php if(isset($_GET['login']) && $_GET['login'] == 'error2'){ ?>
                  <div class="text-danger">
                    Faça login antes de acessar a página
                  </div>
                <?php } ?>

                <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>


    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  </body>
</html>
<?php 
  require_once('assets/validate_access.php');
?>
<?php
  // Variáveis
  $calls = array();

  // Abrir arquivo
  $file = fopen('db/data.hd', 'r');

  // Percorre as linhas
  while (!feof($file)) {

    $register = fgets($file);
    $calls[] = $register;

  }
  // Fecha o arquivo aberto
  fclose($file);
?>



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
      
     ?>

    <div class="container mt-5">    
      <div class="row">
        <div class="col"></div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            <div class="card-body">

              <?php foreach ($calls as $call) {
                $call_info = explode(';', $call);

                if ($_SESSION['profile_type'] == 1) {
                  if ($_SESSION['id'] != $call_info[0]) {
                    continue;
                  }
                }

                if (count($call_info) < 3) {
                  continue;
                }


              ?>
                <div class="card mb-3 bg-light">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $call_info[1]; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $call_info[2]; ?></h6>
                    <p class="card-text"><?php echo $call_info[3]; ?></p>
                  </div>
                </div>
              <?php } ?>  
              



              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php" class="btn btn-lg btn-warning btn-block">
                    Votar
                  </a>
                </div>
              </div>

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
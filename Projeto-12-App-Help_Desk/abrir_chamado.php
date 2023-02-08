<?php 
  require_once('assets/validate_access.php');
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
              Abertura de chamado
            </div>

            <div class="card-body">
                    
              <form method="post" action="assets/register.php">
                <div class="mb-3">
                  <label>Título</label>
                  <input name="title" type="text" class="form-control" placeholder="Título">
                </div>
                  
                <div class="mb-3">
                  <label>Categoria</label>
                  <select name="category" class="form-control">
                    <option>Criação Usuário</option>
                    <option>Impressora</option>
                    <option>Hardware</option>
                    <option>Software</option>
                    <option>Rede</option>
                  </select>
                </div>
                  
                <div class="mb-3">
                  <label>Descrição</label>
                  <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="container">
                  <div class="row mt-5">
                    <div class="col-6">
                      <a href="home.php" class="btn btn-lg btn-warning btn-block">
                        Voltar
                      </a>
                    </div>

                    <div class="col-6">
                      <button class="btn btn-lg btn-info btn-block" type="submit">Abrir</button>
                    </div>
                  </div>
                </form>

              </div>

              <div class="col">
                  
                
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
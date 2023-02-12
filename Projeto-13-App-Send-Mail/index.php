<html>
  <head>
    <meta charset="utf-8">
    <title>App Mail Send</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
      <div class="text-center">
        <img src="img/logo.png" alt="" width="72" height="72" class="d-block mx-auto mb-2">
        <h2>Send Mail</h2>
        <p class="lead">Seu app de envio de e-mails particular!</p>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card-body font-weight-bold">
            <form action="form_processor.php" method="post">
              <div class="form-group mb-2">
                <label for="para">Para</label>
                <input name="to" type="email" class="form-control" id="para" placeholder="complete@email.com" required>
              </div>

              <div class="form-group mb-2">
                <label for="assunto">Assunto</label>
                <input name="subject" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail" required>
              </div>

              <div class="form-group mb-2">
                <label for="mensagem">Mensagem</label>
                <textarea name="message" class="form-control" id="mensagem" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>



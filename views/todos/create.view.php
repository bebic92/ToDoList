<?php require 'views/partials/header.view.php' ?>
<main role="main" class="container">

  <div class="row">

    <div class="col-sm-8 blog-main">
      <div class="blog-post">
        <h2 class="blog-post-title">Ovdje kreirate vašu listu</h2>
        <hr>
        <form method="POST" action="/Drugi_dio_b/todos/kreiraj">
          <div class="form-group">
            <label for="exampleInputEmail1">Naziv liste</label>
            <input type="text" class="form-control" id="nazivListe" name="nazivListe" aria-describedby="nazivListe" placeholder="Unesite naziv liste">
          </div>
          <button type="submit" class="btn btn-primary">Kreiraj</button>
        </form>

      </div>
      <?php require 'views/errors/errors.view.php' ?> 
    </div>

  </div>
</main>
<?php require 'views/partials/footer.view.php' ?>
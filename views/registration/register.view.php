    <?php require 'views/partials/header.view.php' ?>
    <div class="container">
      <?php require 'views/alerts/success.view.php' ?>  
      <form class="form-signin" method="POST" action="/Drugi_dio_b/registracija">
        <h2 class="form-signin-heading">Registraj se</h2>
        
        <label for="Ime" class="sr-only">Ime</label>
        <input type="text" id="ime" class="form-control" placeholder="Ime" name="ime" autofocus>
        
        <label for="Prezime" class="sr-only">Prezime</label>
        <input type="text" id="prezime" class="form-control" placeholder="Prezime" name="prezime" autofocus>
        
        <label for="Email adresu" class="sr-only">Email adresa</label>
        <input type="text" id="email" class="form-control" placeholder="Email adresa" name="email" autofocus>
        
        <label for="inputPassword" class="sr-only">Lozinka</label>
        <input type="password" id="lozinka" class="form-control" placeholder="Lozinka" name="lozinka">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Registriraj se</button>
      </form>
      <?php require 'views/errors/errors.view.php' ?> 
    </div> 
    <?php require 'views/partials/footer.view.php' ?>
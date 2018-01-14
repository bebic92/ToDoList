<?php require 'views/partials/header.view.php' ?>
 <div class="container">

      <form class="form-signin" method="POST" action="/Drugi_dio_b/registracija">
        <h2 class="form-signin-heading">Registraj se</h2>
       
        <label for="userName" class="sr-only">Ime</label>
        <input type="firstName" id="firstName" class="form-control" placeholder="Ime" name="firstName" required autofocus>
       
        <label for="userLastName" class="sr-only">Prezime</label>
        <input type="lastName" id="lastName" class="form-control" placeholder="Prezime" name="lastName" required autofocus>
       
        <label for="inputEmail" class="sr-only">Email adresa</label>
        <input type="text" id="email" class="form-control" placeholder="Email adresa" name="email" autofocus>
       
        <label for="inputPassword" class="sr-only">Lozinka</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Lozinka" name="password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Registriraj se</button>
      </form>

    </div> <!-- /container -->
    <?php if(isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <?php if(!empty($error)) :?>
        <li><?= $error ?></li>
    <?php endif; ?>
    <?php endforeach; ?>   
    <?php endif; ?>
<?php require 'views/partials/footer.view.php' ?>
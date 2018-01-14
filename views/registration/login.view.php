<?php require 'views/partials/header.view.php' ?>
 <div class="container">
        <?php require 'views/alerts/success.view.php' ?>
      <form class="form-signin" method="POST" action="/Drugi_dio_b/login">
        <h2 class="form-signin-heading">Prijavite se</h2>

        <label for="Email adresu" class="sr-only">Email adresa</label>
        <input type="text" id="email" class="form-control" placeholder="Email adresa" name="email" autofocus>
       
        <label for="inputPassword" class="sr-only">Lozinka</label>
        <input type="password" id="lozinka" class="form-control" placeholder="Lozinka" name="lozinka">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Prijava</button>
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
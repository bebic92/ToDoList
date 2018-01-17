    <header>
      <div class="blog-masthead">
        <div class="container">
          <nav class="nav">
            <a class="nav-link active" href="/Drugi_dio_b">Home</a>
            <?php if (!isset($_SESSION['user_id'])) : ?>
              <a class="nav-link ml-md-auto" href="/Drugi_dio_b/login/">Prijava</a>
              <a class="nav-link" href="/Drugi_dio_b/registracija/">Registracija</a>
            <?php endif ;?>
            <?php if (isset($_SESSION['user_id'])) : ?>
              <a class="nav-link" href="/Drugi_dio_b/todos/kreiraj/">Dodaj novu listu</a>
              <a class="nav-link" href="/Drugi_dio_b/todos/">Moje liste</a>
              <a class="nav-link ml-md-auto" href="#">Dobrodosli <?=$_SESSION['ime'] ?> !!!</a>
              <a class="nav-link" href="/Drugi_dio_b/odjava/">Odjava</a>
            <?php endif ; ?>
          </nav>
        </div>
      </div>
    </header>
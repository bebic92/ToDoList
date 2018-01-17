<?php require 'views/partials/header.view.php' ?>
<main role="main" class="container">

  <div class="row"> 
    <div class="col-sm-8 blog-main"> 
      <a href="/Drugi_dio_b/todos/kreiraj" class="ml-md-auto"><input type="submit" value="Dodaj novu listu +" class="btn btn-primary"/></a>
      <hr>   
      <?php if(!empty($todos)) :?>
        <form action="/Drugi_dio_b/todos/?" method="GET" align="right">
          <div class="form-group">
            <select name="sort" class="form-control" onchange="this.form.submit()">
              <option value="">Sortirajte</option>
              <option value="naziv_asc">Nazivu A-Z </option>
              <option value="naziv_desc">Nazivu Z-A </option>
              <option value="vrijeme_desc">Najnoviji</option>
              <option value="vrijeme_asc">Najstariji</option>
            </select>
          </div>

        </form>
      <?php endif; ?>
      <?php if(isset($_SESSION['todos']) && (!empty($todos))){ $todos = $_SESSION['todos'];} ?> 
      <?php foreach ($todos as $todo) :?>
        <div class="blog-post">
          <a href="/Drugi_dio_b/todo/tasks/<?=$todo->todoId ?>"><h2 class="blog-post-title"><?= $todo->listName; ?></h2>
            <p class="blog-post-meta"><a href="#"><?= date("d-m-Y H:i:s", strtotime($todo->created_at)); ?></a></p>
            <p class="blog-post-meta">Ukupan broj taskova: <?=$todo->num_task; ?></a></p>
            <p class="blog-post-meta">Ukupan broj nedovrsenih taskova: <?=$todo->uncompleted; ?></a></p>
            <div class="row">       
              <form method="POST" action="/Drugi_dio_b/todos/delete" class="ml-md-auto">
                <input type="hidden" name="id" value="<?=$todo->todoId; ?>">
                <input type="submit" value="Brisi" class="btn btn-danger"/>
              </form>
            </div>
          </div>
          <hr>
        <?php endforeach ;?>
      </div>
    </div>
  </main>
  <?php require 'views/partials/footer.view.php' ?>
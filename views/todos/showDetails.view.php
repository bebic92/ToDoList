<?php require 'views/partials/header.view.php' ?>
<div class="blog-header grey">
  <div class="container">
    <h1 class="blog-title"><?= $todo->listName ;?></h1>
    <p class="lead blog-description"><a href="#"><?= date("d-m-Y H:i:s", strtotime($todo->created_at)); ?></a></p>
    <p class="blog-post-meta">Ukupan broj taskova: <?=$todo->num_task; ?></a></p>
    <p class="blog-post-meta">Ukupan broj nedovršenih taskova: <?=$todo->uncompleted; ?></a></p>
    <p class="blog-post-meta">Napredak: <?=$avg; ?> %</a></p>
    <form method="POST" action="/Drugi_dio_b/todos/delete">
      <input type="hidden" name="id" value="<?=$todo->todoId; ?>">
      <input type="submit" value="Briši cijelu listu -" class="btn btn-danger"/>
    </form> 

  </div>
</div>
<main role="main" class="container">
  <div class="row">  
    <div class="col-sm-8 blog-main">
      <a href="/Drugi_dio_b/todo/task/create" class="ml-md-auto"><input type="submit" value="Dodaj novi zadatak +" class="btn btn-primary"/></a>
      <hr>   
      <?php if(!empty($todoTasks)) :?>
        <form action="/Drugi_dio_b/todo/tasks/sort/"  method="GET" align="right">
          <div class="form-group">
            <select name="sort_tasks" class="form-control" onchange="this.form.submit()">
              <option value="">Sortirajte</option>
              <option value="naziv_asc">Nazivu A-Z </option>
              <option value="naziv_desc">Nazivu Z-A </option>
              <option value="status_desc">Nedovrseni prije</option>
              <option value="status_asc">Dovrseni prije</option>
              <option value="prioritet_desc">Od niskog prioriteta prema visokom</option>
              <option value="prioritet_asc">Od visokog prioriteta prema niskom</option>
              <option value="datum_zavrsetka_desc">Datum zavrsetka prije</option>
              <option value="datum_zavrsetka_asc">Datum zavrsetka kasnije</option>
            </select>
          </div>

        </form>
      <?php endif; ?>
      <?php foreach ($todoTasks as $todoTask) :?>
        <div class="blog-post">
          <h3 class="blog-post-title"><?= $todoTask->taskName; ?></h3>
          <p class="blog-post-meta"><a href="#">Rok za izvršenje zadatka: <?= date("d-m-Y H:i:s", strtotime($todoTask->deadline)); ?></a></p>
          <?php if($todoTask->DateDiff >= 0) : ?>
            <p class="blog-post-meta">Broj preostalih dana za izvršenje zadatka: <?=$todoTask->DateDiff; ?></p>
          <?php elseif($todoTask->DateDiff < 0 && $todoTask->status == 0)  : ?>
            <p class="blog-post-meta">Broj dana za za koliko se premašilo izvršenje zadatka: <?=($todoTask->DateDiff * -1); ?></p>
          <?php endif; ?>
          <p class="blog-post-meta">Izvršeno: 
            <?php ($todoTask->status == 1 ? print "DA" : print "NE") ?></a></p>
            <p class="blog-post-meta">Prioritet: 
              <?php if($todoTask->priority == 'normal'){print "Normalan";}
              elseif ($todoTask->priority == 'high'){print "Visok";}else{print "Nizak";}?></a></p>

              <div class="row">
                <a href="/Drugi_dio_b/todo/task/update/<?= $todoTask->taskId; ?>" class="ml-3"><input type="submit" value="Uredi zadatak" class="btn btn-success"/></a>
                <form method="POST" action="/Drugi_dio_b/task/delete" class="ml-md-auto">
                  <input type="hidden" name="task_id" value="<?=$todoTask->taskId; ?>">
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
<?php require 'views/partials/header.view.php' ?>
<main role="main" class="container">

  <div class="row">

    <div class="col-sm-8 blog-main">
      <div class="blog-post">
        <h2 class="blog-post-title">Ovdje možete urediti vaš zadatak</h2>
        <hr>
        <form method="POST" action="/Drugi_dio_b/todo/task/update">
        <input type="hidden" name="task_id" value="<?=$task->taskId; ?>">
          <div class="form-group">
            <label for="taskName">Naziv zadataka</label>
            <input type="text" class="form-control" id="taskName" name="taskName" aria-describedby="taskName" value="<?= $task->taskName ?>">
          </div>
          <label for="deadline">Rok za izvršavanje</label>
            <div class="form-group row ml-1	">
             <div class="col-xs-2">
            <input type="date" class="form-control" id="deadline" name="deadline" 
            value="<?= date("Y-m-d", strtotime($task->deadline));?>">
          	</div>
          </div>
          <label for="priority">Prioritet</label>
            <div class="form-group row ml-1">
            <div class="col-xs-2">
            <select name="priority" class="form-control">
            <?php if ($task->priority == "normal") :?>
             <option value="normal">Normalan</option>
             <option value="high">Visok</option>
             <option value="low">Nizak</option>
            <?php endif; ?>
             <?php if ($task->priority == "high") :?>
             <option value="high">Visok</option>
             <option value="normal">Normalan</option>
             <option value="low">Nizak</option>
            <?php endif; ?>
             <?php if ($task->priority == "low") :?>
             <option value="low">Nizak</option>
             <option value="high">Visok</option>
             <option value="normal">Normalan</option>
            <?php endif; ?>
          	</select>
          	</div>
          </div>
          <label for="status">Završeno</label>
            <div class="form-group row ml-1">
            <div class="col-xs-2">
            <select name="status" class="form-control">
            <?php if ($task->status == "0") :?>
             <option value="0">NE </option>
             <option value="1">DA</option>
            <?php endif ; ?>
            <?php if ($task->status == "1") :?>
             <option value="1">DA </option>
             <option value="0">NE</option>
            <?php endif ; ?>
          	</select>
          	</div>
          </div>
          <hr>
          <button type="submit" class="btn btn-success">Potvrdi</button>
        </form>

        </div>
    </div>
 <aside class="col-sm-3 ml-sm-auto blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
              <?php require 'views/errors/errors.view.php' ?> 
          </div>
        </aside><!-- /.blog-sidebar -->
  </div>
</main>
<?php require 'views/partials/footer.view.php' ?>
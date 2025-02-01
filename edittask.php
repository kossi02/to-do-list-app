<?php
    require_once('authorizeaccess.php');
?>
<!DOCTYPE html>
<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384
        -QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit The to-do list</title>
    
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h1>Edit this Task</h1>
        <nav class="nav">
          <a class="nav-link" href="index.php">HomePage</a>
        </nav>
        <hr/>
        <?php
            require_once('dbconnection.php');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error('Error connecting to MySQL server for DB_NAME.',
                            E_USER_ERROR);

            if (isset($_GET['id_to_edit']))
            {
                $id_to_edit = $_GET['id_to_edit'];

                $query = "SELECT * FROM list WHERE id = $id_to_edit";

                $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database list',
                    E_USER_ERROR);

                if (mysqli_num_rows($result) == 1)
                {
                    $row = mysqli_fetch_assoc($result);

                    $task_title = $row['title'];
                    $task_note = $row['note'];
                    $task_priority = $row['priority'];
                    $task_date = $row['date'];
                    $task_time = $row['time'];
                }             
            }
            elseif (isset($_POST['edit_task_submission'],$_POST['task_title'],
                      $_POST['task_note'], $_POST['task_priority'], $_POST['task_date'], $_POST['task_time'] ))
            {
                $task_title = $_POST['task_title'];
                $task_note = $_POST['task_note'];
                $task_priority = $_POST['task_priority'];
                $task_date = $_POST['task_date'];
                $task_time = $_POST['task_time'];
                $id_to_update = $_POST['id_to_update'];

                $query = "UPDATE list SET title = '$task_title', "
                        . " note = '$task_note', priority = '$task_priority', "
                        . " date = '$task_date', time = '$task_time' "
                        . "WHERE id = $id_to_update";

                mysqli_query($dbc, $query)
                    or trigger_error(
                        'Error querying database list: Failed to update task',
                        E_USER_ERROR);

                $nav_link = 'taskdetails.php?id=' . $id_to_update;

                header("Location: $nav_link");          
            }
            else 
            {
                header("Location: index.php");
            }
        ?>
         <form class="needs-validation" novalidate method="POST" 
              action="<?= $_SERVER['PHP_SELF'] ?>">
          <div class="form-group row">
            <label for="task_title"
                   class="col-sm-3 col-form-label-lg">Title</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="task_title" 
                     name="task_title" 
                     value= '<?=$task_title?>' 
                     placeholder="Title" required>
              <div class="invalid-feedback">
                Please provide a valid task title.
              </div>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="task_note" 
                   class="col-sm-3 col-form-label-lg">Note</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="task_note" 
                     name="task_note" value= '<?=$task_note?>'
                     placeholder="note" required>
              <div class="invalid-feedback">
                Please write a note
              </div>
            </div>
          </div>
          <div class="form-group row">
          <label for="task_priority" 
                   class="col-sm-3 col-form-label-lg">Priority</label>
            <div class="col-sm-4">
              <select class="custom-select" id="task_priority" 
                     name="task_priority"
                     placeholder="priority" required>
                     <option value="" disabled selected>Choose a priority</option>
                     <option value="High" <?= $task_priority == "High" ? 'selected' : '' ?> >High</option>
                     <option value="Medium" <?= $task_priority == "Medium" ? 'selected' : '' ?> >Medium</option>
                     <option value="Low" <?= $task_priority == "Low" ? 'selected' : '' ?> >Low</option>
                </select>
              <div class="invalid-feedback">
                Please select a priority.
              </div>
            </div>
          </div>
 
          <div class="form-group row">
            <label for="task_date" 
                   class="col-sm-3 col-form-label-lg">Date</label>
            <div class="col-sm-4">
              <input type="date" class="form-control" id="task_date" 
                     name="task_date" value= '<?=$task_date?>'
                     placeholder="task Date" required>
              <div class="invalid-feedback">
                Please provide a valid date.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="task_time" 
                   class="col-sm-3 col-form-label-lg"> Time </label>
            <div class="col-sm-4">
              <input type="time" class="form-control" 
                     id="task_time" 
                     name="task_time" value= '<?=$task_time?>'
                     placeholder="time" required>
              <div class="invalid-feedback">
                Please provide a valid time.
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit" 
                  name="edit_task_submission">Update my task</button>
          <input type="hidden" name="id_to_update" value="<?= $id_to_edit ?>">
        </form>
        <script>
        
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
        </script>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384
            -YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
  </body>
</html>

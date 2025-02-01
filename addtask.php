<?php
    require_once('authorizeaccess.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Add a Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384
        -QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"  
        crossorigin="anonymous">
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h1>Add a Task</h1>
        <nav class="nav">
          <a class="nav-link" href="index.php">HomePage</a>
        </nav>
        <hr/>
        <?php
            $display_add_task_form = true;
            
            if (isset($_POST['add_task_submission'], $_POST['task_title'],
                      $_POST['task_note'], $_POST['task_priority'], $_POST['task_date'], $_POST['task_time'] ))
            {
                require_once('dbconnection.php');

                $task_title = $_POST['task_title'];
                $task_note = $_POST['task_note'];
                $task_priority = $_POST['task_priority'];
                $task_date = $_POST['task_date'];
                $task_time = $_POST['task_time'];
                
                
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error(
                                'Error connecting to MySQL server for' . DB_NAME, 
                                E_USER_ERROR);

                $query = "INSERT INTO list (title, note , priority, date, time) " 
                       . " VALUES ('$task_title', '$task_note', '$task_priority', '$task_date', '$task_time')";

                mysqli_query($dbc, $query)
                    or trigger_error(
                        'Error querying database list: Failed to insert task',
                        E_USER_ERROR);

                $display_add_task_form = false;
        ?>
               <h3 class="text-info">This Task was added </h3><br/>

                <h1>Task</h1>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><?= $task_title ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Note</th>
                        <td><?= $task_note ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Priority</th>
                        <td><?= $task_priority ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td><?= $task_date ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Time</th>
                        <td><?= $task_time ?></td>
                    </tr>
                    </tbody>
                </table>
                <hr/>
                <p>Would you like to <a href='<?= $_SERVER['PHP_SELF'] ?>'> add another task
                </a>?</p>
        <?php
            }

            if ($display_add_task_form)
            {
        ?>
        <form class="needs-validation" novalidate method="POST" 
              action="<?= $_SERVER['PHP_SELF'] ?>">
          <div class="form-group row">
            <label for="task_title"
                   class="col-sm-3 col-form-label-lg">Title</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="task_title" 
                     name="task_title" placeholder="Title" required>
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
                     name="task_note" placeholder="note" required>
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
                     <option value="High" >High</option>
                     <option value="Medium" >Medium</option>
                     <option value="Low">Low</option>
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
                     name="task_date" placeholder="task Date" required>
              <div class="invalid-feedback">
                Please provide a valid date.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="task_time" 
                   class="col-sm-3 col-form-label-lg"> time </label>
            <div class="col-sm-4">
              <input type="time" class="form-control" 
                     id="task_time" 
                     name="task_time"
                     placeholder="time" required>
              <div class="invalid-feedback">
                Please provide a valid time.
              </div>
            </div>
          </div>

          <button class="btn btn-primary" type="submit" 
                  name="add_task_submission">Add a Task</button>
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
        <?php
            }
        ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
  </body>
</html>

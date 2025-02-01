<?php
    require_once('authorizeaccess.php');
?>
<html>
  <head>
    <title>Delete a task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h1>Delete this task</h1>
        <?php
            require_once('dbconnection.php');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error('Error connecting to MySQL server for DB_NAME.',
                            E_USER_ERROR);

            if (isset($_POST['delete_task_submission'], $_POST['id'])):

                $id = $_POST['id'];

                $query = "DELETE FROM list WHERE id = $id";

                $result = mysqli_query($dbc, $query)
                        or trigger_error('Error querying database list', E_USER_ERROR);

                header("Location: index.php");

            elseif (isset($_POST['do_not_delete_task_submission'])):

                header("Location: index.php");

            elseif (isset($_GET['id_to_delete'])):
        ?>
                <h3 class="text-danger">Confirm?</h3><br/>
        <?php
                $id = $_GET['id_to_delete'];

                $query = "SELECT * FROM list WHERE id = $id";

                $result = mysqli_query($dbc, $query)
                        or trigger_error('Error querying database list', E_USER_ERROR);

                if (mysqli_num_rows($result) == 1):

                    $row = mysqli_fetch_assoc($result);
            ?>
            <h1>Have you completed this task? If yes you can delete it </h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td><?= $row['title'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Note</th>
                        <td><?= $row['note'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Priority</th>
                        <td><?= $row['priority'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Date</th>
                        <td><?= $row['date'] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Time</th>
                        <td><?= $row['time'] ?></td>
                    </tr>
                </tbody>
        </table>
            <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
              <div class="form-group row">
                <div class="col-sm-2">
                  <button class="btn btn-outline-danger" type="submit" name="delete_task_submission">Delete task</button>
                </div>
                <div class="col-sm-2">
                  <button class="btn btn-outline-success" type="submit" name="do_not_delete_task_submission">Cancel</button>
                </div>
                <input type="hidden" name="id" value="<?= $id ?>;">
              </div>
            </form>
            <?php
                else:
            ?>
        <h3>No Post :-(</h3>
            <?php
                endif;

            else: 

                header("Location: index.php");

            endif;
        ?>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
  </body>
</html>

<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-
        QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Task</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
      <nav class="nav">
      <h1><a class="nav-link" href="index.php">HomePage</a></h1>
      </nav>
      <?php
            if (isset($_GET['id'])):
            
            require_once('dbconnection.php');

            $id = $_GET['id'];

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error('Error connecting to MySQL server for '
                    . DB_NAME, E_USER_ERROR);

            $query = "SELECT * FROM list WHERE id = $id";

            $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database list', E_USER_ERROR);
                    
            if (mysqli_num_rows($result) == 1):

            $row = mysqli_fetch_assoc($result)
    ?>
    <h1>Task</h1>
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
        <hr/>
        <p>If you already completed this task you can <a href='deletetask.php?id_to_delete=<?=$row['id']?>'> delete it</a> it now or
            <a href='edittask.php?id_to_edit=<?=$row['id']?>'> edit it</a></p>       
        <?php
            else:
        ?>
    <h3>No Post :-(</h3>
    <?php
            endif;

        else:
     ?>
    <h3>No Post :-(</h3>
        <?php
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

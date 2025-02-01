<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-
        QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        <link rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous">
        
    <title>TO-DO List</title>
  </head>
  <body>
    <div  class="p-3 mb-2 bg-primary-subtle text-primary-emphasis">
      <div class="card-body">
        <h1>My Day <i class="fas fa-sun"></i></h1>
        
        <?php
            require_once('dbconnection.php');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or trigger_error('Error connecting to MySQL server for'
                    .  DB_NAME, E_USER_ERROR);

            $query = "SELECT id, title, note FROM list ORDER BY time asc";

            $result = mysqli_query($dbc, $query)
                    or trigger_error('Error querying database list', 
                    E_USER_ERROR);
                    
            if (mysqli_num_rows($result) > 0):
        ?>
            <div class="card-body ">
              <div class="card-body" >
                <h2 class="card-title">To-Do list</h2>
             </div>  
             <ul class="list-group list-group-flush" style="width: 18rem;">
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
                   echo "<li class='list-group-item'>"
                         . "<input class='form-check-input me-1' type='checkbox' value='' id='firstCheckbox'>"
                         . "<label class='form-check-label' for='firstCheckbox'>"
                         . "<a class='nav-link' href='taskdetails.php?id="
                         . $row['id'] . "'>"
                         .$row['title'] 
                         . "</a></label></li>";                         
                }
            ?>
              </ul>
              <hr/>
              
                <div class="card-body">
                    <a href='addtask.php' > <i class="fas fa-plus"></i>  ADD TASK</a>
                </div>
            </div>
                  
        <?php
            else:
        ?>
                <h3>You completed all your tasks for Today!!! Nice :-(</h3>
                <div class="card-body">
                    <a href='addtask.php' > <i class="fas fa-plus"></i>  ADD TASK</a>
                </div>
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

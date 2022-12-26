<html>
 <head>
  <title>conference list</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
  crossorigin="anonymous">
 </head>
 <body>
    <div class="w-50 col-md-8 mx-auto">
    <form method="post" action="/conference/create">
        <input type="submit" value="create new conference" />
    </form>
    <table class="table" >
        <tr>
        <th> Title </th>
        <th> Date </th>
        </tr> 

        <?php
         foreach($data as $row)
         {
          echo "<tr align='center'>";
          echo "<td align='center'>".$row['title']."</td>";
          echo "<td align='center'>".$row['date']."</td>";
          echo 
          "<td align='center'>
            <form method='get' action='/conference/details'>
              <input type='hidden' id='id' name='id' value=".$row['id']."/>
              <input type='submit' value='Details' />
            </form>
          </td>";
          echo 
          "<td align='center'>
            <form method='get' action='/conference/edit_form'>
              <input type='hidden' id='id' name='id' value=".$row['id']."/>
              <input type='submit' value='Edit' />
            </form>
          </td>";
          echo 
          "<td align='center'>
            <form method='get' action='/conference/delete'>
              <input type='hidden' id='id' name='id' value=".$row['id']."/>
              <input type='submit' value='Delete' />
            </form>
          </td>";
          echo "</tr>";
         }
        ?>
    </table>
    </div>
 </body>
</html>
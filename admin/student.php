<?php 
if(!isset($_SESSION))
{
    session_start();
}
    include('./adminMainInclude/header.php');
    include('../dbconnection.php');

    if(isset($_SESSION['is_admin_login']))
    {
        $adminEmail = $_SESSION['adminLogEmail'];
    }else{
        echo "<script> location.href = '../index.php';</script>";
    }
?>

<div class="col-sm-9 mt-5">
    <p class=" text-center p-2"><b><i>List Of Students</i></b></p>
    <?php 
        $sql = "SELECT * FROM student";
        $result =$conn->query($sql);
        if($result->num_rows > 0){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><i>Student ID</i></th>
                <th scope="col"><i>Name</i></th>
                <th scope="col"><i>E-Mail</i></th>
                <th scope="col"><i>Action</i></th>
            </tr>
        </thead>
        <tbody>
           <?php while($row = $result->fetch_assoc()){    
           echo ' <tr>';
              echo '<th scope="row">'.$row['stu_id'].'</th>';
                echo '<td>'.$row['stu_name'].'</td>';
                echo '<td>'.$row['stu_email'].'</td>';
                echo '<td>';
                echo   '<form action="editstudent.php" method="POST" class=" d-inline">
                            <input type="hidden" name="id" value='.$row["stu_id"].'>
                            <button type="submit" class="btn btn-outline-info mx-3" name="view" value="View"><i class="fas fa-pen"></i></button>
                        </form>
                        <form action="" method="POST" class=" d-inline">
                        <input type="hidden" name="id" value='.$row["stu_id"].'>
                            <button  type="submit" class="btn btn-outline-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                </td>
            </tr>';
           }?>
        </tbody>
    </table>
      <?php  } else{
          echo "0 Result";
      } 
      
      if(isset($_REQUEST['delete']))
      {
          $sql = "DELETE FROM student WHERE stu_id = {$_REQUEST['id']}";
          if($conn->query($sql) == TRUE){
              echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
          }
          else{
              echo "Unable to Delete";
          }
      }
      
      ?>
</div>

<div>
    <a class="btn btn-outline-danger box" href="./addnewstudent.php">
        <i class="fas fa-plus-square fa-2x"></i>
    </a>
</div>

<?php 
    include('./adminMainInclude/footer.php');
?>
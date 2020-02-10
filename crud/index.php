<?php

session_start();
if(isset($_SESSION['auth'])){
  if($_SESSION['auth']!=1){
    header("location:login.php");
  }
}else{
  if(isset($_COOKIE['author'])){
    if($_COOKIE['author']!=true){
      header("location:login.php");
    }
  }else{
    header("location:login.php");
  }
  header("location:login.php");
}

include "lib/connection.php";  //for xampp
// include "connection.php";  //for live server

//insert start
$result = null;
if(isset($_POST['add_student'])){
  $name   = $_POST['student_name'];
  $email  = $_POST['student_email'];
  $gender = $_POST['student_gender'];
  $s_pass = md5($_POST['s_password']);
  $c_pass = md5($_POST['c_password']);
  $age    = $_POST['student_age'];

  if ($s_pass == $c_pass) {
    $insertSql= "INSERT INTO student_info(name, email, gender,pass, age)
    values ('$name', '$email', $gender, '$s_pass', $age)";

    if($conn -> query($insertSql)){
      $result = "Data Added Successfully";
    }else{
      die($conn -> error);
    }

  }else{
    $result = "Password not matched";
  }
}
//insert end

//select start
$selectSql = "SELECT * FROM student_info";
$result_student= $conn -> query($selectSql);
  //echo $result_student -> num_rows;
//select end

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CRUD</title>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- form -->
          <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="post">
            <label for="student_name">Name</label>
            <input type="text" name="student_name" placeholder="Enter Name" id="student_name" required><br>

            <label for="student_email">Email</label>
            <input type="email" name="student_email" placeholder="Enter Email" id="student_email" required><br>

            <label for="student_gender">Gender</label>
            <select name="student_gender" id="student_gender">
              <option value="0" selected>Male</option>
              <option value="1">Female</option>
            </select><br>

            <label for="student_age">Age</label>
            <input type="number" name="student_age" placeholder="Enter Age" id="student_age" required><br>

            <label for="s_password">Password</label>
            <input type="password" name="s_password" placeholder="Enter Password" id="s_password" required><br>

            <label for="c_password">Confirm Password</label>
            <input type="password" name="c_password" placeholder="Confirm Password" id="c_password" required><br><br>

            <input type="submit" name="add_student" value="submit">
          </form>
          <br>
          <!-- form -->

          <!-- result -->
          <div class="text-center">
            <?php echo $result; ?> <br> <br>
          </div>
          <!-- result -->

          <!-- student_data start -->
          <div>
            <table border="1" cellpadding="10">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Action</th>
              </tr>
              <?php if($result_student -> num_rows > 0){ ?>
              <?php while ($student_row = $result_student -> fetch_assoc()) { ?>
              <tr>
                <td><?php echo $student_row['id'] ?></td>
                <td><?php echo $student_row['name'] ?></td>
                <td><?php echo $student_row['email'] ?></td>
                <td><?php
                  if($student_row['gender'] == 0){
                    echo "Male";}
                    else{
                    echo "Female";}
                  ?>
                  </td>
                <td><?php echo $student_row['age'] ?></td>
                <td>
                  <a href="lib/edit.php?id=<?php
                       echo $student_row['id'];
                  ?>">Edit</a>
                  <a href="lib/delete.php?id=<?php
                       echo $student_row['id'];
                  ?>">Delete</a>
                </td>
              </tr>
              <?php } ?>
            <?php }else{ ?>
            <tr>
              <td colspan="6">No data to show</td>
            </tr>
            <?php } ?>
            </table>
          </div>
          <!-- student_data end -->

          <a href="logout.php">Lgout</a>
        </div>
      </div>
    </div>

    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
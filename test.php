<?php
  // echo date('Y-m-d');
  // echo password_hash("admin", PASSWORD_DEFAULT);
  // echo uniqid();
  // echo trim("E201610001", "E");

  // $conn = mysqli_connect("localhost", "root", "", "mibt");

  // $sql = "SELECT id, discount_given FROM student";
  // $result = mysqli_query($conn, $sql);
  // while($student = mysqli_fetch_assoc($result)){ 
  //   if(!empty($student['discount_given'])){
  //     $query = "UPDATE student SET discount_given = ".round($student['discount_given']*7000)." WHERE id = ".$student["id"];
  //     mysqli_query($conn, $query);
  //   }
  // }

  // echo number_format("1000000")."<br>";
  // echo number_format("1000000",2)."<br>";
  // echo number_format("1000000",2,",",".");

  // echo substr('E201610001', 1);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width">
  <title>Test Log in</title>
  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome core CSS -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">    
  <!-- Creative Time Fresh Bootstrap Table Template -->
  <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/css/styles.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="assets/css/test.css" rel="stylesheet">
</head>
  <body>
    <div class="content">
      <div class="login-header text-center">
        <img src="assets/img/logo/200px.png">
        <h1>MCHL Institute of Business and Technology</h1>
        <div>Sign in to get started.</div>
        <form>
          <input type="text" name="emp_id" placeholder="Employee ID" class="form-control" value="" required>
          <input type="password" name="password" placeholder="Password" class="form-control" required>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <a href="">Forgot Password?</a>
      </div>
    </div>
  </body>
</html>
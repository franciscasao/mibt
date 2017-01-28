<?php
  echo password_hash("superadmin", PASSWORD_DEFAULT);
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
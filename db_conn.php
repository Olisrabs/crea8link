<?php
// database connection: username, password, database name
  $conn = new mysqli("localhost", "crea8linkuser", "crea8link@2026", "crea8link_db");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
?>
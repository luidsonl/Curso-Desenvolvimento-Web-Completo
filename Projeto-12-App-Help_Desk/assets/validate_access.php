<?php

  session_start();

  if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated']!= 'Y') {
    header('Location: index.php?login=error2');
  }

 ?>
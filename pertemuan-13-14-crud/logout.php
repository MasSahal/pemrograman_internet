<?php
//jalankan session
session_start();

//hancurkan semua session login
session_destroy();

//return redirect
header("location:./login.php");;

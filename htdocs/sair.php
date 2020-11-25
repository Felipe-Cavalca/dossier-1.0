<?php
session_start();

unset($_SESSION['Login']);


header('LOCATION: index.php');
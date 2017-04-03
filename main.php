<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require 'MoonPhase.php';

if (isset($_POST['date'])){
    
    $moonPhase = new MoonPhaze($_POST['date']);
   if(!$moonPhase->error) {
        $_SESSION['moonPhase'] = $moonPhase->find();
        $_SESSION['date'] = $moonPhase->month. '/' .$moonPhase->day . '/' . $moonPhase->year;
   }
    
    include 'index.php';
}


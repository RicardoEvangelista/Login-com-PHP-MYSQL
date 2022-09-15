<?php

if(!isset($_SESSION)){
    session_Start();
}

session_destroy();

header("Location: index.php");
<?php

include_once 'Database.class.php';

DataBase::connect()->checkEmail('email');
DataBase::connect()->checkEmail('jeremie.pasquis@gmail.com');
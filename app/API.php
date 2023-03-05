<?php

$data= json_encode([
   'login'=>"salom",
   'password'=> password_hash ("password",PASSWORD_BCRYPT)
]);


var_dump(json_decode($data)->login);

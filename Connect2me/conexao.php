<?php 
    define('HOST','localhost');
    define('USUARIO','root');
    define('SENHA', 'password123');
    define('DB','server');

$conexao = mysqli_connect(HOST,USUARIO,SENHA,DB) or die('Não foi possível conectar');


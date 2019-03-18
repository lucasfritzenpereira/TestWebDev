<?php

session_start();

$mysqli = new mysqli('localhost','root','password123','crud') or die(mysqli_error($mysqli)); 

$id = 0;
$update = false; //para dar update com o botão de salvar quando estiver editando
$name = '';
$email = '';
$telefone ='';
$cep =''; 




if (isset($_POST['save'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    
    $mysqli->query("INSERT INTO dados (nome,email,telefone,cep) VALUES ('$nome','$email','$telefone','$cep')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Seus dados foram salvos com sucesso :D";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
} 

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE from dados where id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Seus dados foram apagados com sucesso D:";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM dados WHERE id=$id") or die($mysqli->error());
    
    if (count($result)==1){
        $row = $result->fetch_array();
        $nome = $row['nome'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $cep = $row['cep'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id']; //escondido
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];


    $mysqli->query("UPDATE dados SET nome='$name',email='$email',telefone='$telefone',cep='$cep' WHERE id=$id") or die($mysqli->error); //update dos dados com o id escondido

    $_SESSION['message'] = "Dados atualizados com sucesso ^-^";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php'); //leva de volta para o index;
}

?>
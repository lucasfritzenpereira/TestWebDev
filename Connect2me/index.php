<!DOCTYPE html>
<html>
<head>
<!--Base do site -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Connect2me</title>
  <!--Puxa o Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.css">   
  <link rel="stylesheet" href="css/index.css">
  <link rel="shorcut icon" href="img/favicon.png"> 
  <link href="https://fonts.googleapis.com/css?family=Margarine" rel="stylesheet"> 
</head>
<body>
      
  <!--Conecta com o process -->
  <?php require_once 'process.php'; ?>

  <?php  
  
  if (isset($_SESSION['message'])): ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>"> <!--Alerta é baseado no alert-danger ou alert-success do process.php -->

  <?php 
    echo $_SESSION['message'];
    unset ($_SESSION['message']);
  ?>
  </div>
  <?php endif ?>

<div class="container">
  <h2 class="titulo">Connect2me</h2>
</div>

<hr>

<div class="container">
    <p>"Pode usar esse site à vontade :D. Nessa lista é possível <strong class="str1">editar</strong>, <strong class="str2">apagar</strong> e <strong class="str3">salvar</strong> e <strong class="str4">atualizar</strong> novos contatos que você desejar."</p>
</div>

<div class="container">
  <!--Conecta com a base de dados -->
  <?php 
    $mysqli = new mysqli('localhost','root','password123','crud') or die (mysqli_error($mysqli));
    $result = $mysqli->query ("SELECT * from dados") or die ($mysqli->error);
    //pre_r($result);puxa a coluna (sem esse só tem os dados gerais) pre_r puxa um de cada vez, mas dá pra fazer um loop
    ?>

  <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Telefone</th>
              <th>CEP</th>
              <th colspan="4">Action</th>
          </tr>
        </thead>
    <?php 
      while ($row = $result->fetch_assoc()): //loop de while para puxar dados continuamente ?>
        <tr>
              <td class="tdnome"><?php echo $row['nome'];  ?> </td>
              <td><?php echo $row['email'];  ?> </td>
              <td><?php echo $row['telefone'];  ?> </td>
              <td><?php echo $row['cep'];  ?> </td>
              <td>
                  <a href="index.php?edit=<?php echo $row['id']; ?>"
                  class="btn btn-info">Editar</a>
                  <a href="process.php?delete=<?php echo $row['id']; ?>"
                  class="btn btn-danger">Apagar</a>
              </td>
        </tr>
              <?php endwhile; ?>    
      <table>
  </div>
    <?php 
    function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
  ?>
  <div class="row justify-content-center">
  <form action="process.php" method="POST">

      <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Esse id não existe ainda, então é preciso dar um valor para ele no process -->

    <div class="form-group">
    <label>Nome</label>
    <input type="type" name="nome" class="form-control" value="<?php echo $nome;?>" placeholder="Coloque o nome" required>
    </div>

    <div class="form-group">
    <label>E-mail</label>
    <input type="type" name="email" class="form-control" value="<?php echo $email;?>" placeholder="Coloque seu e-mail" required>
    </div>

    <div class="form-group">
    <label>Telefone</label>
    <input type="type" name="telefone" class="form-control" value="<?php echo $telefone;?>" placeholder="Coloque seu telefone" required>
    </div>

    <div class="form-group">
    <label>CEP</label>
    <input type="type" name="cep" class="form-control" value="<?php echo $cep;?>" placeholder="Coloque seu CEP" required>
    </div>


    <div class="form-group butao">

      <?php 
        if ($update == true): 
        ?>
        <button type="submit" class="btn btn-success att" name="update">Atualizar</button>
      <?php else: ?>

    <button type="submit" class="btn btn-primary sav" name="save">Salvar</button>
        <?php endif; ?>
    </div>
    
  </form>
  </div>
  </div>
  <hr>
  <footer class="footer">
    <p> Feito com <img class="heart" src="img/heart.png" alt="carinho"> por Lucas Fritzen Pereira :D
  </footer>
</body>
</html>

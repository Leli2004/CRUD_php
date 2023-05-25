<?php
     include '../BD.class.php';
     $conn = new BD();
    
    if(!empty($_GET['id'])){
        $conn->deletar($_GET['id']);
        header("location: List.php");
    }

    if(!empty($_POST)){
        $load = $conn->pesquisar($_POST);
    }

    else{
        $load = $conn->select();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>List</title>
</head>
<body>
<div style="margin: 13px;"> 
    <h2>Listagem de AuMigos</h2>
<form action="List.php" method="post">
    <select name="campo">
        <option value="nome">Nome</option>   
        <option value="idade">Idade</option>
        <option value="peso">Peso</option>   
        <option value="Tutor">Tutor</option>     
    </select>
    <label>Valor</label>
    <input type="text" name="valor" placeholder="Para pesquisar"/>
    <button type="submit"  class="btn btn-outline-dark">Buscar</button>
</form>

<br>
    <a href="Form.php">Cadastrar</a><br><br>
<table border="1" class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Idade</th>
        <th>Peso</th>
        <th>Tutor</th>
    </tr>
    <?php
        foreach($load as $item){
            echo "<tr>";
                echo "<td>".$item->nome."</td>";
                echo "<td>".$item->idade."</td>";
                echo "<td>".$item->peso."</td>";
                echo "<td>".$item->tutor."</td>";
                 echo "<td><a href='Form.php?id=$item->id'>Editar</a></td>";
                echo "<td><a onclick='return confirm(\"Deseja Excluir? \")' href='List.php?id=$item->id'>Deletar</a></td>";
            echo "<tr>";
        }
    ?>
</table>
<br><br>
<button class="btn btn-light"> <a href="../index.php">Voltar ao início</a> </button>
    </div>
</body>
</html>
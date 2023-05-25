<?php
 include '../BD.class.php';
 $conn = new BD();

 if(!empty($_POST)){
    try {
        if(empty($_POST['id'])) {
            $conn->inserir($_POST);
        } else {
            $conn->atualizar($_POST);
        }
        header("location: List.php");

    } catch (Exception $e){
        $id = $_POST['id'];
        header("location: Form.php?id=$id&erro=".$e->getMessage()); 
    }
 }

 if(!empty($_GET['id'])) {
    $data = $conn->buscar($_GET['id']); 
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
<title>Form</title>
</head>
<body>
    <div style="margin: 13px;"> 
    <form action="Form.php" method="post">
        <h2>Cadastro de AuMigos</h2>

    <?php echo(!empty($_GET["erro"])? $_GET["erro"]:"") ?> <br> 

    <input type="hidden" name="id" value="<?php echo (!empty($data->id) ? $data->id : "" ) ?>" />

    <label for="" class="form-label">Nome</label>
    <input type="text" name="nome" value="<?php echo (!empty($data->nome) ? $data->nome : "" ) ?>"><br>

    <label for="" class="form-label">Idade</label>
    <input type="number" name="idade" value="<?php echo (!empty($data->idade) ? $data->idade : "" ) ?>"><br>

    <label for="" class="form-label">Peso (kg)</label>
    <input type="float" name="peso" value="<?php echo (!empty($data->peso) ? $data->peso : "" ) ?>"><br>

    <label for="" class="form-label">Nome tutor</label>
    <input type="text" name="tutor" value="<?php echo (!empty($data->tutor) ? $data->tutor : "" ) ?>"><br>

    <button type="submit" class="btn btn-outline-success"> <?php echo (empty($_GET['id'])?"Salvar":"Atualizar")?></button><br> 
    <br><br>
    <button class="btn btn-light"> <a href="../index.php">Voltar ao início</a> </button>
    <br><br>
    </form>
    </div>
</body>
</html>
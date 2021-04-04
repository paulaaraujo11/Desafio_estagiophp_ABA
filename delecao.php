<?php
require 'banco.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

// Verfica se houve alguma requisição para deleção, do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    //Deletar Funcionário do BD:
    $conn = Banco::conectar();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM funcionario where id = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Deletar Funcionário</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well">Excluir Funcionário</h3>
            </div>
            <form class="form-horizontal" action="delecao.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>" />

                <div class="alert alert-danger">
                    Deseja excluir o Funcionário?
                </div>

                <div class="form actions">
                <button type="submit" class="btn btn-danger">Sim</button>
                <a href="index.php" type="btn" class="btn btn-light">Não</a>
                </div>
            </form>
        </div>
    </div>  
</body>
</html>

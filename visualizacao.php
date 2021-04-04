<?php
require 'banco.php';

$id = null;

if (!empty($_GET['id'])) { 
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $conn = Banco::conectar();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT funcionario.id,funcionario.nome_funcionario, funcionario.funcao_funcionario, funcionario.idade_funcionario, departamento.nome_departamento FROM funcionario INNER JOIN departamento ON funcionario.id_departamento = departamento.id where funcionario.id = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($id));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Dados do Funcionário</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Dados do Funcionário</h3>
            </div>
            <div class="container">
                <div class="form-horizontal">

                    <div class="control-group">
                        <label class="control-label"><b>Nome do Funcionário</b></label>
                        </br>
                        <?php echo $data['nome_funcionario']; ?>
                    </div>
                    </br>

                    <div class="control-group">
                        <label class="control-label"><b>Função do Funcionário</b></label>
                        </br>
                        <?php echo $data['funcao_funcionario']; ?>
                    </div>
                    </br>

                    <div class="control-group">
                        <label class="control-label"><b>Departamento</b></label>
                        </br>
                        <?php echo $data['nome_departamento']; ?>
                        </div>
                    </div>
                    <br/>

                    <div class="control-group">
                        <label class="control-label"><b>Idade</b></label>
                        </br>
                        <?php echo $data['idade_funcionario']; ?>
                        </div>
                    </div>
                    <br/>

                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-light">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

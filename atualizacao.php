<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ($id == null) {
    header("Location: index.php");
}

// Verfica se houve alguma requisição para atualização, do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeErro = null;
    $funcaoErro = null;
    $idadeErro = null;
    $deptErro = null;
   
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];
    $idade = $_POST['idade'];
    $departamento = $_POST['departamento'];
    
    //Validação dos campos antes de atualizar
    $validacao = true;

    if (empty($nome)) {
        //traz os departamentos e envia ao formulário junto com o erro
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $nomeErro = 'Por favor digite o nome do funcionário!';
        $validacao = false;
    }

    if (empty($funcao)) {
        //traz os departamentos e envia ao formulário junto com o erro
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $funcaoErro = 'Por favor digite a função do funcionário!';
        $validacao = false;
    }

    if (empty($idade)) {
        //traz os departamentos e envia ao formulário junto com o erro
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $idadeErro = 'Por favor  digite uma idade,em anos,válida!';
        $validacao = false;
    }elseif (!is_numeric($idade) or ($idade < 0)) {
        //traz os departamentos e envia ao formulário junto com o erro
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $idadeErro = 'A idade precisa ser um número maior ou igual a zero!';
        $validacao = False;
    }

     if (empty($departamento)) {
        //traz os departamentos e manda junto com o erro
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $enderecoErro = 'Por favor escolha o departamento do funcionário!';
        $validacao = false;
    }

    //Atualizando Funcionário no BD
    if ($validacao) {
        $conn = Banco::conectar();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE funcionario  set nome_funcionario = ?, funcao_funcionario = ?,  idade_funcionario = ?, id_departamento = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $query->execute(array($nome, $funcao, $idade, $departamento, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $conn = Banco::conectar();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM funcionario where id = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($id));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $nome = $data['nome_funcionario'];
    $funcao = $data['funcao_funcionario'];
    $idade = $data['idade_funcionario'];
    $departamento = $data['id_departamento'];
    
    //trazer também os departamentos envia ao formulário
    $sql = 'SELECT * from departamento ORDER BY id';
    $departamentos = $conn->query($sql);
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Atualizar Funcionário</title>
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
                <h3 class="well"> Atualizar Dados do Funcionário </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="atualizacao.php?id=<?php echo $id ?>" method="post">

                    <div class="col-md-7 control-group <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" type="text" placeholder="Nome do funcionário"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php 
                                if (!empty($nomeErro)): 
                            ?>
                                    <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php
                                endif; 
                            ?>
                        </div>
                    </div>

                    <div class="col-md-5 control-group <?php echo !empty($funcaoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Função</label>
                        <div class="controls">
                            <input name="funcao" class="form-control" type="text" placeholder="Função do funcionário"
                                   value="<?php echo !empty($funcao) ? $funcao : ''; ?>">
                            <?php 
                                if (!empty($funcaoErro)): 
                            ?>
                                    <span class="text-danger"><?php echo $funcaoErro; ?></span>
                            <?php
                                endif; 
                            ?>
                        </div>
                    </div>

                    <div class="col-md-3 control-group <?php echo !empty($deptErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Departamento</label>
                        <div class="controls">
                        <select class="form-control" name="departamento" value="<?php echo $departamento ?>">
                        <?php
                            foreach ($departamentos as $dept){
                                if($dept['id'] == $departamento){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                        ?>
                                <option <?php echo $selected?> value="<?php echo $dept['id'] ?>"> <?php echo $dept['nome_departamento'] ?></option>
                        <?php  
                            }
                        ?>
                        </select>
                        </label>
                        <?php 
                            if (!empty($deptErro)): 
                        ?>
                                <span class="text-danger"><?php echo $deptErro; ?></span>
                        <?php 
                            endif; 
                        ?>
                        </div>
                    </div>

                    <div class="col-md-2 control-group <?php echo !empty($idadeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Idade</label>
                        <div class="controls">
                            <input name="idade" class="form-control" type="number" min="0" placeholder="idade em anos"
                                   value="<?php echo !empty($idade) ? $idade : ''; ?>">
                            <?php 
                                if (!empty($idadeErro)): 
                            ?>
                                    <span class="text-danger"><?php echo $idadeErro; ?></span>
                            <?php 
                                endif; 
                            ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-light">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

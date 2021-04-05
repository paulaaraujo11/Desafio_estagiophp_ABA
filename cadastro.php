

<?php
require 'banco.php';

// Verfica se houve alguma requisição para cadastro, do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $funcaoErro = null;
    $idadeErro = null;
    $deptErro = null;

    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];
    $idade = $_POST['idade'];
    $departamento = $_POST['departamento'];
    

    //Validação dos campos antes de cadastrar
    $validacao = true;

    if (empty($nome)) {
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $nomeErro = 'Por favor digite o nome do funcionário!';
        $validacao = false;
    }

    if (empty($funcao)) {
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $funcaoErro = 'Por favor digite a função do funcionário!';
        $validacao = false;
    }

    if (empty($idade)) {
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $idadeErro = 'Por favor digite uma idade,em anos,válida!';
        $validacao = false;
    }elseif (!is_numeric($idade) or ($idade < 0)) {
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $idadeErro = 'A idade precisa ser um número maior ou igual a zero!';
        $validacao = False;
    }

    if (empty($departamento)) {
        $conn = Banco::conectar();
        $sql = 'SELECT * from departamento ORDER BY id';
        $departamentos = $conn->query($sql);
        Banco::desconectar();
        $enderecoErro = 'Por favor escolha o departamento do funcionário!';
        $validacao = false;
    }


    //Inserindo no BD
    if ($validacao) {
        $conn = Banco::conectar();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO funcionario (nome_funcionario, funcao_funcionario, idade_funcionario, id_departamento) VALUES(?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute(array($nome, $funcao, $idade, $departamento));
        Banco::desconectar();
        header("Location: index.php");
    }
}else{
    //trazer os departamentos para o elemento select
    $conn = Banco::conectar();
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
    <title>Adicionar novo Funcionário</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar um funcionário </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="cadastro.php" method="post">

                    <div class="col-md-7 control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input class="form-control" name="nome" type="text" placeholder="Nome do funcionário">
                            <?php 
                                if (!empty($nomeErro)): 
                            ?>
                                    <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php 
                                endif; 
                            ?>
                        </div>
                    </div>

                    <div class="col-md-5 control-group  <?php echo !empty($funcaoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Função</label>
                        <div class="controls">
                            <input class="form-control" name="funcao" type="text" placeholder="Função do funcionário">
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
                            <select class="form-control" name="departamento">
                        <?php
                                foreach ($departamentos as $dept){  ?>
                                    <option value="<?php echo $dept['id'] ?>"> <?php echo $dept['nome_departamento'] ?></option>
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

                    <div class="col-md-2 control-group <?php echo !empty($idadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Idade</label>
                        <div class="controls">
                            <input class="form-control" name="idade" type="number" min="0" placeholder="idade em anos">
                            <?php 
                                if (!empty($idadeErro)): 
                            ?>
                                    <span class="text-danger"><?php echo $idadeErro; ?></span>
                            <?php 
                                endif; 
                            ?>
                        </div>
                    </div>

                    </br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-light">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


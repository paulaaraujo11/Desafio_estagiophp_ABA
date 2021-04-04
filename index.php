<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <h2>Gerenciamento de Funcionários</h2>
            </div>
        </div>
        </br>
            <div class="row">
                <p>
                    <a href="cadastro.php" class="btn btn-success">Adicionar</a>
                </p>
                <?php
                    include 'banco.php';
                    $conn = Banco::conectar();
                    $sql = 'SELECT funcionario.id,funcionario.nome_funcionario,funcionario.funcao_funcionario,funcionario.idade_funcionario,departamento.nome_departamento
                            FROM funcionario
                            INNER JOIN departamento
                            ON funcionario.id_departamento = departamento.id ORDER BY funcionario.nome_funcionario';
                    $resultado = $conn->query($sql);
                    $qtd_funcionarios = $resultado->rowCount();
                    if($qtd_funcionarios>=1){
                ?> 
                </div>
                      <div class="d-flex flex-row-reverse">
                        <div class="p-2 alert alert-info"><b><?php echo $qtd_funcionarios; ?></b> funcionário(s) cadastrado(s)</div>
                      </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Função</th>
                                    <th>Idade</th>
                                    <th>Departamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php  
                            foreach($conn->query($sql) as $funcionario){
                                echo '<tr>';
        			            echo '<th scope="row">'. $funcionario['id'] . '</th>';
                                echo '<td>'. $funcionario['nome_funcionario'] . '</td>';
                                echo '<td>'. $funcionario['funcao_funcionario'] . '</td>';
                                echo '<td>'. $funcionario['idade_funcionario'] . '</td>';
                                echo '<td>'. $funcionario['nome_departamento'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-primary" href="visualizacao.php?id='.$funcionario['id'].'">Ver<i class="fas fa-edit"></i></a>';
                                echo ' ';
                                echo '<a class="btn btn-warning" href="atualizacao.php?id='.$funcionario['id'].'">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delecao.php?id='.$funcionario['id'].'">Excluir</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            Banco::desconectar();
                ?>
                            </tbody>
                        </table>
                <?php
                    }else{
                        echo '</div>';
                        echo '</br>';
                        echo '<div class="alert alert-danger">Ainda não há funcionário(s) cadastrado(s)!</div>';
                    } ?>
            </div>
        </div>
</body>
</html>

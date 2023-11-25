<?php

include "conexao.php";


// Verifica se o nome e o e-mail estão definidos na sessão
if (isset($_SESSION['nome'], $_SESSION['email'])) {
    // Obtém os dados diretamente da sessão
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $cpf = $_SESSION['cpf'];
    $data_nasc = $_SESSION['data'];// Lembre-se de adicionar outras informações conforme necessário

} else {
    // Se o nome ou o e-mail não estiverem definidos na sessão, redirecione para a página de login
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/validaCPF.js"></script>
    <script src="js/buscaCep.js"></script>
    <link rel="stylesheet" href="css/alterar.css">
</head>
<body>

<?php 

            //     $sql_selectCEP = "SELECT r.cd_cep
            //     FROM tb_residencia_usuario ru
            //     JOIN tb_residencia r ON ru.cd_residencia = r.cd_residencia
            //     WHERE ru.cd_usuario = :cd_usuario";

            //     // Prepara a consulta
            //     $stmt_selectCEP = $conn->prepare($sql_selectCEP);

            //     // Substitui os parâmetros da consulta
            //     $stmt_selectCEP->bindParam(':cd_usuario', $cd_usuario);

            //     // Executa a consulta
            //     $stmt_selectCEP->execute();

            //     // Obtém o resultado
            //     $result = $stmt_selectCEP->fetch(PDO::FETCH_ASSOC);

            //     // Verifica se há resultados
            //     if ($result) {
            //     $cepUsuario = $result['cd_cep'];
            //     $_SESSION['cep'] = $cepUsuario;
            //     } else {
            //     echo "Usuário sem CEP associado.";
            //     }
                    
            // // Vincule o parâmetro
            // $stmtSelectUsuario->bindValue(":nm_email", $email);

?>

<main>

<div class="flex-box container-box">
    <div class="formulario">
        <form class="row g-3" action="confirma_alterar.php" method="POST" autocomplete="off">
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="inputAddress2" placeholder="" value="<?php echo $_SESSION['nome'];?>">
              </div>
              <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail4" value="<?php echo $_SESSION['email'];?>">
              </div>
              <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="inputPassword4" placeholder="..."> 
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">Data de Nascimento</label>
                <input type="text" class="form-control" name="dt_nascimento" id="inputAddress" placeholder="" value="<?php echo $_SESSION['data'];?>">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep" id="cep" onblur="pesquisacep(this.value);" value="<?php echo $_SESSION['cep'];?>">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" placeholder="" value="<?php echo $_SESSION['rua'];?>">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="" value="<?php echo $_SESSION['bairro'];?>">
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $_SESSION['cidade'];?>">
              <div class="col-md-4">
                <label for="inputState" class="form-label">Estado</label>
                <input type="text" class="form-control" id="uf" name="estado" name="uf" value="<?php echo $_SESSION['estado'];?>">
              </div>
              <div class="col-md-2">
                <label for="inputZip" class="form-label">N°</label>
                <input type="text" class="form-control" name="numero" id="inputZip" value="<?php echo $_SESSION['numero'];?>">
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Lembrar-me
                  </label>
                </div>
              </div>
              <br>
              <div class="col-12">
              <button type="submit" class="btn btn-primary" style="
    background-color: #7d88c1;
    border: none;
" >Atualizar </button>
              </div>
            </form>
    </div>
</div>

</main>

</body>
</html>
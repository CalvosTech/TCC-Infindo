<?php
include "conexao.php";

$email = $_SESSION['email'];

$sql_selectUsuario = "SELECT cd_usuario FROM tb_usuario WHERE nm_email = :nm_email";
$stmtSelectUsuario = $conn->prepare($sql_selectUsuario);

// Vincule o parâmetro
$stmtSelectUsuario->bindValue(":nm_email", $email);

// Execute a consulta
if ($stmtSelectUsuario->execute()) {
    // Obtenha o ID do usuário
    $result = $stmtSelectUsuario->fetch(PDO::FETCH_ASSOC);
    $cd_usuario = $result['cd_usuario'];
} else {
    // Trate o erro, se houver
    echo "Erro ao executar a consulta.";
}

// Verifica se os dados do formulário foram recebidos
if(isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['dt_nascimento'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $numero = $_POST['numero'];

    try {
        $sql_update_usuario = "UPDATE tb_usuario 
        SET nm_usuario = :nm_usuario,
        nm_email = :nm_email,
        nm_senha = :nm_senha,
        dt_nascimento = :dt_nascimento
        WHERE cd_usuario = :cd_usuario";
    
        $stmtUpdateUsuario = $conn->prepare($sql_update_usuario);

        $stmtUpdateUsuario->bindValue(":cd_usuario", $cd_usuario);


            // Remover espaços extras no nome do usuário
            $nome = trim($nome);
    
        $stmtUpdateUsuario->bindValue(":nm_usuario", $nome);
        $stmtUpdateUsuario->bindValue(":nm_senha", $senha);
        $stmtUpdateUsuario->bindValue(":dt_nascimento", $dt_nascimento);
        $stmtUpdateUsuario->bindValue(":nm_email", $email);
    
        // Adicione estas linhas para imprimir os valores antes da execução
        // echo "Valores antes da execução:<br>";
        // echo "nm_usuario: $nome<br>";
        // echo "nm_email: $email<br>";
        // echo "nm_senha: $senha<br>";
        // echo "dt_nascimento: $dt_nascimento<br>";
    
        $stmtUpdateUsuario->execute();

        // $sql_selectResidencia = "SELECT cd_residencia FROM tb_residencia_usuario WHERE cd_usuario = :cd_usuario";
        // $stmtSelectResidencia = $conn->prepare($sql_selectResidencia);
        
        // // Vincule o parâmetro
        // $stmtSelectResidencia->bindValue(":cd_usuario", $cd_usuario);
        
        // // Execute a consulta
        // if ($stmtSelectResidencia->execute()) {
        //     // Obtenha o ID do usuário
        //     $result = $stmtSelectResidencia->fetch(PDO::FETCH_ASSOC);
        //     $cd_residencia = $result['cd_residencia'];
        // } else {
        //     // Trate o erro, se houver
        //     echo "Erro ao executar a consulta.";
        // }

        // $errorInfo = $stmtUpdateUsuario->errorInfo();

        // $sql_update_residencia = "UPDATE tb_residencia 
        // SET cd_cep = :cd_cep,
        // nm_rua = :nm_rua,
        // nm_bairro = :nm_bairro,
        // nm_cidade = :nm_cidade,
        // sg_estado = :sg_estado,
        // cd_numero_casa = :cd_numero_casa
        // WHERE cd_residencia = :cd_residencia";
        // // $affectedRows = $stmtUpdateUsuario->rowCount();

        // $stmtUpdateResidencia = $conn->prepare($sql_update_residencia);

        // $stmtUpdateResidencia->bindValue(":cd_residencia", $cd_residencia);
        // $stmtUpdateResidencia->bindValue(":nm_rua", $rua);
        // $stmtUpdateResidencia->bindValue(":nm_bairro", $bairro);
        // $stmtUpdateResidencia->bindValue(":nm_cidade", $cidade);
        // $stmtUpdateResidencia->bindValue(":sg_estado", $estado);
        // $stmtUpdateResidencia->bindValue(":cd_numero_casa", $numero);

        // $stmtUpdateResidencia->execute();
        // echo "Linhas afetadas: $affectedRows<br>";

        

        // echo "Código do erro: $errorInfo[0]<br>";
        // echo "Código do erro do driver: $errorInfo[1]<br>";
        // echo "Mensagem de erro: $errorInfo[2]<br>";
        
        //Verifica se a atualização foi bem-sucedida
        if ($stmtUpdateUsuario->rowCount() != 0) {
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['data'] = $dt_nascimento;
        } else {
            echo 'Nenhuma alteração feita.';
        }

        // if ($stmtUpdateResidencia->rowCount() != 0) {
        //     $_SESSION['rua'] = $rua;
        //     $_SESSION['bairro'] = $bairro;
        //     $_SESSION['cidade'] = $cidade;
        //     $_SESSION['estado'] = $estado;
        //     $_SESSION['numero'] = $numero;
        // } else {
        //     echo 'Nenhuma alteração feita.';
        // }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Dados do formulário não recebidos corretamente.';
}

header("Location: usuario_dados.php");
// echo "<script>alert('CLIENTE ALTERADO COM SUCESSO');</script>";
?>
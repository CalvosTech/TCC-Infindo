<?php 
    // include 'conexao.php';

    // // // Inicie a sessão (se ainda não estiver iniciada)
    // if (!isset($_SESSION)) {
    //     session_start();
    // }

    // // echo $_SESSION['mensagem'];


    // // Verifica se o nome e o e-mail estão definidos na sessão
    // if (isset($_SESSION['nome'], $_SESSION['email'])) {
    //     // Obtém os dados diretamente da sessão
    //     $nome = $_SESSION['nome'];
    //     $email = $_SESSION['email'];
    //     $cpf = $_SESSION['cpf'];
    //     $data_nasc =  $_SESSION['data'];// Lembre-se de adicionar outras informações conforme necessário

    // } else {
    //     // Se o nome ou o e-mail não estiverem definidos na sessão, redirecione para a página de login
    //     header("Location: login.php");
    //     exit();
    // }

    //     $sql_selectUsuario = "SELECT cd_usuario FROM tb_usuario WHERE nm_email = :nm_email";
    //     $stmtSelectUsuario = $conn->prepare($sql_selectUsuario);

    //     // Vincule o parâmetro
    //     $stmtSelectUsuario->bindValue(":nm_email", $email);

    //     // Execute a consulta
    //     if ($stmtSelectUsuario->execute()) {
    //         // Obtenha o ID do usuário
    //         $result = $stmtSelectUsuario->fetch(PDO::FETCH_ASSOC);
    //         $cd_usuario = $result['cd_usuario'];
    //     } else {
    //         // Trate o erro, se houver
    //         throw new Exception("Erro ao executar a consulta. Detalhes: " . print_r($stmtSelectUsuario->errorInfo(), true));
    //     }

    //     if (!empty($_POST)) {
    //         // Valide e processe os dados do formulário aqui
    //         $cd_cep = $_POST['cd_cep'];
    //         $cd_numero_casa = $_POST['cd_numero_casa'];
    //         $nm_rua = $_POST['ruaCliente'];
    //         $nm_bairro = $_POST['bairroCliente'];
    //         $nm_cidade = $_POST['cidadeCliente'];
    //         $sg_estado = $_POST['ufCliente'];

    //         try {
    //             $stmt_insert_residencia = $conn->prepare("INSERT INTO tb_residencia (cd_cep, nm_rua, nm_bairro, nm_cidade, nm_estado, sg_estado, cd_numero_casa)
    //                 VALUES (:cd_cep, :nm_rua, :nm_bairro, :nm_estado, :sg_estado, :cd_numero_casa)");

    //         $stmt_insert_residencia->bindParam(':cd_cep', $cd_cep);
    //         $stmt_insert_residencia->bindParam(':nm_rua', $nm_rua);
    //         $stmt_insert_residencia->bindParam(':nm_bairro', $nm_bairro);
    //         $stmt_insert_residencia->bindParam(':nm_cidade', $nm_cidade);
    //         $stmt_insert_residencia->bindParam(':sg_estado', $sg_estado);
    //         $stmt_insert_residencia->bindParam(':cd_numero_casa', $cd_numero_casa);

    //         $stmt_insert_residencia->execute();
    //     }catch (PDOException $e) {
    //         echo "Erro ao cadastrar: " . $e->getMessage();
    //     }

    //     $cd_residencia = $conn->lastInsertId();

    //             try {
    //                 $stmt_insert_residencia_usuario = $conn->prepare("INSERT INTO tb_residencia_usuario (cd_residencia, cd_usuario)
    //                     VALUES (:cd_residencia, :cd_usuario)");
    //                 $stmt_insert_residencia_usuario->bindParam(':cd_residencia', $cd_residencia);
    //                 $stmt_insert_residencia_usuario->bindParam(':cd_usuario', $cd_usuario);

    //                 $stmt_insert_residencia_usuario->execute();
    //             } catch (PDOException $e) {
    //             echo "Erro ao cadastrar: " . $e->getMessage();
    //         }
    //     }

    //     header("Location: usuario_dados.php");
    //     exit();

    include 'conexao.php';

// Inicie a sessão (se ainda não estiver iniciada)
if (!isset($_SESSION)) {
    session_start();
}

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

try {
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
        throw new Exception("Erro ao executar a consulta. Detalhes: " . print_r($stmtSelectUsuario->errorInfo(), true));
    }

    if (!empty($_POST)) {
        // Valide e processe os dados do formulário aqui
        $cd_cep = $_POST['cd_cep'];
        $cd_numero_casa = $_POST['cd_numero_casa'];
        $nm_rua = $_POST['ruaCliente'];
        $nm_bairro = $_POST['bairroCliente'];
        $nm_cidade = $_POST['cidadeCliente'];
        $sg_estado = $_POST['ufCliente'];

        $stmt_insert_residencia = $conn->prepare("INSERT INTO tb_residencia (cd_cep, nm_rua, nm_bairro, nm_cidade, sg_estado, cd_numero_casa)
            VALUES (:cd_cep, :nm_rua, :nm_bairro, :nm_cidade, :sg_estado, :cd_numero_casa)");

        $stmt_insert_residencia->bindParam(':cd_cep', $cd_cep);
        $stmt_insert_residencia->bindParam(':nm_rua', $nm_rua);
        $stmt_insert_residencia->bindParam(':nm_bairro', $nm_bairro);
        $stmt_insert_residencia->bindParam(':nm_cidade', $nm_cidade);
        $stmt_insert_residencia->bindParam(':sg_estado', $sg_estado);
        $stmt_insert_residencia->bindParam(':cd_numero_casa', $cd_numero_casa);

        $stmt_insert_residencia->execute();

        $cd_residencia = $conn->lastInsertId();

        $stmt_insert_residencia_usuario = $conn->prepare("INSERT INTO tb_residencia_usuario (cd_residencia, cd_usuario)
            VALUES (:cd_residencia, :cd_usuario)");
        $stmt_insert_residencia_usuario->bindParam(':cd_residencia', $cd_residencia);
        $stmt_insert_residencia_usuario->bindParam(':cd_usuario', $cd_usuario);

        $stmt_insert_residencia_usuario->execute();
    }

    header("Location: usuario_dados.php");
    exit();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
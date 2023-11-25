<?php
include("conexao.php");

// Inicie a sessão (se ainda não estiver iniciada)
if (!isset($_SESSION)) {
    session_start();
}

// Verifique se o e-mail está definido na sessão
if (isset($_SESSION['email'])) {
    //Consultar as informações do usuário cadastrado
    $email = $_SESSION['email'];

    try {
        $sql = "SELECT * FROM tb_usuario WHERE nm_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        // Verifique se há pelo menos uma linha retornada
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Defina as variáveis de sessão
            $_SESSION['nome'] = $row['nm_usuario'];
            $_SESSION['cpf'] = $row['cd_cpf'];
            $_SESSION['data'] = $row['dt_nascimento'];
            // Não é aconselhável armazenar a senha na sessão por motivos de segurança

            // Redirecione para a página de dados do usuário
            header("Location: usuario_dados.php");
            exit(); // É importante encerrar a execução após o redirecionamento
        } else {
            // Usuário não encontrado, redirecione para a página de login
            echo "<script>('Usuário não encontrado')</script>";
            header("Location: infindo.php");
            exit();
        }
    } catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
} else {
    // Se o e-mail não estiver definido na sessão, redirecione para a página de login
    // echo "<script>('Usuário não encontrado')</script>";
    header("Location: infindo.php");
    exit();
}
?>
<?php
// Inclua o arquivo de conexão
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login_nm_email'];
    $senha = $_POST['login_nm_senha'];

    try {
        // Consulta o banco de dados para obter a senha do usuário
        $sql = "SELECT nm_senha FROM tb_usuario WHERE nm_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $senha_hash = $row['nm_senha'];

            // Verifica se a senha fornecida coincide com a senha armazenada no banco de dados
            if (password_verify($senha, $senha_hash)) {
                // Inicia a sessão e define variáveis de sessão, se necessário
                session_start();
                $_SESSION['email'] = $email;

                // Redireciona para a página de dados do usuário ou outra página
                header("Location: infindo.php");
                // exit();
            } else {
                echo "<script>alert('Senha incorreta')</script>";
                header('Location: login.php');
                exit();
            }
        } else {
            echo "<script>alert('Usuário nao encontrado')</script>";
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se não for uma solicitação POST, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>
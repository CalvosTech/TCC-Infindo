<?php 
include "conexao.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_usuario.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link href="imagens/logo.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/s/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Stylesheet -->
    <link href="css/style-contato.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
    </a>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Poppins:ital,wght@0,400;0,500;1,300;1,400;1,500&family=Titillium+Web:ital,wght@0,200;0,300;1,200&display=swap" rel="stylesheet">
<link rel="stylesheet" href="pedido.css">
        
</head>
<body>

<section class="container_usuario">

    <div class="ola">
        <h1 style="font-size: 22px; font-weight: 700;">Olá <?php echo $_SESSION['nome']; ?></h1>
    </div>

    <div class="colunas">
        <div class="conteudo"><a href="">Pedidos</a></div>
        <div class="conteudo"><a href="usuario_dados.php">Dados</a></div>
         <button onclick="window.location.href='sair.php'"><img class='img_sair' src="imagens/sair.png" alt="imgsair"></button>
    </div>

    <div class="caixa_grande">
        <h2 class="titulo-pedidos">Meus Pedidos</h2>
        <?php
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

            try {
                $sql = "SELECT 
                            p.nm_produto, 
                            p.ds_produto, 
                            p.vl_preco, 
                            tp.nm_tipo, 
                            p.im_foto_produto
                        FROM 
                            tb_produto p
                        JOIN 
                            tb_tipo tp ON p.cd_tipo = tp.cd_tipo
                        JOIN 
                            tb_item_pedido ip ON p.cd_produto = ip.cd_produto
                        JOIN 
                            tb_pedido pd ON ip.cd_pedido = pd.cd_pedido
                        WHERE 
                            pd.cd_usuario = :cd_usuario";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cd_usuario', $cd_usuario);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                    foreach ($result as $produto) {
                        echo "<div class='produto'>";
                        // Exibir a foto do produto se estiver presente
                        if (!empty($produto['im_foto_produto'])) {
                            echo "<img src='" . $produto['im_foto_produto'] . "' alt='Foto do Produto' class='caixa_pedido'>";
                        } else {
                            echo "Nenhuma foto disponível para este produto.<br>";
                        }

                        // Descrição dos pedidos ao lado da imagem
                        echo "<div class='descricao_pedido'>";
                        echo "<p class='nome-produto info-grande'>Nome do Produto: " . $produto['nm_produto'] . "</p>";
                        echo "<p class='preco info-grande'>Preço: $" . $produto['vl_preco'] . "</p>";
                        echo "<p class='tipo info-grande'>Tipo: " . $produto['nm_tipo'] . "</p>";
                        echo "</div>";

                        echo "<div style='clear: both;'></div>"; // Limpar o float para evitar problemas de layout
                        echo "</div><hr>"; // Adicionei uma linha horizontal para separar os produtos
                    }
                } else {
                    echo "<p class='sem-produtos'>Nenhum produto encontrado para este usuário.</p>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        ?>
    </div>
</section>
  

<!-- ***** Header Area começo ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <nav class="main-nav">
                    <!-- ***** Logo começo ***** -->
                    <a href="infindo.php" class="logo">
                        <img src="assets/images/logo.png"
                            style="width: 86px;
                    height: 89px;filter: brightness(0.0)">
                    </a>
                    <!-- ***** Logo final ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a
                                href="infindo.php">Inicio</a></li>
                        <li class="scroll-to-section"><a
                                href="products.php">Produtos</a></li>
                        <li class="scroll-to-section"><a
                                href="infindo.php">Sobre Nós</a></li>
                        <li class="scroll-to-section"><a
                                href="contact.html">Contato</a></li>
                                <?php 
                         if(!isset($_SESSION['email'])){ 
                            ?>
                            <li class="scroll-to-section"><a class="cd-signin" href="#0">Cadastro</a></li>
                        <?php 
                         }
                        ?>

                        <?php 
                        if(isset($_SESSION['email'])){ 
                            
                        ?>
                            <li class="scroll-to-section"><a href="usuario_dados.php">Perfil</a></li>
                        <?php 
                            }  
                        ?>
                                <li class="scroll-to-section">
                        <div class="cart-mainf">
                            <div class="hubcart hubcart2 cart cart box_1">
                                <form action="#" method="post">
                                    <input type="hidden" name="cmd" value="_cart">
                                    <input type="hidden" name="display" value="1">
                                    <button class="btn top_hub_cart mt-1" type="submit" name="submit" value="" title="Cart">
                                        <i class="fas fa-shopping-bag" style="
                                        font-size: 1.5em;
                                        color: #7d88c1;
                                        /* padding-bottom: -67px; */
                                        /* margin-bottom: 20px; */
                                    "></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu fim ***** -->

                </nav>

            </div>
        </div>
    </div>
</header>

<!-- abre aqui estevan-->

<!-- MODAL CADASTRO -->

<div class="cd-user-modal">
    <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container">
        <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Login</a></li>
            <li><a href="#0">Cadastre-se</a></li>
        </ul>

        <div id="cd-login"> <!-- log in form -->
            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email"
                        for="signin-email">E-mail</label>
                    <input class="full-width has-padding has-border"
                        id="signin-email" type="email"
                        placeholder="E-mail">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password"
                        for="signin-password">Senha</label>
                    <input class="full-width has-padding has-border"
                        id="signin-password" type="text"
                        placeholder="Senha">
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="Lembre de mim" checked>
                    <label for="lembre de mim">lembre de mim</label>
                </p>
                <p class="fieldset">
                    <input class="full-width" type="submit"
                        value="Log-in">
                </p>
            </form>

            <p class="cd-form-bottom-message"><a href="#0">Esqueceu sua
                    senha?</a></p>
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-username"
                        for="signup-username">Nome de usuario</label>
                    <input class="full-width has-padding has-border"
                        id="signup-username" type="text"
                        placeholder="Nome de usuario">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email"
                        for="signup-email">E-mail</label>
                    <input class="full-width has-padding has-border"
                        id="signup-email" type="email"
                        placeholder="E-mail">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password"
                        for="signup-password">Senha</label>
                    <input class="full-width has-padding has-border"
                        id="signup-password" type="text"
                        placeholder="Senha">
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password"
                        for="signup-confirm-password">Confirmar senha</label>
                    <input class="full-width has-padding has-border"
                        id="signup-confirm-password" type="password"
                        placeholder="Confirmar senha" required>
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-cpf" for="signup-cpf">CPF</label>
                    <input class="full-width has-padding has-border"
                        id="signup-cpf" type="text" placeholder="CPF"
                        required>
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-telefone"
                        for="signup-telefone">Telefone</label>
                    <input class="full-width has-padding has-border"
                        id="signup-telefone" type="text"
                        placeholder="Telefone">
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-data-nascimento"
                        for="signup-data-nascimento">Data de Nascimento</label>
                    <input class="full-width has-padding has-border"
                        id="signup-data-nascimento" type="date"
                        placeholder="Data de Nascimento">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="accept-terms">
                    <label for="accept-terms">Eu concordo com os <a
                            href="#0" style="
                        color: #2f889a;
                    ">Termos</a></label>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit"
                        value="Criar conta">
                </p>
            </form>

            <a href="#0" class="cd-close-form">Fechar</a>
        </div> <!-- cd-signup -->

        <div id="cd-reset-password"> <!-- reset password form -->
            <p class="cd-form-message">Perdeu sua senha? Por favor
                ensira seu endereço de email. Você recebera um link para
                criar uma nova senha.</p>

            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email"
                        for="reset-email">E-mail</label>
                    <input class="full-width has-padding has-border"
                        id="reset-email" type="email"
                        placeholder="E-mail">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit"
                        value="Reset password">
                </p>
            </form>

            <p class="cd-form-bottom-message"><a href="#0">Voltar ao
                    Log-in</a></p>
        </div> <!-- cd-reset-password -->
        <a href="#0" class="cd-close-form">Fechar</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->











<!-- ***** Footer Start ***** -->
<section class="Contato" id="Contato">
    <div class="meio-contato">
        <h3>Estamparia <br> Infindo</h3>
        <h5>R. Cecy, 320 - Guilhermina, Praia Grande - SP, CEP
            11701-560</h5>
        <div class="icons">
            <a href="#"><i class='bx bxl-facebook-square'></i></a>
            <a href="#"><i class='bx bxl-instagram-alt'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
        </div>
    </div>

    <div class="meio-contato">
        <h3>Explore</h3>
        <li><a href="#Home">Inicio</a></li>
        <li><a href="#featured">Produtos</a></li>
        <li><a href="#new">Sobre Nós</a></li>
        <li><a href="#contact">Contato</a></li>
    </div>

    <div class="meio-contato">
        <h3>Tecidos</h3>
        <li><a href="#">Poliester</a></li>
        <li><a href="#">Dry-fit</a></li>
        <li><a href="#">Algodão</a></li>
        <!-- <li><a href="#">Nova coleção</a></li>
<li><a href="#">Canecas</a></li> -->
    </div>

<!-- MODAL CADASTRO FIM -->

<!-- abre aqui estevan-->

<!-- java-script do modal (jquery)-->

<script>
    jQuery(document).ready(function($) {
    var $form_modal = $('.cd-user-modal'),
        $form_login = $form_modal.find('#cd-login'),
        $form_signup = $form_modal.find('#cd-signup'),
        $form_forgot_password = $form_modal.find('#cd-reset-password'),
        $form_modal_tab = $('.cd-switcher'),
        $tab_login = $form_modal_tab.children('li').eq(0).children('a'),
        $tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
        $forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
        $back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
        $main_nav = $('.main-nav');

    // Abre Modal
    $main_nav.on('click', function(event) {
    if ($(event.target).is('.cd-signin')) {
        // Abre apenas se o item clicado não for o de cadastro
        event.preventDefault();
        $form_modal.addClass('is-visible');
        login_selected();
    } else if ($(event.target).is($main_nav)) {
        // No mobile abre o submenu
        $(this).children('ul').toggleClass('is-visible');
    } else {
        // No mobile fecha o submenu
        $main_nav.children('ul').removeClass('is-visible');
    }
});

    // fecha modal
    $('.cd-user-modal').on('click', function(event) {
        if ($(event.target).is($form_modal) || $(event.target).is('.cd-close-form')) {
            $form_modal.removeClass('is-visible');
        }
    });
    // fecha o modal quando clicka esc
    $(document).keyup(function(event) {
        if (event.which == '27') {
            $form_modal.removeClass('is-visible');
        }
    });

    // Muda de uma aba pra outra
    $form_modal_tab.on('click', function(event) {
        event.preventDefault();
        ($(event.target).is($tab_login)) ? login_selected(): signup_selected();
    });

    // Esconde ou mostra sua senha
    $('.hide-password').on('click', function() {
        var $this = $(this),
            $password_field = $this.prev('input');

        ($password_field.attr('type') == 'password') ? $password_field.attr('type', 'text'): $password_field.attr('type', 'password');
        ($this.text() == 'Esconder') ? $this.text('Mostrar'): $this.text('Esconder');
        // focus and move cursor to the end of input field
        $password_field.putCursorAtEnd();
    });

    // mostra o form esqueci minha senha
    $forgot_password_link.on('click', function(event) {
        event.preventDefault();
        forgot_password_selected();
    });

    // volta pro login do form esqueci minha senha
    $back_to_login_link.on('click', function(event) {
        event.preventDefault();
        login_selected();
    });

    function login_selected() {
        $form_login.addClass('is-selected');
        $form_signup.removeClass('is-selected');
        $form_forgot_password.removeClass('is-selected');
        $tab_login.addClass('selected');
        $tab_signup.removeClass('selected');
    }

    function signup_selected() {
        $form_login.removeClass('is-selected');
        $form_signup.addClass('is-selected');
        $form_forgot_password.removeClass('is-selected');
        $tab_login.removeClass('selected');
        $tab_signup.addClass('selected');
    }

    function forgot_password_selected() {
        $form_login.removeClass('is-selected');
        $form_signup.removeClass('is-selected');
        $form_forgot_password.addClass('is-selected');
    }

    // Verifica se o email é válido
    $('#signup-email').on('input', function() {
        var email = $(this).val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailRegex.test(email)) {
            $(this).next('.cd-error-message').removeClass('is-visible').text('');
        } else {
            $(this).next('.cd-error-message').addClass('is-visible').text('Por favor, insira um email válido');
        }
    });

    // Verifica se as senhas coincidem
    $form_signup.find('input[type="submit"]').on('click', function(event){
        event.preventDefault();
        var $password_input = $form_signup.find('#signup-password');
        var $confirm_password_input = $form_signup.find('#signup-confirm-password');
        var password = $password_input.val();
        var confirm_password = $confirm_password_input.val();

        if (password !== confirm_password) {
            $confirm_password_input.addClass('has-error').next('span').addClass('is-visible').text('As senhas não coincidem');
        } else {
            $confirm_password_input.removeClass('has-error').next('span').removeClass('is-visible').text('');
            // Aqui você pode adicionar o código para enviar o formulário
        }
    });
});
</script>

<!-- java-script do modal (jquery)-->

<!-- ***** Header Area final ***** -->

</body>
</html>
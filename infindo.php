<?php
//Inclua o banco de dados
include 'banco_infindo.php';

// Inclua o arquivo de conexão
include 'conexao.php';
$im_usuario = "imagens/imagem_perfil.png";

if (!empty($_POST)) {
    // Valide e processe os dados do formulário aqui
    $nm_usuario = $_POST['nm_usuario'];
    $nm_email = $_POST['nm_email'];
    $nm_senha = $_POST['nm_senha'];
    $cd_cpf = $_POST['cd_cpf'];
    $cd_telefone = $_POST['cd_telefone'];
    $dt_nascimento = $_POST['dt_nascimento'];

    try {
        // Validar cadastro por email;
        $sql = "SELECT cd_usuario FROM tb_usuario WHERE nm_email = :nm_email";
        $stmt_email_check = $conn->prepare($sql);
        $stmt_email_check->bindValue(":nm_email", $nm_email);
        $stmt_email_check->execute();

        if ($stmt_email_check->rowCount() != 0) {
            echo "<script>alert('Este e-mail já está cadastrado');</script>";
            // Redirecionar ou mostrar mensagem apropriada
        } else {
            try {
                // Use prepared statement diferente para a inserção
                $stmt_insert = $conn->prepare("INSERT INTO tb_usuario (nm_usuario, nm_email, nm_senha, cd_cpf, cd_telefone, dt_nascimento)
                    VALUES (:nm_usuario, :nm_email, :nm_senha, :cd_cpf, :cd_telefone, :dt_nascimento)");

                // Hash para a senha
                $hashed_password = password_hash($nm_senha, PASSWORD_DEFAULT);

                $stmt_insert->bindParam(':nm_usuario', $nm_usuario);
                $stmt_insert->bindParam(':nm_email', $nm_email);
                $stmt_insert->bindParam(':nm_senha', $hashed_password);
                $stmt_insert->bindParam(':cd_cpf', $cd_cpf);
                $stmt_insert->bindParam(':cd_telefone', $cd_telefone);
                $stmt_insert->bindParam(':dt_nascimento', $dt_nascimento);

                $stmt_insert->execute();

                // Redireciona o usuário para uma página de confirmação ou login
                $_SESSION['email'] = $nm_email;
                // header("Location: login.php");
            } catch (PDOException $e) {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFINDO</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link
    href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="js/validaCPF.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
<!-- Additional CSS Files -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!-- Favicon -->
 <link href="imagens/logo.ico" rel="icon">

 <!-- Google Web Fonts -->
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

 <!-- Font Awesome -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

 <!-- Libraries Stylesheet -->
 <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->

 <!-- Customized Stylesheet -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://www.whatsapp.com/" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
    
   
</head>
<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->























<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="infindo.php" class="logo">
                        <img src="imagens/logo.png" style="width: 86px;
                        height: 89px;filter: brightness(0.0)">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="infindo.php">Inicio</a></li>
                        <li class="scroll-to-section"><a href="products.php">Produtos</a></li>
                        <li class="scroll-to-section"><a href="index.html">Sobre Nós</a></li>
                        <li class="scroll-to-section"><a href="contact.php">Contato</a></li>
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
                                        cursor: pointer;
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
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>































<!-- abre aqui estevan-->

<!-- MODAL CADASTRO -->
<?php 

    //if(!isset($_SESSION)){ 
    
?>

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Login</a></li>
            <li><a href="#0">Cadastre-se</a></li>
        </ul>

        <div id="cd-login"> <!-- log in form -->
            <form class="cd-form" action="entrar.php" autocomplete="off" method='post'>
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email" >E-mail</label>
                    <input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail" name="login_nm_email" required>
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Senha</label>
                    <input class="full-width has-padding has-border" id="signin-password" type="text"  placeholder="Senha" name="login_nm_senha" required>
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="Lembre de mim" checked>
                    <label for="lembre de mim">lembre de mim</label>
                </p>

                <p class="fieldset">
                    <input class="full-width" type="submit" value="Log-in">
                </p>
            </form>
            
            <p class="cd-form-bottom-message"><a href="#0">Esqueceu sua senha?</a></p>
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
            <form class="cd-form" action="#" method="post">
                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-username" name="nm_usuario">Nome de usuario</label>
                    <input class="full-width has-padding has-border" id="signup-username" type="text"  name="nm_usuario" placeholder="Nome de usuario">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email" name="nm_email">E-mail</label>
                    <input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail" name="nm_email">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password" name="nm_senha">Senha</label>
                    <input class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Senha" name="nm_senha">
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-confirm-password">Confirmar senha</label>
                    <input class="full-width has-padding has-border" id="signup-confirm-password" type="password" placeholder="Confirmar senha" required>
                    <a href="#0" class="hide-password">Esconder</a>
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-cpf" for="signup-cpf" name="cd_cpf">CPF</label>
                    <input class="full-width has-padding has-border" id="signup-cpf" type="text" name="cd_cpf" onblur="TestaCPF(this.value);" placeholder="CPF" required >
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-telefone" for="signup-telefone" name="cd_telefone">Telefone</label>
                    <input class="full-width has-padding has-border" id="signup-telefone" type="text" name="cd_telefone" placeholder="Telefone">
                    <span class="cd-error-message">Erro</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-data-nascimento" for="signup-data-nascimento" name="dt_nascimento">Data de Nascimento</label>
                    <input class="full-width has-padding has-border" id="signup-data-nascimento" type="date" name="dt_nascimento" placeholder="Data de Nascimento" required>
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="accept-terms">
                    <label for="accept-terms">Eu concordo com os <a href="#0" style="
                        color: #2f889a;
                    ">Termos</a></label>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Criar conta">
                </p>
            </form>

            <a href="#0" class="cd-close-form">Fechar</a>
        </div> <!-- cd-signup -->

        <div id="cd-reset-password"> <!-- reset password form -->
            <p class="cd-form-message">Perdeu sua senha? Por favor ensira seu endereço de email. Você recebera um link para criar uma nova senha.</p>

            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="reset-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Erro</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Reset password">
                </p>
            </form>

            <p class="cd-form-bottom-message"><a href="#0">Voltar ao Log-in</a></p>
        </div> <!-- cd-reset-password -->
        <a href="#0" class="cd-close-form">Fechar</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->
<?php 
 //}
 ?>

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
    $form_signup.find('form').on('submit', function(event) {
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
        // Por exemplo:
        $(this).unbind('submit').submit(); // Isso envia o formulário
    }
});

});
</script>


<!-- java-script do modal (jquery)-->




    <!-- <nav>
        
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <div class="menu-btn">
            <div class=btn-line></div>
            <div class=btn-line></div>
            <div class=btn-line></div>
        </div>
        </label>


        <img src="imagens/logo.png" class="logo" alt="logotipo">
            <ul class="nav-links">
                <li><a  href="#">Inicio</a></li>
                <li><a class="produtos" href="#" >Produtos</a></li>
                <li><a class="sobre" href="#" >sobre nós</a></li>
                <li><a class="cadastro" href="#" >cadastro</a></li>    
            </ul>
                
                    
    </nav> -->

        
        
        
           


    
        <main class="center">
           
            <br><br><br><br><br><br><br>
            <div class="texto-principal">
                <h2 style="font-size: 60px;
                "> NOVOS MODELOS </h2> <h3 style="font-size: 50px;">DE CAMISETAS </h3>
                <p>Novas cores, tamanhos e diversas estampas <br><b style="font-size: 30px;">com o seu gosto</b></p>
            
            <div class="container5">
            <div class="nova-coleção">
                <a href="#" target="_self">Nova Coleção</a>
            </div>
            <img class="seta" src="imagens/seta.png" alt="seta">
            </div>
            
            <div>
        </div>

            </div>
        </div>


            <div class="slogan1">  
                    <img src="imagens/camiseta.png" alt="slogan">
            </div>

        </main>




        <div class="destaques-texto">
            <h1 style="/* font-family: 'minhafonte', 'Helvetica Neue', sans-serif; */font-size: 4vh;font-weight: 600;font-family: 'Poppins', sans-serif;/* font-family: p; */">Produtos pré-estampados</h1>
        </div>
        <div class="subtexto-destaque">
        <p>Clique para conferir detalhes sobre os produtos.</p>
        </div>

        <div class="card-container">
            <div class="card">
            <a href="single_products/single-product7.php"><img src="imagens/caneca_abrigo1.jpg" alt="Estampa"></a> 
            <a href="single_products/single-product7.php"><p>Caneca porcelana branca flork</p></a>
            <ul class="rating">
                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
            </ul>
            </div>
            <div class="card">
            <a href="single_products/single-product8.php"><img src="imagens/caneca_casa_comigo_2.jpg" alt="Estampa"></a>
            <a href="single_products/single-product8.php"> <p>Caneca porcelana branca, "Casa comigo?"</p></a>
            <div class="lek">
                <div class="rating">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </div>
              </div>
            </div>
            <div class="card">
                <a href="single_products/single-product9.php"><img src="imagens/caneca_mickey3.jpg" alt="Estampa"></a> 
                <a href="single_products/single-product9.php"><p>Caneca porcelana branca, Mickey e Minie</p></a>
                <div class="rating">
                    <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                  </div>
                </div>
                <div class="card">
                    <a href="single_products/single-product10.php"><img src="imagens/barbie1.jpg" alt="Estampa"></a> 
                    <a href="single_products/single-product10.php"><p>Caneca porcelana glitter e alsa rosa, Barbie</p></a>
                    <div class="rating">
                        <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                      </div>
                    </div>
                    <div class="card">
                        <a href=""><img src="imagens/barbie2.jpg" alt="Estampa"></a> 
                        <a href="#"><p>Caneca porcelana branca, Barbie</p></a>
                        <div class="rating">
                            <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                          </div>
                        </div>
                        <div class="card">
                            <a href="single_products/single-product11.php"><img src="imagens/barbie3.jpg" alt="Estampa"></a> 
                            <a href="single_products/single-product11.php"><p>Caneca porcelana glitter e alsa rosa, Barbie</p></a>
                            <div class="rating">
                                <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                              </div>
                                </div>
                
          </div>

<br>
<br>
<br>
<br>
<br>
<br>



          <!-- <hr class="linha1" aria-hidden="true"> -->
          
<div class="centro2">
    <div class="aaaaaa"></div>
<br> 
<br>
<br>





<div class="pedir">
    <h1>Como pedir seu produto estampado</h1>
</div>







<section class="how">
          <div class="montagem">
            <div class="background"></div>
            <div class="content">
                <span class="number">1.</span>
            <p class="text">
                Fale pelo Whatsapp
            </p>
            </div>
            <div class="texto-adicional">
                Escolha entre uma das opções de modelos, tamanhos e cores.
            </div>
        </div>






        <div class="montagem">
            <div class="background"></div>
            <div class="content">
                <span class="number">2.</span>
            <p class="text">
                Solicite seu orçamento
            </p>
            </div>
            <div class="texto-adicional2">
               Informe produto e quantidade.
            </div>
        </div>
             


        <div class="montagem">
            <div class="background"></div>
            <div class="content">
                <span class="number">3.</span>
            <p class="text">
                Desenvolvemos sua arte
            </p>
            </div>
            <div class="texto-adicional3">
                Daremos todo suporte na criação.
            </div>
        </div>

        <div class="montagem">
            <div class="background"></div>
            <div class="content">
                <span class="number">4.</span>
            <p class="text">
               Finalize seu pedido
            </p>
            </div>
            <div class="texto-adicional3">
                Escolha a forma de pagamento e concretize seu pedido.
            </div>
        </div>
 </section>
</div>
<!-- <br>
<br>
<br>
<br>
<br>
<br>
<br> -->
<!-- <hr class="linha1"> -->

            
            













            <!-- <div class="box1"><h2 class="1">1</h2><h1> Monte sua estampa</h1></div>
            <h1 class="box2">aaaaaaaaaa</h1>
            <h1 class="box3">aaaaaaaaaa</h1>
          </section>
        -->
       
            
            
            
            <!--roupa-->


           <!-- <div class="roupa">
            <img src="imagens/tren2.jpg" alt="">
           <p>Lorem Ipsum dizgi</p>
           <h5>$188</h5>
           <span><ion-icon name="cart-outline"></ion-icon></span>
       </div>roupa -->
<!-- 
       <div class="roupa">
        <img src="imagens/tren3.jpg" alt="">
       <p>Lorem Ipsum dizgi</p>
       <h5>$188</h5>
       <ion-icon name="cart-outline"></ion-icon>
    </div>roupa-->

   <!--<div class="roupa">
     <img src="imagens/tren4.jpg" alt="">
    <p>Lorem Ipsum dizgi</p>
    <h5>$188</h5><ion-icon name="cart-outline"></ion-icon>
  </div>roupa
 </div>container-roupas
    </section> -->






    <div class="destaques-texto">
        <h1 style="/* font-family: 'minhafonte', 'Helvetica Neue', sans-serif; */font-size: 4vh;font-weight: 600;font-family: 'Poppins', sans-serif;/* font-family: p; */">Produtos estampáveis</h1>
    </div>
    <div class="subtexto-destaque">
    <p>Confira nossos produtos e estampe do seu jeito</p>
    </div>

    <div class="card-container">
        <div class="card">
        <a href="single_products/single-product.php"><img src="imagens/roupa1.jpg" alt="Estampa"></a> 
        <a href="single_products/single-product.php"><p>Camiseta básica macia unissex</p></a>
        <ul class="rating">
            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
        </ul>
          <div class="colors">
            <div class="color blue"></div>
            <div class="color black"></div>
            <div class="color white"></div>
          </div>
        </div>
        <div class="card">
        <a href="single_products/single-product2.php"><img src="imagens/tren2.jpg" alt="Estampa"></a>
        <a href="single_products/single-product2.php"> <p>Camiseta modelagem reta masculina</p></a>
        <div class="lek">
            <div class="rating">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
            </div>
          </div>
          <div class="colors">
            <div class="color blue"></div>
            <div class="color black"></div>
            <div class="color red"></div>
            <div class="color light"></div>
            <div class="color orange"></div>
            <div class="color white"></div>

          </div>
        </div>
        <div class="card">
            <a href="single_products/single-product3.php"><img src="imagens/sueter.png" alt="Estampa"></a> 
            <a href="single_products/single-product3.php"><p>Camiseta tri-blend unissex</p></a>
            <div class="rating">
                <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
              </div>
              <div class="colors">
                <div class="color blue"></div>
                <div class="color grey"></div>
              </div>
            </div>
            <div class="card">
                <a href="single_products/single-product4.php"><img src="assets/images/women-02.jpg"Estampa"></a> 
                <a href="single_products/single-product4.php"><p>Caneca de cerâmica</p></a>
                <div class="rating">
                    <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                  </div>
                  <div class="colors">
                    <div class="color white"></div>
                  </div>
                </div>
                <div class="card">
                    <a href="single_products/single-product5.php"><img src="assets/images/porcelana.png" alt="Estampa"></a> 
                    <a href="single_products/single-product5.php"><p>Caneca de porcelana</p></a>
                    <div class="rating">
                        <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                      </div>
                      <div class="colors">
                        <div class="color white"></div>
                      </div>
                    </div>
                    <div class="card">
                        <a href=""><img src="assets/images/plastico.jpg" alt="Estampa"></a> 
                        <a href="#"><p>Caneca de plástico</p></a>
                        <div class="rating">
                            <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                          </div>
                          <div class="colors">
                            <div class="color white"></div>
                          </div>
                        </div>
      </div>





































     <!-- <div class="destaques">
        <div class="flip-card-container">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="title">CANECAS</p>
                            <img class="card1" src="imagens/caneca.png" alt="">
                        </div>
                        <div class="flip-card-back">
                            <p class="title">BACK</p>
                            <p>Leave Me</p>
                        </div>
                    </div>
                </div>
                
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <p class="title">CAMISETAS</p>
                            <img class="card1" src="imagens/caneca.png" alt="">
                        </div>
                        <div class="flip-card-back">
                            <p class="title">BACK</p>
                            <p>Leave Me</p>
                        </div>
                    </div>
                </div> -->


                <!-- <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <p class="title">FLIP CARD</p>
                                <img class="card1" src="imagens/camiseta.jpg" alt="">
                            </div>
                            <div class="flip-card-back">
                                <p class="title">BACK</p>
                                <p>Leave Me</p>
                            </div> -->
     
    <section class="Contato" id="Contato">
		<div class="meio-contato">
			<h3>Estamparia <br> Infindo</h3>
			<h5>R. Cecy, 320 - Guilhermina, Praia Grande - SP, CEP 11701-560</h5>
			<div class="icons">
				<a href="#"><i class='bx bxl-facebook-square' ></i></a>
				<a href="#"><i class='bx bxl-instagram-alt' ></i></a>
				<a href="#"><i class='bx bxl-twitter' ></i></a>
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

		<div class="meio-contato">
			<h3>Shopping</h3>
			<li><a href="#">Camisetas</a></li>
			<li><a href="#">Canecas</a></li>
			<!-- <li><a href="#">Sale</a></li> -->
		</div>

	</section>

	<div class="last-text">
		<p>Copyright © 2023 Infindo Sports Ecommerce</p>
	</div>





<!-- Back to Top -->
<!-- <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a> -->






<!-- jQuery -->
<script src="js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="js/owl-carousel.js"></script>
<script src="js/accordions.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/scrollreveal.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/imgfix.min.js"></script> 
<script src="js/slick.js"></script> 
<script src="js/lightbox.js"></script> 
<script src="js/isotope.js"></script> 

<!-- Global Init -->
<script src="js/custom.js"></script>

<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
        selectedClass = $(this).attr("data-rel");
        $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
        setTimeout(function() {
          $("."+selectedClass).fadeIn();
          $("#portfolio").fadeTo(50, 1);
        }, 500);
            
        });
    });

</script>








<!-- <link href="css/style-contato.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
    </a>





<!-- shop css -->
<link href="css/shop.css" type="text/css" rel="stylesheet" media="all">




<!-- cart-js -->
<script src="js/minicart.js"></script>
<script>
    hub.render();

    hub.cart.on('new_checkout', function (evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
            items = this.items();

            for (i = 0, len = items.length; i < len; i++) {}
        }
    });
</script>
<!-- //cart-js -->
<!-- price range (top products) -->
<script src="js/jquery-ui.js"></script>
<script>
    //<![CDATA[ 
    $(window).load(function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 9000,
            values: [50, 6000],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider(
            "values", 1));

    }); //]]>
</script>
<!-- //price range (top products) -->
<script src="js/bootstrap.js"></script>
<!-- start-smoth-scrolling -->
































</body>
</html>



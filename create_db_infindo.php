<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastro do banco de dados</title>
</head>
<body>
<?php
// session_start();

$servername = "localhost:3306";
$username = "root";
$password = "";

// include_once("conexao.php");

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $database = "create database if not exists db_infindo";
    // criando a database
    $conn->exec($database);
    echo "Banco de Dados criado com sucesso!<br><br>";

    $sql_use = "use db_infindo";
    $conn->exec($sql_use);
    // mostrando em qual database deve ser criada as tabelas a seguir
    echo "Utilizando o Banco de Dados db_infindo com sucesso!<br>";

    // $sql_createEstadoUsuario = "create table if not exists tb_estado_usuario
    // (
    // cd_estado int not null auto_increment,
    // sg_estado char(2) not null,
    // constraint pk_estado_usuario
    //     primary key (cd_estado)
    // )
    //     engine InnoDB";
    // $conn->exec($sql_createEstadoUsuario);
    // // tabela que armazena informações sobre o estado em que o usuário mora
    // echo "Tabela Estado Usuário criada com sucesso!<br>";

    // $sql_createCidadeUsuario = "create table if not exists tb_cidade_usuario
    // (
    // cd_cidade int not null auto_increment,
    // nm_cidade char(2) not null,
    // cd_estado int not null,
    // constraint pk_cidade_usuario
	//     primary key (cd_cidade),
    // constraint fk_cidade_usuario_estado_usuario
	//     foreign key (cd_estado)
	// 	    references tb_estado_usuario(cd_estado)
    // )
    //     engine InnoDB";
    // $conn->exec($sql_createCidadeUsuario);
    // // tabela que armazena informações sobre a cidade em que o usuário mora
    // echo "Tabela Cidade Usuário criada com sucesso!<br>";

    // $sql_createBairroUsuario = "create table if not exists tb_bairro_usuario
    // (
    // cd_bairro int not null auto_increment,
    // nm_bairro varchar(50) not null,
    // cd_cidade int not null,
    // constraint pk_bairro_usuario
    //     primary key (cd_bairro),
    // constraint fk_bairro_usuario_cidade_usuario
    //     foreign key (cd_cidade)
    //         references tb_cidade_usuario(cd_cidade)
    // )
    // engine InnoDB";
    // $conn -> exec ($sql_createBairroUsuario);
    // // tabela que armazena informações sobre o bairro em que o usuário mora
    // echo "Tabela Bairro Usuário criada com sucesso!<br>";

    // $sql_createRuaUsuario = "create table if not exists tb_rua_usuario
    // (
    // cd_rua int not null auto_increment,
    // nm_rua varchar(50) not null,
    // cd_bairro int not null,
    // constraint pk_rua_usuario
    //     primary key (cd_rua),
    // constraint fk_rua_usuario_bairro_usuario
    //     foreign key (cd_bairro)
    //         references tb_bairro_usuario(cd_bairro)
    // )
    // engine InnoDB";
    // $conn -> exec ($sql_createRuaUsuario);
    // // tabela que armazena informações sobre a rua em que o usuário mora
    // echo "Tabela Rua Usuário criada com sucesso!<br>";

    // $sql_createDescLocalUsuario = "create table if not exists tb_descricao_local_usuario
    // (
    // cd_descricao_local int not null auto_increment,
    // cd_numero_casa int(10) not null,
    // ds_complemento varchar(75),
    // cd_rua int,
    // constraint pk_descricao_local_usuario
    //     primary key (cd_descricao_local),
    // constraint fk_descricao_local_usuario_rua_usuario
    //     foreign key (cd_rua)
    //         references tb_rua_usuario(cd_rua)
    // )
    // engine InnoDB";
    // $conn -> exec ($sql_createDescLocalUsuario);
    // // tabela que armazena informações sobre o local em que o usuário mora, como número da casa e algum complemento
    // echo "Tabela Descrição Local Usuário criada com sucesso!<br>";

    // $sql_createEnderecoUsuario = "create table if not exists tb_endereco_usuario
    // (
    // cd_endereco_usuario int not null auto_increment,
    // cd_cep char(8) not null,
    // cd_rua int not null,
    // constraint pk_endereco_usuario
    //     primary key (cd_endereco_usuario),
    // constraint fk_endereco_usuario_rua_usuario
    //     foreign key (cd_rua)
    //         references tb_rua_usuario(cd_rua)
    // )
    // engine InnoDB";
    // $conn -> exec ($sql_createEnderecoUsuario);
    // // tabela concatenada que armazena informações sobre o endereço em que o usuário mora
    // echo "Tabela Endereço Usuário criada com sucesso!<br>";

    $sql_createCep = "create table if not exists tb_cep
    (
    cd_cep int not null auto_increment,
    cd_numero_casa not null,
    constraint pk_cep
        primary key(cd_cep)
    )
    engine InnoDB";
    $conn -> exec($sql_createCep);
    // tabela que armazena o CEP e o número do casa do usuário

    $sql_createCepUsuario = "create table if not exists tb_cep_usuario
    (
    cd_cep_usuario int not null auto_increment,
    cd_cep char(8) int not null,
    cd_usuario int not null,
    constraint pk_cep_usuario
        primary key (cd_cep_usuario),
    constraint fk_cep_usuario_usuario
        foreign key (cd_usuario)
            references tb_usuario(cd_usuario),
    constraint fk_cep_usuario_cep
        foreign key (cd_cep)
            references tb_cep(cd_cep)
    )
    engine InnoDB";
    $conn -> exec($sql_createCepUsuario);
    // tabela que concatena a tabela CEP e usuário, armazenando informações sobre o endereço do mesmo

    $sql_createUsuario = "create table if not exists tb_usuario
    (
    cd_usuario int not null auto_increment,
    nm_usuario varchar(200) not null,
    nm_email varchar(200) not null,
    nm_senha varchar(200) not null,
    cd_telefone varchar(20),
    cd_cpf char(11) not null,
    dt_nascimento date,
    im_usuario varchar(200),
    cd_cep_usuario int,
    constraint pk_usuario
        primary key (cd_usuario),
    constraint fk_usuario_cep_usuario
        foreign ket (cd_cep_usuario)
            references tb_cep_usuario(cd_cep_usuario)
    )
    engine InnoDB";
    $conn -> exec($sql_createUsuario);
    // tabela que armazena dados do usuário
    echo "Tabela Usuário criada com sucesso!<br>";

    $sql_createTipo = "create table if not exists tb_tipo
    (
    cd_tipo int not null auto_increment,
    nm_tipo varchar(45) not null,
    constraint pk_tipo
        primary key (cd_tipo)
    )
    engine InnoDB";
    $conn -> exec ($sql_createTipo);
    // tabela que armazena os tipos de produtos
    echo "Tabela Tipo criada com sucesso!<br>";

    $sql_createEstampa = "create table if not exists tb_estampa
    (
    cd_estampa int not null auto_increment,
    nm_estampa varchar(50),
    ds_estampa varchar(45),
    im_foto_estampa varchar(200) not null,
    constraint pk_estampa
        primary key (cd_estampa)
    )
    engine InnoDB";
    $conn -> exec ($sql_createEstampa);
    // tabela que armazena as estampas dos usuários
    echo "Tabela Estampa criada com sucesso!<br>";

    $sql_createProduto = "create table if not exists tb_produto
    (
    cd_produto int not null auto_increment,
    nm_produto varchar(100) not null,
    ds_produto varchar(200),
    vl_preco decimal(6,2) not null,
    cd_tipo int not null,
    cd_estampa int,
    constraint pk_produto
        primary key (cd_produto),
    constraint fk_produto_tipo
        foreign key (cd_tipo)
            references tb_tipo(cd_tipo),
    constraint fk_produto_estampa
        foreign key (cd_estampa)
            references tb_estampa(cd_estampa)
    )
    engine InnoDB";
    $conn->exec($sql_createProduto);
    //tabela que armazena dados sobre o produto
    echo "Tabela Produto criada com sucesso!<br>";

    $sql_createEstadoPedido = "create table if not exists tb_estado_pedido
    (
    cd_estado int not  null auto_increment,
    sg_estado char(2) not null,
    constraint pk_estado_pedido
        primary key (cd_estado)
    )
    engine InnoDB";
    $conn->exec($sql_createEstadoPedido);
    //tabela que armazena o estado de destino do pedido
    echo "Tabela Estado Pedido criada com sucesso!<br>";

    $sql_createCidadePedido = "create table if not exists tb_cidade_pedido
    (
    cd_cidade int not null auto_increment,
    nm_cidade varchar(50) not null,
    cd_estado int not null,
    constraint pk_cidade_pedido
        primary key (cd_cidade),
    constraint fk_cidade_pedido_estado_pedido
        foreign key (cd_estado)
            references tb_estado_pedido(cd_estado)
    )
    engine InnoDB";
    $conn->exec($sql_createCidadePedido);
    //tabela que armazena a cidade de destino do pedido
    echo "Tabela Cidade Pedido criada com sucesso!<br>";

    $sql_createBairroPedido = "create table if not exists tb_bairro_pedido
    (
    cd_bairro int not null auto_increment,
    nm_bairro varchar(50) not null,
    cd_cidade int not null,
    constraint pk_bairro_pedido
        primary key (cd_bairro),
    constraint fk_bairro_cidade_pedido
        foreign key (cd_cidade)
            references tb_cidade_pedido(cd_cidade)
    )
    engine InnoDB";
    $conn->exec($sql_createBairroPedido);
    //tabela que armazena o bairro de destino do pedido
    echo "Tabela Bairro Pedido criada com sucesso!<br>";

    $sql_createRuaPedido = "create table if not exists tb_rua_pedido
    (
    cd_rua int not null auto_increment,
    nm_rua varchar(100) not null,
    cd_bairro int not null,
    constraint pk_rua_pedido
        primary key (cd_rua),
    constraint fk_rua_bairro_pedido
        foreign key (cd_bairro)
            references tb_bairro_pedido(cd_bairro)
    )
    engine InnoDB";
    $conn->exec($sql_createRuaPedido);
    //tabela que armazena a rua de destino do pedido
    echo "Tabela Rua Pedido criada com sucesso!<br>";

    $sql_createDescLocalPedido = "create table if not exists tb_descricao_local_pedido
    (
    cd_descricao_local int not null auto_increment,
    cd_numero_casa int(10) not null,
    ds_complemento varchar(75),
    cd_rua int not null,
    constraint pk_descricao_local_pedido
        primary key (cd_descricao_local),
    constraint fk_descricao_local_rua_pedido
        foreign key (cd_rua)
            references tb_rua_pedido(cd_rua)
    )
    engine InnoDB";
    $conn -> exec($sql_createDescLocalPedido);
    // tabela que armazena os dados complementares sobre o local da entrega do produto
    echo "Tabela Descrição Local Pedido criada com sucesso!<br>";

    $sql_createEnderecoPedido = "create table if not exists tb_endereco_pedido
    (
    cd_endereco_pedido int not null auto_increment,
    cd_cep char(8) not null,
    cd_rua int not null,
    constraint pk_endereco_pedido
        primary key (cd_endereco_pedido),
    constraint f_endereco_pedido_rua_pedido
        foreign key (cd_rua)
            references tb_rua_pedido(cd_rua)
    )
    engine InnoDB";
    $conn -> exec($sql_createEnderecoPedido);
    // tabela que armazena endereço de envio do produto
    echo "Tabela Endereço Pedido criada com sucesso!<br>";

    $sql_createPedido = "create table if not exists tb_pedido
    (
    cd_pedido int not null auto_increment,
    dt_pedido date not null,
    ic_status_processamento_enviado_entregue_cancelado varchar(20) not null,
    cd_usuario int not null,
    cd_endereco_pedido int not null,
    constraint pk_pedido
        primary key (cd_pedido),
    constraint fk_pedido_usuario
        foreign key (cd_usuario)
            references tb_usuario(cd_usuario),
    constraint fk_pedido_endereco_pedido
        foreign key (cd_endereco_pedido)
            references tb_endereco_pedido(cd_endereco_pedido)
    )
    engine InnoDB";
    $conn->exec($sql_createPedido);
    // tabela que armazena pedidos realizados pelo usuário
    echo "Tabela Pedido criada com sucesso!<br>";

    $sql_createInfoPagamento = "create table if not exists tb_info_pagamento
    (
    cd_pagamento int not null auto_increment,
    dt_pagamento date not null,
    hr_pagamento time not null,
    vl_total decimal(6,2) not null,
    ic_pagamento_debito_credito varchar(7) not null,
    cd_cartao int not null,
    nm_titular_cartao varchar(200) not null,
    dt_expiracao_cartao date not null,
    cd_cvv_cartao char(3) not null,
    cd_pedido int not null,
    constraint pk_info_pagamento
        primary key (cd_pagamento),
    constraint fk_info_pagamento_pedido
        foreign key (cd_pedido)
            references tb_pedido(cd_pedido)
    )
    engine InnoDB";
    $conn->exec($sql_createInfoPagamento);
    //tabela que armazena informações sobre o pagamento realizado
    echo "Tabela Infomações de Pagamento criada com sucesso!<br>";

    $sql_createItemPedido = "create table if not exists tb_item_pedido
    (
    cd_item_pedido int not null auto_increment,
    qt_produto int not null,
    vl_subtotal decimal(6,2),
    cd_pedido int not null,
    cd_produto int not null,
    constraint pk_item_pedido
        primary key (cd_item_pedido),
    constraint fk_item_pedido_pedido
        foreign key (cd_pedido)
            references tb_pedido(cd_pedido),
    constraint fk_item_pedido_produto
        foreign key (cd_produto)
            references tb_produto(cd_produto)
    )
    engine InnoDB";
    $conn->exec($sql_createItemPedido);
    //Tabela que armazena os itens pedidos pelo usuário
    echo "Tabela Item do Pedido criada com sucesso!<br>";

} catch (PDOException $e) {
    echo $database . "<br>" . $e->getMessage();
}

$conn = null;
?>
</body>
</html>
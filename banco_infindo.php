<?php
$servername = "localhost:3306";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $database = "create database if not exists db_infindo";
    // criando a database
    $conn->exec($database);

    $sql_use = "use db_infindo";
    $conn->exec($sql_use);
    // mostrando em qual database deve ser criada as tabelas a seguir

    // Crie a tabela 'tb_residencia' primeiro
    $sql_createResidencia = "create table if not exists tb_residencia
    (
    cd_residencia int not null auto_increment,
    cd_cep char(8) not null,
    cd_numero_casa int not null,
    nm_rua varchar(100) not null,
    nm_bairro varchar(100) not null,
    nm_cidade varchar(100) not null,
    sg_estado char(2) not null,
    constraint pk_cep
        primary key (cd_residencia)
    )
    engine InnoDB";
    $conn -> exec($sql_createResidencia);
    
    // Crie a tabela 'tb_usuario' em seguida
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
    constraint pk_usuario
        primary key (cd_usuario)
    )
    engine InnoDB";
    $conn -> exec($sql_createUsuario);
    
    // Agora, crie a tabela 'tb_residencia_usuario' com referências às tabelas 'tb_residencia' e 'tb_usuario'
    $sql_createResidenciaUsuario = "create table if not exists tb_residencia_usuario
    (
    cd_residencia_usuario int not null auto_increment,
    cd_residencia int not null,
    cd_usuario int not null,
    constraint pk_residencia_usuario
        primary key (cd_residencia_usuario),
    constraint fk_residencia_usuario_usuario    
        foreign key (cd_usuario)
            references tb_usuario(cd_usuario),
    constraint fk_residencia_usuario_residencia
        foreign key (cd_residencia)
            references tb_residencia(cd_residencia)
    )
    engine InnoDB";
    $conn -> exec($sql_createResidenciaUsuario);
    // tabela que concatena a tabela residencia e usuário, armazenando informações sobre o endereço do mesmo

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

    $sql_createEstampa = "create table if not exists tb_estampa
    (
    cd_estampa int not null auto_increment,
    nm_estampa varchar(100),
    ds_estampa varchar(500),
    im_foto_estampa varchar(200) not null,
    constraint pk_estampa
        primary key (cd_estampa)
    )
    engine InnoDB";
    $conn -> exec ($sql_createEstampa);
    // tabela que armazena as estampas dos usuários

    $sql_createProduto = "create table if not exists tb_produto
    (
    cd_produto int not null auto_increment,
    nm_produto varchar(100) not null,
    ds_produto varchar(500),
    vl_preco decimal(6,2) not null,
    cd_tipo int not null,
    cd_estampa int,
    im_foto_produto varchar(200),
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

    $sql_createDestinoPedido = "create table if not exists tb_destino_pedido
    (
    cd_destino_pedido int not null auto_increment,
    cd_cep_destino char(8) not null,
    nm_rua_destino varchar(100) not null,
    nm_bairro_destino varchar(100) not null,
    nm_cidade_destino varchar(100) not null,
    sg_estado_destino char(2) not null,
    cd_numero_casa_destino int not null,
    ds_complemento_destino varchar(100),
    constraint pk_destino_pedido
        primary key (cd_destino_pedido)
    )
    engine InnoDB";
    $conn -> exec($sql_createDestinoPedido);
    // tabela que armazena endereço de destino do produto

    $sql_createPedido = "create table if not exists tb_pedido
    (
    cd_pedido int not null auto_increment,
    dt_pedido date not null,
    ic_status_processamento_enviado_entregue_cancelado varchar(20) not null,
    cd_usuario int not null,
    cd_destino_pedido int not null,
    constraint pk_pedido
        primary key (cd_pedido),
    constraint fk_pedido_usuario
        foreign key (cd_usuario)
            references tb_usuario(cd_usuario),
    constraint fk_pedido_destino_pedido
        foreign key (cd_destino_pedido)
            references tb_destino_pedido(cd_destino_pedido)
    )
    engine InnoDB";
    $conn->exec($sql_createPedido);
    // tabela que armazena pedidos realizados pelo usuário

    $sql_createInfoPagamento = "create table if not exists tb_info_pagamento
    (
    cd_pagamento int not null auto_increment,
    dt_pagamento date not null,
    hr_pagamento time not null,
    vl_total decimal(6,2) not null,
    ic_pagamento_debito_credito varchar(7) not null,
    cd_cartao int not null,
    nm_titular_cartao varchar(200) not null,
    dt_expiracao_cartao varchar(7) not null,
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

} catch (PDOException $e) {
    echo $database . "<br>" . $e->getMessage();
}
$conn = null;
?>

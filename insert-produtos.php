<?php
include 'conexao.php';
try{
    // Defina as variáveis primeiro
$caneca_ceramica = "Caneca de cerâmica";
$caneca_plastico = "Caneca de plástico";
$caneca_porcelana = "Caneca de porcelana";

$camiseta_basica = "Camiseta básica macia unissex";
$camiseta_reta = "Camiseta modelagem reta masculina";
$camiseta_triblend = "Camiseta tri-blend unissex";

$nm_estampa_flork = "flork";
$ds_estampa_flork = ".";
$im_foto_estampa_flork = "imagens\caneca_abrigo1.jpg";

$nm_estampa_casa_comigo = "Casa comigo?";
$ds_estampa_casa_comigo = ".";
$im_foto_estampa_casa_comigo = "imagens\caneca_casa_comigo_2.jpg";

$nm_estampa_mickey_minie = "Mickey e Minie";
$ds_estampa_mickey_minie = ".";
$im_foto_estampa_mickey_minie = "imagens\caneca_mickey3.jpg";

$nm_produto_flork = "Caneca porcelana branca flork";
$ds_produto_flork = "Caneca de plástico premium, leve, durável e fácil de limpar. Seu design sólido e acabamento polido proporcionam conforto e praticidade para o uso diário, tornando os momentos de pausa mais agradáveis.";

// Caneca Cerâmica
$stmt_caneca_ceramica = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_caneca_ceramica->bindParam(':nm_tipo', $caneca_ceramica);
$stmt_caneca_ceramica->execute();

// Caneca Plástico
$stmt_caneca_plastico = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_caneca_plastico->bindParam(':nm_tipo', $caneca_plastico);
$stmt_caneca_plastico->execute();

// Caneca Porcelana
$stmt_caneca_porcelana = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_caneca_porcelana->bindParam(':nm_tipo', $caneca_porcelana);
$stmt_caneca_porcelana->execute();

// Camiseta Básica
$stmt_camiseta_basica = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_camiseta_basica->bindParam(':nm_tipo', $camiseta_basica);
$stmt_camiseta_basica->execute();

// Camiseta Reta
$stmt_camiseta_reta = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_camiseta_reta->bindParam(':nm_tipo', $camiseta_reta);
$stmt_camiseta_reta->execute();

// Camiseta Tri-blend
$stmt_camiseta_triblend = $conn->prepare("INSERT INTO tb_tipo (nm_tipo) VALUES (:nm_tipo)");
$stmt_camiseta_triblend->bindParam(':nm_tipo', $camiseta_triblend);
$stmt_camiseta_triblend->execute();

// Estampa Flork
$stmt_estampa_flork = $conn->prepare("INSERT INTO tb_estampa (nm_estampa, ds_estampa, im_foto_estampa) VALUES (:nm_estampa, :ds_estampa, :im_foto_estampa)");
$stmt_estampa_flork->bindParam(':nm_estampa', $nm_estampa_flork);
$stmt_estampa_flork->bindParam(':ds_estampa', $ds_estampa_flork);
$stmt_estampa_flork->bindParam(':im_foto_estampa', $im_foto_estampa_flork);
$stmt_estampa_flork->execute();

// Estampa Casa Comigo
$stmt_estampa_casa_comigo = $conn->prepare("INSERT INTO tb_estampa (nm_estampa, ds_estampa, im_foto_estampa) VALUES (:nm_estampa, :ds_estampa, :im_foto_estampa)");
$stmt_estampa_casa_comigo->bindParam(':nm_estampa', $nm_estampa_casa_comigo);
$stmt_estampa_casa_comigo->bindParam(':ds_estampa', $ds_estampa_casa_comigo);
$stmt_estampa_casa_comigo->bindParam(':im_foto_estampa', $im_foto_estampa_casa_comigo);
$stmt_estampa_casa_comigo->execute();

// Estampa Mickey e Minie
$stmt_estampa_mickey_minie = $conn->prepare("INSERT INTO tb_estampa (nm_estampa, ds_estampa, im_foto_estampa) VALUES (:nm_estampa, :ds_estampa, :im_foto_estampa)");
$stmt_estampa_mickey_minie->bindParam(':nm_estampa', $nm_estampa_mickey_minie);
$stmt_estampa_mickey_minie->bindParam(':ds_estampa', $ds_estampa_mickey_minie);
$stmt_estampa_mickey_minie->bindParam(':im_foto_estampa', $im_foto_estampa_mickey_minie);
$stmt_estampa_mickey_minie->execute();

// Produto Flork
$stmt_insert_produto_flork = $conn->prepare("INSERT INTO tb_produto (nm_produto, ds_produto, vl_preco, cd_tipo, cd_estampa, im_foto_produto)
    VALUES (:nm_produto, :ds_produto, 35.00, 3, 1, :im_foto_produto)");
$im_foto_produto_flork = "imagens\caneca_abrigo1.jpg";
$stmt_insert_produto_flork->bindParam(':nm_produto', $nm_produto_flork);
$stmt_insert_produto_flork->bindParam(':ds_produto', $ds_produto_flork);
$stmt_insert_produto_flork->bindParam(':im_foto_produto', $im_foto_produto_flork);
$stmt_insert_produto_flork->execute();

} catch (PDOException $e) {
    echo "Erro ao cadastrar: " . $e->getMessage();
}
?>
function changePage(buttonNumber) {
  if (buttonNumber === 1) {
    window.location.href = 'products.php';
  } else if (buttonNumber === 2) {
    // Adiciona a classe "ativo" ao botão 2
    document.getElementById('button2').classList.add('ativo');
    window.location.href = 'prdtpage2.html';
  }
}
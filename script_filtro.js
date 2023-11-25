document.addEventListener("DOMContentLoaded", function() {
    const tamanhoDropdown = document.getElementById("tamanhoDropdown");
    const tamanhoSelecionado = document.getElementById("tamanhoSelecionado");
    const opcoesTamanho = document.getElementById("opcoesTamanho");

    tamanhoDropdown.addEventListener("click", function() {
        opcoesTamanho.style.display = (opcoesTamanho.style.display === "block") ? "none" : "block";
    });

    opcoesTamanho.addEventListener("click", function(event) {
        if (event.target.classList.contains("opcao")) {
            tamanhoSelecionado.textContent = event.target.textContent;
            opcoesTamanho.style.display = "none";
        }
    });
});
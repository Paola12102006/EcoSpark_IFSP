function abrirSecaoConteudo(classe) {
    const conteudo = document.querySelector(".box-" + classe);
    const seta = document.querySelector(".seta-" + classe);
    const txtAbrir = document.querySelector(".txt-" + classe);

    const altura = conteudo.scrollHeight;

    conteudo.style.setProperty("--altura-conteudo", `${altura}px`);

    conteudo.classList.toggle("aberto");
    seta.classList.toggle("aberto");

    if (txtAbrir.textContent == "Mostrar mais") {
        txtAbrir.textContent = "Mostrar menos";
    }

    else {
        txtAbrir.textContent = "Mostrar mais";
    }

}
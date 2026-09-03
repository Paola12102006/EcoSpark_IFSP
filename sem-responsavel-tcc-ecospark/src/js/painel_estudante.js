

function abrirQuizConquista(idAtvQuiz, elemento) {
    // const quiz = elemento.parentElement;

    //elemento.style.borderRadius = "15px 15px 0 0";

    
    const container = document.querySelector(".niveis-quiz." + idAtvQuiz);
    const seta = document.querySelector(".seta-conquista." + idAtvQuiz);
    
    const alturaCont = container.scrollHeight;
    container.style.setProperty("--altura-cont", `${alturaCont}px`);
    
    seta.classList.toggle("aberto");
    container.classList.toggle("aberto");
    elemento.classList.toggle("aberto");
}
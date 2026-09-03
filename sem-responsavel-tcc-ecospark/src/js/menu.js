function abrirMenu(classe, event) {
    event.stopPropagation();

    document.querySelector(".menu." + classe).classList.toggle("aberto");
}

document.addEventListener("click", () => {
    document.querySelectorAll(".menu").forEach(menu => {
        menu.classList.remove("aberto");
    });
});

document.querySelectorAll(".menu").forEach(menu => {
    menu.addEventListener("click", e => {
        e.stopPropagation();
    });
});
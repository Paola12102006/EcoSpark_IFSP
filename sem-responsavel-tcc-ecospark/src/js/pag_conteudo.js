const inputArquivo = document.getElementById("comprovacao");
const areaUpload = document.querySelector(".area-upload");

inputArquivo.addEventListener("change", function () {
    if (this.files.length > 0) {
        const arquivo = this.files[0];

        areaUpload.querySelector("p").textContent = arquivo.name;
        areaUpload.querySelector("span").textContent = "Arquivo selecionado";
    }
});

areaUpload.addEventListener("dragover", function (event) {
    event.preventDefault();
    areaUpload.classList.add("arrastando");
});

areaUpload.addEventListener("dragleave", function () {
    areaUpload.classList.remove("arrastando");
});

areaUpload.addEventListener("drop", function (event) {
    event.preventDefault();

    areaUpload.classList.remove("arrastando");

    const arquivos = event.dataTransfer.files;

    if (arquivos.length > 0) {
        inputArquivo.files = arquivos;

        areaUpload.querySelector("p").textContent = arquivos[0].name;
        areaUpload.querySelector("span").textContent = "Arquivo selecionado";
    }
});



function boxEnvio(mostrarDiv) {
    const mostrar = document.querySelector("." + mostrarDiv);

    const divs = document.querySelectorAll(".div-envio");

    divs.forEach(div => {
        div.classList.add("esconder");
    })

    mostrar.classList.remove("esconder");
}

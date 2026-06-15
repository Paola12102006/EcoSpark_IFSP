const wrapper = document.querySelector('.wrapper')
const loginLink = document.querySelector('.login-link')
const cadastrarLink = document.querySelector('.cadastrar-link')

let ultimaAltura = 0;

// clica pra mudar para o form de cadastro
cadastrarLink.addEventListener('click', ()=> {
    wrapper.classList.add('active')

    if (ultimaAltura == 0) {
        wrapper.style.height = 621 + "px"
    } else {
        wrapper.style.height = ultimaAltura + "px"
    }

})

// clica pra voltar pro form de login
loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active')

    ultimaAltura = wrapper.clientHeight;

    wrapper.style.height = 530 + "px"
})


const abrirBoxAvatar = document.getElementById("title-avatares")
const boxAvatares= document.querySelector(".box-avatares")
const seta = document.querySelector(".seta")

abrirBoxAvatar.addEventListener("click", () => {

    let alturaAtual = wrapper.clientHeight

    if (boxAvatares.classList.contains("ativo")) {
        boxAvatares.classList.remove("ativo")
        seta.classList.remove("ativo")

        abrirBoxAvatar.style.borderBottom = "2px solid #024130"
        alturaAtual = alturaAtual - 270
    } 
    else {
        boxAvatares.classList.add("ativo")
        seta.classList.add("ativo")

        abrirBoxAvatar.style.borderBottom = "none"
        alturaAtual = alturaAtual + 270

    }

    wrapper.style.height = alturaAtual + "px"

})


const boxAtributos = document.querySelector(".box-atributos-adicionais")
const allBoxesAtributos = document.querySelectorAll(".atributos");
let contador = 0

function abrir(classe) {

    allBoxesAtributos.forEach(item => {
        item.classList.remove("ativo");
    });

    const bloco = document.querySelector(classe);

    bloco.classList.add("ativo");

    boxAtributos.classList.add("ativo")

    let alturaAtual = wrapper.clientHeight

    if(contador <= 0) {
        wrapper.style.height = alturaAtual + 141 + "px"
    } else {
        wrapper.style.height = (alturaAtual - 141) + 141 + "px"
    }
    contador++
}

const opcaoAcesso = document.getElementById("opc-acesso");

opcaoAcesso.addEventListener("change", function() {

    const classeEnviada = opcaoAcesso.value.toLowerCase();

    console.log(classeEnviada);

    abrir("." + classeEnviada);

    const inputsClasseEnviada = document.querySelectorAll(".inp-" + classeEnviada)

    inputsClasseEnviada.forEach(input => {
        input.setAttribute("required", "required");

        console.log(input);
        
    })

})
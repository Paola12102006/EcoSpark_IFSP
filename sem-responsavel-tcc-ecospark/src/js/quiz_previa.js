const secaoQuiz = document.querySelector(".secao-quiz")
const boxPergunta = document.getElementById('pergunta') // perguntaEl
const boxRespostas = document.getElementById('respostas') // respostasEl
// const btnProxima = document.querySelector('.btn-quiz')

const btnVerificar = document.querySelector(".btn-verificar")
const btnProximaPergunta = document.querySelector(".btn-proxima-pergunta") // const btnProxima = document.querySelector('.btn-quiz')

const audioCorreto = document.getElementById('somDoBotaoCorreto')
const audioErrado = document.getElementById('somDoBotaoErrado')


let perguntaAtual = 0
let pontuacao = 0
let respostaSelecionada = null

const quiz = [
    {
        pergunta: "1-) O que significa sustentabilidade?",
        respostas: [
            "Usar todos os recursos",
            "Cuidar do meio ambiente sem prejudicar o futuro",
            "Evitar tecnologia",
            "Plantar árvores apenas"
        ],
        correta: 1
    },
    {
        pergunta: "2-) Qual material demora mais para se decompor?",
        respostas: ["Papel", "Casca de banana", "Plástico", "Restos de comida"],
        correta: 2
    },
    {
        pergunta: "3-) O que é reciclagem?",
        respostas: [
            "Jogar lixo no lugar certo",
            "Transformar materiais usados em novos",
            "Queimar lixo",
            "Enterrar resíduos"
        ],
        correta: 1
    },
    {
        pergunta: "4-) Qual atitude economiza água?",
        respostas: [
            "Torneira aberta",
            "Banho longo",
            "Fechar ao escovar os dentes",
            "Lavar calçada"
        ],
        correta: 2
    },
    {
        pergunta: "5-) O que são os 3 Rs?",
        respostas: [
            "Reutilizar, Reciclar e Reduzir",
            "Recolher, Rasgar e Remover",
            "Reciclar, Replantar e Reagir",
            "Reduzir, Replantar e Reusar"
        ],
        correta: 0
    },
    {
        pergunta: "6-) O que reduz poluição?",
        respostas: [
            "Jogar lixo na rua",
            "Usar transporte público",
            "Queimar lixo",
            "Desperdiçar energia"
        ],
        correta: 1
    },
    {
        pergunta: "7-) O que são energias renováveis?",
        respostas: [
            "Acabam rápido",
            "Não podem ser usadas",
            "Se renovam naturalmente",
            "São perigosas"
        ],
        correta: 2
    },
    {
        pergunta: "8-) Qual atitude ajuda o planeta?",
        respostas: [
            "Desperdiçar comida",
            "Usar sacolas reutilizáveis",
            "Jogar lixo no rio",
            "Luz acesa sem necessidade"
        ],
        correta: 1
    }
]

function abrirQuiz() {
    secaoQuiz.classList.remove('fechado')

    setTimeout(() => {
        secaoQuiz.scrollIntoView({ behavior: 'smooth' })
    }, 500)

    carregarPergunta()
}

function carregarPergunta() {
    respostaSelecionada = null

    const atual = quiz[perguntaAtual]
    boxPergunta.textContent = atual.pergunta
    boxRespostas.innerHTML = ""

    atual.respostas.forEach((resposta, index) => {
        const btn = document.createElement('button')
        btn.textContent = resposta

        btn.onclick = () => {
            respostaSelecionada = index

            document.querySelectorAll('#respostas button').forEach(b => b.classList.remove('selecionado'))
            btn.classList.add('selecionado')
        }

        boxRespostas.appendChild(btn)
    })
}

function verificarResposta() {
    if (respostaSelecionada === null) {
        alert("Escolha uma resposta!")
        return
    }

    const listaRespostas = document.querySelectorAll('#respostas button');

    listaRespostas.forEach((resposta, i) => {
        if(resposta.classList.contains("selecionado") == false) {
            resposta.setAttribute("disabled", "disabled")            
        }
    })

    btnVerificar.setAttribute("disabled", "disabled")
    btnProximaPergunta.removeAttribute("disabled")

    if (respostaSelecionada === quiz[perguntaAtual].correta) {
        btnVerificar.setAttribute("value", "Correto!")
        btnVerificar.classList.add("correto")

        audioCorreto.play()

        pontuacao++
    } else {
        btnVerificar.setAttribute("value", "Errado!")
        btnVerificar.classList.add("errado")

        audioErrado.play()
    }

}

function proximaPergunta() {
    perguntaAtual++

    if (perguntaAtual < quiz.length) {
        carregarPergunta()

        btnVerificar.removeAttribute("disabled")
        btnProximaPergunta.setAttribute("disabled", "disabled")

        btnVerificar.setAttribute("value", "Verificar resposta")
        btnVerificar.classList.remove("correto")
        btnVerificar.classList.remove("errado")

    } else {
        mostrarResultado()
    }
}

function mostrarResultado() {
    boxPergunta.textContent = `🌱 Você acertou ${pontuacao} de ${quiz.length}! 🌱`

    boxRespostas.innerHTML = `
        <p class='txt-login'>Gostou? Quer mais atividades como essa?</p>
        <br>
        <a href='./login-cadastro.php' class='btn-login'>Faça Login!!!</a>
        
    `

    btnVerificar.style.display = "none"
    btnProximaPergunta.textContent = "Refazer Quiz"
    btnProximaPergunta.onclick = reiniciarQuiz
}

function reiniciarQuiz() {
    perguntaAtual = 0
    pontuacao = 0
    respostaSelecionada = null

    btnProximaPergunta.textContent = "Próxima"
    btnProximaPergunta.onclick = proximaPergunta

    carregarPergunta()
}
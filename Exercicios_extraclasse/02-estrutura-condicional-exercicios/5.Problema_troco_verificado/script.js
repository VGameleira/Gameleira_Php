let produto = Number.parseFloat(prompt("Digite a preço do produto"));
let quantidade = Number.parseInt(prompt("Digite a quantidade desejada"));

let valorFinal = produto * quantidade;

let troco;
let faltando;

alert(`O valor da compra foi: ${valorFinal}`)

let pagamento = Number.parseFloat(prompt("Digite o valor dado"));


if (pagamento > valorFinal) {
    troco = valorFinal - pagamento
    alert(`${troco}`)
} else if (pagamento <= valorFinal){
     faltando = valorFinal - pagamento;
    alert(`${faltando}`)
} else {
    alert("Tudo certo! Obrigado pela preferencia");
}


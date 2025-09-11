// Problema "lanchonete" (adaptado de URI 1038)
// Uma lanchonete possui vários produtos. Cada produto possui um código 
// e um preço. Você deve fazer um programa para ler o código e a 
// quantidade comprada de um produto (suponha um código válido), e daí 
// informar qual o valor a ser pago, com duas casas decimais, conforme 
// tabela de produtos ao lado.

// Código do produto | Preço do produto 
// 1                 | R$ 5.00 
// 2                 | R$ 3.50 
// 3                 | R$ 4.80 
// 4                 | R$ 8.90 
// 5                 | R$ 7.32 

let produto = Number.parseInt(prompt("Digite o codigo do Produto: "));
let quant = Number.parseInt(prompt("Digite a quantidade de Produto: "));
let preco = 0;
let total = 0;

if (produto === 1) {
    preco = 5;

    total += preco * quant; 
    alert(`Valor a pagar: ${total.toFixed(2)}`)

} else if ((produto === 2)) {
    preco = 3.50;

    total += preco * quant; 
    alert(`Valor a pagar: ${total.toFixed(2)}`)
} else if ((produto === 3)) {
    preco = 4.80;

    total += preco * quant;
    alert(`Valor a pagar: ${total.toFixed(2)}`)
}

else if ((produto === 4)) {
    preco = 8.90;

    total += preco * quant; 
    alert(`Valor a pagar: ${total.toFixed(2)}`)
}

else if ((produto === 5)) {
    preco = 7.32;

    total += preco * quant; 
    alert(`Valor a pagar: ${total.toFixed(2)}`)
} else {
    alert("Valor invalido, digite um valor entre 1 e 5")
}







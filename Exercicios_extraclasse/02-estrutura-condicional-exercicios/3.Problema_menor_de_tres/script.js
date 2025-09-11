
let n1 = Number.parseInt(prompt("Digite a  1º número"));
let n2 = Number.parseInt(prompt("Digite a  2º número"));
let n3 = Number.parseInt(prompt("Digite a  3º número"));

let menor = n1;

if (n2 < menor) {
    menor = n2;
}
if (n3 < menor) {
    menor = n3;
}

window.alert(`Sua 1º número foi: ${n1}`)
window.alert(`Sua 2º número foi: ${n2}`)
window.alert(`Sua 3º número foi: ${n3}`)
window.alert(`O menor número é: ${menor}`)
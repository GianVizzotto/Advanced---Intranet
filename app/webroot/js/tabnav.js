$(document).ready(function() { //é declarada a função que será executada quando a página for carregada.
	$("#content > div").hide(); //escondemos todas as divs dentro de “content”, que são as divs com o conteúdo
	$("#content > div:eq(0)").show(); //mostramos somente a primeira div dentro de “content”, que é o conteúdo da primeira aba
	$("#tabs > a:eq(0)").css("background", "url(tab-selected.jpg) top left no-repeat"); //mudamos a imagem da primeira aba, para dar o efeito dela estar selecionada
});
 
function opentab(num) { //declaramos a função opentab(), que será chamada sempre que uma aba for clicada, e recebe como parâmetro qual div de “content” será mostrada (1 para a primeira, 2 para a segunda e assim por diante)
	$("#content > div").hide(); //escondemos todas as divs de conteúdo
	$("#content > div:eq(" + (num-1) + ")").fadeIn(); //mostramos a div indicada no parâmetro, utilizando um efeito de fade, através da função jQuery fadeIn()
	$("#tabs > a").css("background", "url(tab.jpg) top left no-repeat"); //alteramos a propriedade CSS background dos links, atribuindo a imagem da aba de quando ela não está selecionada
	$("#tabs > a:eq(" + (num-1) + ")").css("background", "url(tab-selected.jpg) top left no-repeat"); //alteramos a propriedade CSS background somente da aba clicada, atribuindo a ela a imagem de quando a aba está selecionada.	
}
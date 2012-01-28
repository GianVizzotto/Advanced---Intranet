$(document).ready(function() { //� declarada a fun��o que ser� executada quando a p�gina for carregada.
	$("#content > div").hide(); //escondemos todas as divs dentro de �content�, que s�o as divs com o conte�do
	$("#content > div:eq(0)").show(); //mostramos somente a primeira div dentro de �content�, que � o conte�do da primeira aba
	$("#tabs > a:eq(0)").css("background", "url(tab-selected.jpg) top left no-repeat"); //mudamos a imagem da primeira aba, para dar o efeito dela estar selecionada
});
 
function opentab(num) { //declaramos a fun��o opentab(), que ser� chamada sempre que uma aba for clicada, e recebe como par�metro qual div de �content� ser� mostrada (1 para a primeira, 2 para a segunda e assim por diante)
	$("#content > div").hide(); //escondemos todas as divs de conte�do
	$("#content > div:eq(" + (num-1) + ")").fadeIn(); //mostramos a div indicada no par�metro, utilizando um efeito de fade, atrav�s da fun��o jQuery fadeIn()
	$("#tabs > a").css("background", "url(tab.jpg) top left no-repeat"); //alteramos a propriedade CSS background dos links, atribuindo a imagem da aba de quando ela n�o est� selecionada
	$("#tabs > a:eq(" + (num-1) + ")").css("background", "url(tab-selected.jpg) top left no-repeat"); //alteramos a propriedade CSS background somente da aba clicada, atribuindo a ela a imagem de quando a aba est� selecionada.	
}
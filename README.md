CartPHP
=======

Esta API tem como objetivo formatar os dados de arrays ou variáveis para objetos, dentro do contexto de E-commerce.

Sintaxe:
$Produto = new ([array()],[$variavel1,$variavel2,$variavel3]);

A definição do construtor é obrigatória, pode-se apenas instânciar a classe e utilizar o sets e gets.

Exemplos de uso:

O produto abaixo cria 2 instâncias da classe Produto, evitando tem que instânciar duas vezes o mesmo objeto.
$Produto = new Produto(
	array(
		'id' => 1,
		'nome' => 'Banco',
		'descricao' => 'Banco para sentar',
		'preco' => 150.00,
		'qtd' => 12,
		'disp' => false
	),
	array(
		'id' => 2,
		'nome' => 'Praça',
		'descricao' => 'Banco para sentar',
		'preco' => 250.00,
		'qtd' => 12,
		'disp' => false
	)
);

O Cart abaixo adiciona os produtos instânciados no carrinho

$Cart = new Carrinho;
$Cart->AddCart($Produto);
echo $Cart->cart[0]->getId(); # Retorna o ID do Produto 1 (index - 0)

Outro exemplo é receber de um POST ou de um retorno com mysql_fetch_assoc ou mysql_fetch_array.
$Produto = new Produto($_POST); OU $Produto = new Produto($resultado_mysql);

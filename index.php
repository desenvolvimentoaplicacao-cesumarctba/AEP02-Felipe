<?php

require ('pessoa.php'); 

require ('tela.html'); 

	if(isset($_POST['enviar'])){
		$nome 		= $_POST['nome']; 
		$data 		= $_POST['dataNascimento']; 
		$peso 		= $_POST['peso']; 
		$altura 	= $_POST['altura']; 
		$numeroCPF 	= $_POST['cpf']; 
	} else{
		$nome 		= ''; 
		$data 		= ''; 
		$peso 		= ''; 
		$altura 	= ''; 
		$numeroCPF 	= ''; 
	}

$pessoa = new Pessoa($nome, $data, $peso, $altura); 

$pessoa->validaCPF($numeroCPF); 

$pessoa->calculaIMC(); 

$pessoa->calculaIdade(); 


echo "</body></html>";

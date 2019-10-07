<?php

class Pessoa 
{

	public $nome; 
	public $data_nascimento; 
	public $peso; 
	public $altura; 
	public $cpf; 
	
	function __construct($nome, $nascimento, $peso, $altura)
	{
		$this->nome = $nome; 
		$this->data_nascimento = $nascimento; 
		$this->peso = $peso; 
		$this->altura = $altura; 
	}

	public function validaCPF($cpf)
	{
		if($cpf == ''){
			echo "Por favor, informe o CPF do usuário. <br> ";

		} else{

			//Se numerico, $validacao1 recebe 1
			$validacao1 = (is_numeric($cpf))? 1 : 0; 

			//É DO FORMATO NUMERICO
			if ( $validacao1 == 1 ) {
				
				//Se comprimento correto, $validacao2 recebe 1
				$validacao2 = ( strlen($cpf) == 11 )? 1 : 0;

				//TEM COMPRIMENTO CORRETO (11 DIGITOS)
				if ( $validacao2 == 1 ) {
					
					//Transforma o parametro CPF em um array de 11 posicoes, 
					//onde cada digito ocupa uma posicao
					$numeroCPF = str_split($cpf);

					$erro = 0; 
					for ($i=0; $i <= 9 ; $i++) { 
						if ($numeroCPF[$i] == $numeroCPF[$i++]) {
							$erro++; 
						}
					}

					//Se todos os digitos do teste forem iguais
					$validacao3 = ($erro != 10)? 1 : 0; 

					//OS 11 DIGITOS NAO SAO IGUAIS
					if ($validacao3 == 1) {
					
						$cont1 = 10; 
						for ( $i = 0 ; $i <= 8 ; $i++ ) { 
							$array1[] = $numeroCPF[$i] * $cont1; 
							$cont1--; 
						}

						//Soma do array obtido
						$total1 = array_sum($array1); 

						//Resto da divisao do total por 11
						$mod1 = $total1 % 11;

						//Calculo para definicao do primeiro digito verificador
						//(digitoVerificador1)
						$calc1 = 11 - $mod1; 
						if ( $calc1 > 9) {
							$digitoVerificador1 = 0; 
						} else{
							$digitoVerificador1 = $calc1; 
						}

						$cont2 = 11; 
						for ( $i = 0 ; $i <= 9 ; $i++ ) { 
							$array2[] = $numeroCPF[$i] * $cont2; 
							$cont2--; 
						}
						$total2 = array_sum($array2); 
						$mod2 = $total2 % 11;
						$calc2 = 11 - $mod2; 
						if ( $calc2 > 9) {
							$digitoVerificador2 = 0; 
						} else{
							$digitoVerificador2 = $calc2; 
						}
						if (($numeroCPF[9] == $digitoVerificador1) && ($numeroCPF[10] == $digitoVerificador2)) {
							//CPF VALIDO
							echo "<strong> O CPF É VÁLIDO!!! </strong><br> ";
							$this->cpf = $cpf; 
						} else{
							//CPF INVALIDO
							echo "<strong> O CPF INFORMADO É INVÁLIDO!! </strong><br>";
						}
					} else{
						//DIGITOS INFORMADOS SAO IGUAIS
						echo "Números sequenciais não configuram um CPF válido! <br> ";

					}
					
				} else{
					//TOTAL DE DIGITOS DIFERENTE DE 11
					echo "O número de dígitos informados no CPF está incorreto! <br>";
				}

			} else{
				//CPF INFORMADO NAO É DO FORMATO NUMERICO
				echo "O CPF informado não é do formato numérico! <br>"; 
			}
		}

	} //Fim do escopo do metodo validaCPF()

	public function getCPF(){
		echo "O atributo cpf contém: [$this->cpf] "; 
	}

	public function calculaIMC()
	{
		if (($this->peso == '') || ($this->altura == '')) {
			echo "Por favor, forneça peso e altura corretamente. <br> "; 

		} else{

			if (is_numeric($this->peso)) {
				
				$imc = $this->peso / pow($this->altura, 2); 

				if ($this->nome == '') {
					echo "O seu IMC é: $imc. <br>";	
				} else{
					echo "$this->nome, seu IMC é: $imc. <br>";	
				}
				

				if ($imc < 18.5) {
					echo "Você está <b> abaixo do peso. </b> <br>";
				} elseif (($imc >= 18.5) && ($imc < 25)) {
					echo "Você está no <b> peso normal. </b> <br>";
				} elseif (($imc >= 25) && ($imc < 30)) {
					echo "Você está com <b> sobrepeso. </b> <br>";
				} elseif (($imc >= 30) && ($imc < 35)) {
					echo "Você está com <b> obesidade grau 1. </b> ";
				} elseif (($imc >= 35) && ($imc < 40)) {
					echo "Você está com <b> obesidade grau 2. </b> ";
				} else{
					echo "Você está com <b> obesidade grau 3. </b> ";
				}


			} else{
				echo "O peso informado não é um número! <br>";
			}
		}
	} //Fim do escopo do metodo calculaIMC()

	public function calculaIdade()
	{
		if ($this->data_nascimento == '') {
			echo "Por favor, forneça a data de nascimento. <br> ";

		} else{
			date_default_timezone_set('America/Sao_Paulo'); 
			setlocale(LC_TIME, 'pt-BR'); 
			$dataHoje = date('Y-m-d'); 

			$hoje = explode('-', $dataHoje); 

			$data = explode('-', $this->data_nascimento);  

			$diferenca = $hoje[0] - $data[0]; 

			if ($data[1] > $hoje[1]) {
				$diferenca--; 
			} elseif ($data[2] > $hoje[2]) {
				$diferenca--; 
			}

			if ($this->nome == '') {
				echo "<p> Você tem $diferenca anos. </p>"; 
			} else{
				echo "<p> $this->nome tem $diferenca anos. </p>"; 
			}

			//DIA DO ANIVERSARIO
			if (($data[1] == $hoje[1]) && ($data[2] == $hoje[2])) {
				echo "Aliás, hoje é seu aniversário. <b> Parabéns!!! </b> <br> ";
			}

		}

	} //Fim do escopo do metodo calculaIdade()	

} //Fim do escopo da classe Pessoa

<?php

require_once('class.conexao.php');

class Arte{

	private $codigo_arte;
    
	private $codigo_secao;
	private $codigo_evento;	

	private $tipo_obra;    
	private $tipo_apresentacao;
	private $titulo; 
	private $descricao; 
    
	private $altura; 
	private $largura; 
	private $profundidade;
    
	
	
	public function __construct()
	{
		$this->set_codigo_secao(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_codigo_arte(NULL);
		$this->set_tipo_obra(NULL);
		$this->set_tipo_apresentacao(NULL);
		$this->set_titulo(NULL);
		$this->set_descricao(NULL);
		$this->set_altura(NULL);
		$this->set_largura(NULL);
		$this->set_profundidade(NULL);
	}
	


	//setters
	public function set_codigo_secao($codigo_secao){$this->codigo_secao = $codigo_secao;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_arte($codigo_arte){$this->codigo_arte = $codigo_arte;}
	public function set_tipo_obra($tipo){$this->tipo_obra = $tipo;}
	public function set_tipo_apresentacao($tipo){$this->tipo_apresentacao = $tipo;}
	public function set_titulo($titulo){$this->titulo = $titulo;}
	public function set_descricao($descricao){$this->descricao = $descricao;}
	public function set_altura($altura){$this->altura = $altura;}
	public function set_largura($largura){$this->largura = $largura;}
	public function set_profundidade($profundidade){$this->profundidade = $profundidade;}

	//getters
	public function get_codigo_secao(){return $this->codigo_secao;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_arte(){return $this->codigo_arte;}
	public function get_tipo_obra(){return $this->tipo_obra;}
	public function get_tipo_apresentacao(){return $this->tipo_apresentacao;}
	public function get_titulo(){return $this->titulo;}
	public function get_descricao(){return $this->descricao;}
	public function get_altura(){return $this->altura;}
	public function get_largura(){return $this->largura;}
	public function get_profundidade(){return $this->profundidade;}
	
	public function find_by_codigo($codigo_arte){

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Arte WHERE codigo_arte='$codigo_arte'");

		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_secao(mysql_result($consulta,0,'codigo_secao'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));
			$this->set_tipo_obra(mysql_result($consulta,0,'tipo_obra'));
			$this->set_tipo_apresentacao(mysql_result($consulta,0,'tipo_apresentacao'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_altura(mysql_result($consulta,0,'altura'));
			$this->set_largura(mysql_result($consulta,0,'largura'));
			$this->set_profundidade(mysql_result($consulta,0,'profundidade'));
			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}



	public static function find_by_evento_secao($codigo_evento, $codigo_secao)
	{

		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Arte WHERE codigo_evento = '$codigo_evento' AND codigo_secao = '$codigo_secao'");
		$conexao = null;
		
		return $consulta;
	}

    

	public function insert()
	{
		$conexao = new Conexao();
	
		$sql = "INSERT INTO Arte (codigo_secao, codigo_evento, tipo_obra, tipo_apresentacao, titulo, descricao, altura, largura, profundidade) VALUES ('$this->codigo_secao', '$this->codigo_evento', '$this->tipo_obra', '$this->tipo_apresentacao', '$this->titulo', '$this->descricao', '$this->altura', '$this->largura', '$this->profundidade');";


		

		//echo $sql;
		
		if($conexao->db_update($sql)){
			//echo "Inserido<br>";

   			$consulta = $conexao->db_query("SELECT MAX(codigo_arte) as codigo_arte FROM Arte");
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));

			$conexao = null;
			
			return True;
		}
		else{
			//echo "Erro na Insercao<br>";
			$conexao = null;
			return False;
		}
		
	}

	public function update(){
		$conexao = new Conexao();

		$sql = "UPDATE Arte SET codigo_secao = '$this->codigo_secao', codigo_evento = '$this->codigo_evento', tipo_obra = '$this->tipo_obra', tipo_apresentacao = '$this->tipo_apresentacao', titulo = '$this->titulo', descricao = '$this->descricao', altura = '$this->altura', largura = '$this->largura', profundidade = '$this->profundidade' 
		WHERE codigo_arte = $this->codigo_arte";

		//echo $sql;

		
		if($conexao->db_update($sql)){
			//echo "Atualizado<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Atualizacao<br>";
			$conexao = null;
			return False;
		}
	}
	
	public function remove(){
		$conexao = new Conexao();

		$sql = "DELETE FROM Arte WHERE codigo_arte = $this->codigo_arte and codigo_evento = $this->codigo_evento";

		//echo $sql;
		
		if($conexao->db_update($sql)){
			//echo "Removido<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Remocao<br>";
			$conexao = null;
			return False;
		}
	}


	
}


?>

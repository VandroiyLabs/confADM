<?php

require_once('class.conexao.php');

class Resumo
{

    private $codigo_resumo;

	private $lingua;
	private $codigo_evento;
	private $codigo_pessoa;

	// tempo que desenvolve este trabalho (sifsc)
    private $tempo;
	// Se é ou não em ingles (sifsc)
	private $ingles;
	// Titulo do Resumo
	private $titulo;
	// Texto do resumo
	private $titulo_html;
	private $texto;

	// Palavras-chave
	private $kw1;
	private $kw2;
	private $kw3;

	// Referências
	private $tipo_ref1;
	private $autor1;
	private $titulo1;
	private $info1;

	private $tipo_ref2;
	private $autor2;
	private $titulo2;
	private $info2;

	private $tipo_ref3;
	private $autor3;
	private $titulo3;
	private $info3;

	private $email;
	private $autor_principal;



	public function __construct()
	{
		$this->set_lingua(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_resumo(NULL);
		$this->set_tempo(NULL);
		$this->set_ingles(NULL);
		$this->set_titulo(NULL);
		$this->set_texto(NULL);
		$this->set_kw1(NULL);
		$this->set_kw2(NULL);
		$this->set_kw3(NULL);
		$this->set_tipo_ref1(NULL);
		$this->set_autor1(NULL);
		$this->set_titulo1(NULL);
		$this->set_info1(NULL);
		$this->set_tipo_ref2(NULL);
		$this->set_autor2(NULL);
		$this->set_titulo2(NULL);
		$this->set_info2(NULL);
		$this->set_tipo_ref3(NULL);
		$this->set_autor3(NULL);
		$this->set_titulo3(NULL);
		$this->set_info3(NULL);
		$this->set_email(NULL);
		$this->set_autor_principal(NULL);
		$this->set_titulo_html(NULL);
	}



	//setters
	public function set_lingua($lingua){$this->lingua = $lingua;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_resumo($codigo_resumo){$this->codigo_resumo = $codigo_resumo;}
	public function set_tempo($tempo){$this->tempo = $tempo;}
	public function set_ingles($ingles){$this->ingles = $ingles;}
	public function set_titulo($titulo){$this->titulo = $titulo;}
	public function set_titulo_html($titulo){$this->titulo_html = $titulo;}
	public function set_texto($texto){$this->texto = $texto;}
	public function set_kw1($kw1){$this->kw1 = $kw1;}
	public function set_kw2($kw2){$this->kw2 = $kw2;}
	public function set_kw3($kw3){$this->kw3 = $kw3;}
	public function set_tipo_ref1($tipo_ref1){$this->tipo_ref1 = $tipo_ref1;}
	public function set_autor1($autor1){$this->autor1 = $autor1;}
	public function set_titulo1($titulo1){$this->titulo1 = $titulo1;}
	public function set_info1($info1){$this->info1 = $info1;}
	public function set_tipo_ref2($tipo_ref2){$this->tipo_ref2 = $tipo_ref2;}
	public function set_autor2($autor2){$this->autor2 = $autor2;}
	public function set_titulo2($titulo2){$this->titulo2 = $titulo2;}
	public function set_info2($info2){$this->info2 = $info2;}
	public function set_tipo_ref3($tipo_ref3){$this->tipo_ref3 = $tipo_ref3;}
	public function set_autor3($autor3){$this->autor3 = $autor3;}
	public function set_titulo3($titulo3){$this->titulo3 = $titulo3;}
	public function set_info3($info3){$this->info3 = $info3;}
	public function set_email($email){$this->email = $email;}
	public function set_autor_principal($autor_principal){$this->autor_principal = $autor_principal;}

	//getters
	public function get_lingua(){return $this->lingua;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_resumo(){return $this->codigo_resumo;}
	public function get_tempo(){return $this->tempo;}
	public function get_ingles(){return $this->ingles;}
	public function get_titulo(){return $this->titulo;}
	public function get_titulo_html(){return $this->titulo_html;}
	public function get_texto(){return $this->texto;}
	public function get_kw1(){return $this->kw1;}
	public function get_kw2(){return $this->kw2;}
	public function get_kw3(){return $this->kw3;}
	public function get_tipo_ref1(){return $this->tipo_ref1;}
	public function get_autor1(){return $this->autor1;}
	public function get_titulo1(){return $this->titulo1;}
	public function get_info1(){return $this->info1;}
	public function get_tipo_ref2(){return $this->tipo_ref2;}
	public function get_autor2(){return $this->autor2;}
	public function get_titulo2(){return $this->titulo2;}
	public function get_info2(){return $this->info2;}
	public function get_tipo_ref3(){return $this->tipo_ref3;}
	public function get_autor3(){return $this->autor3;}
	public function get_titulo3(){return $this->titulo3;}
	public function get_info3(){return $this->info3;}
	public function get_email(){return $this->email;}
	public function get_autor_principal(){return $this->autor_principal;}

	public function find_by_codigo($codigo_resumo)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Resumo WHERE codigo_resumo='$codigo_resumo'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_lingua(mysql_result($consulta,0,'lingua'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_tempo(mysql_result($consulta,0,'tempo'));
			$this->set_ingles(mysql_result($consulta,0,'ingles'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_titulo_html(mysql_result($consulta,0,'titulo_html'));
			$this->set_texto(mysql_result($consulta,0,'texto'));
			$this->set_kw1(mysql_result($consulta,0,'kw1'));
			$this->set_kw2(mysql_result($consulta,0,'kw2'));
			$this->set_kw3(mysql_result($consulta,0,'kw3'));
			$this->set_tipo_ref1(mysql_result($consulta,0,'tipo_ref1'));
			$this->set_autor1(mysql_result($consulta,0,'autor1'));
			$this->set_titulo1(mysql_result($consulta,0,'titulo1'));
			$this->set_info1(mysql_result($consulta,0,'info1'));
			$this->set_tipo_ref2(mysql_result($consulta,0,'tipo_ref2'));
			$this->set_autor2(mysql_result($consulta,0,'autor2'));
			$this->set_titulo2(mysql_result($consulta,0,'titulo2'));
			$this->set_info2(mysql_result($consulta,0,'info2'));
			$this->set_tipo_ref3(mysql_result($consulta,0,'tipo_ref3'));
			$this->set_autor3(mysql_result($consulta,0,'autor3'));
			$this->set_titulo3(mysql_result($consulta,0,'titulo3'));
			$this->set_info3(mysql_result($consulta,0,'info3'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_autor_principal(mysql_result($consulta,0,'autor_principal'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}


	public function find_by_codigo_ingles($codigo_resumo, $ingles)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Resumo WHERE codigo_resumo='$codigo_resumo' and ingles='$ingles'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_lingua(mysql_result($consulta,0,'lingua'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_tempo(mysql_result($consulta,0,'tempo'));
			$this->set_ingles(mysql_result($consulta,0,'ingles'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_titulo_html(mysql_result($consulta,0,'titulo_html'));
			$this->set_texto(mysql_result($consulta,0,'texto'));
			$this->set_kw1(mysql_result($consulta,0,'kw1'));
			$this->set_kw2(mysql_result($consulta,0,'kw2'));
			$this->set_kw3(mysql_result($consulta,0,'kw3'));
			$this->set_tipo_ref1(mysql_result($consulta,0,'tipo_ref1'));
			$this->set_autor1(mysql_result($consulta,0,'autor1'));
			$this->set_titulo1(mysql_result($consulta,0,'titulo1'));
			$this->set_info1(mysql_result($consulta,0,'info1'));
			$this->set_tipo_ref2(mysql_result($consulta,0,'tipo_ref2'));
			$this->set_autor2(mysql_result($consulta,0,'autor2'));
			$this->set_titulo2(mysql_result($consulta,0,'titulo2'));
			$this->set_info2(mysql_result($consulta,0,'info2'));
			$this->set_tipo_ref3(mysql_result($consulta,0,'tipo_ref3'));
			$this->set_autor3(mysql_result($consulta,0,'autor3'));
			$this->set_titulo3(mysql_result($consulta,0,'titulo3'));
			$this->set_info3(mysql_result($consulta,0,'info3'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_autor_principal(mysql_result($consulta,0,'autor_principal'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else
		{
			$conexao = null;
			return False;
		};
	}





	public static function find_by_evento_secao($codigo_evento, $lingua)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Resumo WHERE codigo_evento = '$codigo_evento' AND lingua = '$lingua'");
		$conexao = null;

		return $consulta;
	}
	public static function find_all_by_evento_pt($codigo_evento,$filtro)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT codigo_resumo, titulo_html FROM Resumo WHERE ingles = 0 and codigo_evento = $codigo_evento ".$filtro." order by codigo_resumo");
		$conexao = null;

		return $consulta;
	}


	public static function checkBackups($codigo_evento)
	{
		$conexao = new Conexao();

		$sql= "SELECT r.codigo_resumo codigo_resumo, r.codigo_pessoa codigo_pessoa, UPPER(convert(cast(convert(r.titulo using latin1) as binary) using utf8)) titulo,  UPPER(convert(cast(convert(b.titulo using latin1) as binary) using utf8)) titulo_back FROM Resumo r, Backup_Resumo b WHERE r.codigo_resumo = b.codigo_resumo
and UPPER(convert(cast(convert(b.titulo using latin1) as binary) using utf8)) <> UPPER(convert(cast(convert(r.titulo using latin1) as binary) using utf8)) and r.codigo_evento =$codigo_evento order by r.codigo_resumo";
		$consulta = $conexao->db_query($sql);
		$conexao = null;

		return $consulta;
	}

	public function insert()
	{
		$conexao = new Conexao();

		if(get_magic_quotes_gpc())
		{
			$sql = "INSERT INTO Resumo (lingua, codigo_evento, codigo_pessoa, tempo, ingles, titulo, texto, kw1, kw2, kw3, tipo_ref1, autor1, titulo1, info1, tipo_ref2, autor2, titulo2, info2, tipo_ref3, autor3, titulo3, info3, email, autor_principal) VALUES ('$this->lingua', '$this->codigo_evento', '$this->codigo_pessoa', '$this->tempo',  '$this->ingles', '$this->titulo', '$this->texto', '$this->kw1', '$this->kw2', '$this->kw3', '$this->tipo_ref1', '$this->autor1', '$this->titulo1', '$this->info1', '$this->tipo_ref2', '$this->autor2', '$this->titulo2', '$this->info2', '$this->tipo_ref3', '$this->autor3', '$this->titulo3', '$this->info3', '$this->email', '$this->autor_principal');";
		}
		else
		{
			$sql = "INSERT INTO Resumo (codigo_resumo,lingua, codigo_evento, codigo_pessoa, tempo, ingles, titulo, texto, kw1, kw2, kw3, tipo_ref1, autor1, titulo1, info1, tipo_ref2, autor2, titulo2, info2, tipo_ref3, autor3, titulo3, info3, email, autor_principal) VALUES ('".mysql_real_escape_string($this->codigo_resumo)."', '".mysql_real_escape_string($this->lingua)."', '".mysql_real_escape_string($this->codigo_evento)."',   '".mysql_real_escape_string($this->codigo_pessoa)."', '".mysql_real_escape_string($this->tempo)."', '".mysql_real_escape_string($this->ingles)."', '".mysql_real_escape_string($this->titulo)."', '".mysql_real_escape_string($this->texto)."', '".mysql_real_escape_string($this->kw1)."', '".mysql_real_escape_string($this->kw2)."', '".mysql_real_escape_string($this->kw3)."', '".mysql_real_escape_string($this->tipo_ref1)."', '".mysql_real_escape_string($this->autor1)."', '".mysql_real_escape_string($this->titulo1)."', '".mysql_real_escape_string($this->info1)."', '".mysql_real_escape_string($this->tipo_ref2)."', '".mysql_real_escape_string($this->autor2)."', '".mysql_real_escape_string($this->titulo2)."', '".mysql_real_escape_string($this->info2)."', '".mysql_real_escape_string($this->tipo_ref3)."',  '".mysql_real_escape_string($this->autor3)."', '".mysql_real_escape_string($this->titulo3)."', '".mysql_real_escape_string($this->info3)."',  '".mysql_real_escape_string($this->email)."', '".mysql_real_escape_string($this->autor_principal)."');";

		}




		if($conexao->db_update($sql))
		{
			$consulta = $conexao->db_query("SELECT codigo_resumo FROM Resumo WHERE codigo_pessoa='$this->codigo_pessoa' AND codigo_evento='$this->codigo_evento' AND ingles='$this->ingles'");
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));

			$conexao = null;

			return True;
		}
		else
    {
			$conexao = null;
			return False;
		}

	}

	public function insert_backup($autores)
	{
		$conexao = new Conexao();

		//Backup sempre tem que ter scape pq não vem de formulário
		$sql = "INSERT INTO Backup_Resumo (codigo_resumo,lingua, codigo_evento, codigo_pessoa, tempo, ingles, titulo, texto, kw1, kw2, kw3, tipo_ref1, autor1, titulo1, info1, tipo_ref2, autor2, titulo2, info2, tipo_ref3, autor3, titulo3, info3, email, autor_principal, autores) VALUES ('".mysql_real_escape_string($this->codigo_resumo)."', '".mysql_real_escape_string($this->lingua)."', '".mysql_real_escape_string($this->codigo_evento)."',   '".mysql_real_escape_string($this->codigo_pessoa)."', '".mysql_real_escape_string($this->tempo)."', '".mysql_real_escape_string($this->ingles)."', '".mysql_real_escape_string($this->titulo)."', '".mysql_real_escape_string($this->texto)."', '".mysql_real_escape_string($this->kw1)."', '".mysql_real_escape_string($this->kw2)."', '".mysql_real_escape_string($this->kw3)."', '".mysql_real_escape_string($this->tipo_ref1)."', '".mysql_real_escape_string($this->autor1)."', '".mysql_real_escape_string($this->titulo1)."', '".mysql_real_escape_string($this->info1)."', '".mysql_real_escape_string($this->tipo_ref2)."', '".mysql_real_escape_string($this->autor2)."', '".mysql_real_escape_string($this->titulo2)."', '".mysql_real_escape_string($this->info2)."', '".mysql_real_escape_string($this->tipo_ref3)."',  '".mysql_real_escape_string($this->autor3)."', '".mysql_real_escape_string($this->titulo3)."', '".mysql_real_escape_string($this->info3)."',  '".mysql_real_escape_string($this->email)."', '".mysql_real_escape_string($this->autor_principal)."', '".mysql_real_escape_string($autores)."');";


		if($conexao->db_update($sql))
		{
			$conexao = null;
			return True;
		}
		else
    {
			$conexao = null;
			return False;
		}

	}


	public function update()
	{
		$conexao = new Conexao();

		if(get_magic_quotes_gpc())
		{
		$sql = "UPDATE Resumo SET lingua = '$this->lingua', codigo_evento = '$this->codigo_evento', codigo_pessoa = '$this->codigo_pessoa', tempo = '$this->tempo', ingles = '$this->ingles', titulo = '$this->titulo', texto = '$this->texto', kw1 = '$this->kw1', kw2 = '$this->kw2', kw3 = '$this->kw3', tipo_ref1 = '$this->tipo_ref1', autor1 = '$this->autor1', titulo1 = '$this->titulo1', info1 = '$this->info1', tipo_ref2 = '$this->tipo_ref2', autor2 ='$this->autor2', titulo2 ='$this->titulo2', info2 ='$this->info2', tipo_ref3 = '$this->tipo_ref3', autor3 = '$this->autor3', titulo3 = '$this->titulo3', info3 = '$this->info3', email = '$this->email', autor_principal = '$this->autor_principal' WHERE codigo_resumo = $this->codigo_resumo";
		}
		else
		{

		$sql = "UPDATE Resumo SET lingua = '$this->lingua', codigo_evento = '$this->codigo_evento', codigo_pessoa = '$this->codigo_pessoa', tempo = '$this->tempo', ingles = '$this->ingles', titulo = '".mysql_real_escape_string($this->titulo)."', texto = '".mysql_real_escape_string($this->texto)."', kw1 = '".mysql_real_escape_string($this->kw1)."', kw2 = '".mysql_real_escape_string($this->kw2)."', kw3 = '".mysql_real_escape_string($this->kw3)."', tipo_ref1 = '$this->tipo_ref1', autor1 = '".mysql_real_escape_string($this->autor1)."', titulo1 = '".mysql_real_escape_string($this->titulo1)."', info1 = '".mysql_real_escape_string($this->info1)."', tipo_ref2 = '$this->tipo_ref2', autor2 ='".mysql_real_escape_string($this->autor2)."', titulo2 ='".mysql_real_escape_string($this->titulo2)."', info2 ='".mysql_real_escape_string($this->info2)."', tipo_ref3 = '$this->tipo_ref3', autor3 = '".mysql_real_escape_string($this->autor3)."', titulo3 = '".mysql_real_escape_string($this->titulo3)."', info3 = '".mysql_real_escape_string($this->info3)."', email = '".mysql_real_escape_string($this->email)."', autor_principal = '$this->autor_principal' WHERE codigo_resumo = $this->codigo_resumo";
		}


		if($conexao->db_update($sql))
    {
			$conexao = null;
			return True;
		}
		else
    {
			$conexao = null;
			return False;
		}
	}

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Resumo WHERE codigo_resumo = $this->codigo_resumo";

		if($conexao->db_update($sql))
    {
			$conexao = null;
			return True;
		}
		else
    {
			$conexao = null;
			return False;
		}
	}

}


?>

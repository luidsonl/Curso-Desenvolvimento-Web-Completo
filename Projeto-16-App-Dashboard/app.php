<?php
//Classe dashboard
class Dashboard {
	public $data_inicio;
	public $data_fim;
	public $numero_vendas;
	public $total_vendas;
/*
	public $clientes_ativos;
	public $clientes_inativos;
	public $total_reclamacoes;
	public $total_elogios;
	public $total_sugestoes;
	public $total_despesas;
*/

	public function __get($atr){
		return $this->$atr;
	}

	public function __set($atr, $valor){
		$this->$atr = $valor;
		return $this;
	}
}
// Classe de conexão com o banco de dados
class conexao{
	private $host = 'localhost';
	private $dbname = 'dashboard';
	private $user = 'root';
	private $pass = '';

	public function conectar(){
		try{
			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"
			);
			$conexao->exec('set charset utf8');

			return $conexao;


		}catch(PDOException $e){
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
}
//Classe (model)
class Bd{
	private $conexao;
	private $dashboard;

	public function __construct(Conexao $conexao, Dashboard $dashboard){
		$this->conexao = $conexao->conectar();
		$this->dashboard = $dashboard;
	}

	public function getNumeroVendas(){
		$query = '
			select
				count(*) as numero_vendas
			from
				tb_vendas
			where data_venda between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;
	}

	public function getTotalVendas(){
		$query = '
			select
				sum(total) as total_vendas
			from
				tb_vendas
			where data_venda between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;
	}
}

// Lógica do script
$dashboard = new Dashboard();
$conexao = new Conexao();
$bd = new Bd($conexao, $dashboard);

$dashboard->__set('data_inicio', '2018-08-01');
$dashboard->__set('data_fim', '2018-08-31');
$dashboard->__set('numero_vendas', $bd->getNumeroVendas());
$dashboard->__set('total_vendas', $bd->getTotalVendas());

print_r($dashboard);

?>
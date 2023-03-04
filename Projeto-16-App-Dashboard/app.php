<?php
//Classe dashboard
class Dashboard {
	public $data_inicio;
	public $data_fim;
	public $numero_vendas;
	public $total_vendas;

	public $clientes_ativos;
	public $clientes_inativos;
	public $numero_reclamacoes;
	public $numero_elogios;
	public $numero_sugestoes;
	public $total_despesas;


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

	public function getTotalDespesas(){
		$query = '
			select
				sum(total) as total_despesas
			from
				tb_despesas
			where data_despesa between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_despesas;
	}

	public function getNumeroClientesAtivos(){
		$query = '
			select
				count(*) as total_clientes_ativos
			from
				tb_clientes
			where cliente_ativo = 1';

		$stmt = $this->conexao->prepare($query);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_clientes_ativos;
	}

	public function getNumeroClientesInativos(){
		$query = '
			select
				count(*) as total_clientes_ativos
			from
				tb_clientes
			where cliente_ativo = 0';

		$stmt = $this->conexao->prepare($query);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_clientes_ativos;
	}

	public function getNumeroReclamacoes(){
		$query = '
			select
				count(*) as numero_reclamacoes
			from
				tb_contatos
			where tipo_contato = 1 and data_contato between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->numero_reclamacoes;
	}

	public function getNumeroSugestoes(){
		$query = '
			select
				count(*) as numero_sugestoes
			from
				tb_contatos
			where tipo_contato = 2 and data_contato between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->numero_sugestoes;
	}

	public function getNumeroElogios(){
		$query = '
			select
				count(*) as numero_elogios
			from
				tb_contatos
			where tipo_contato = 3 and data_contato between :data_inicio and :data_fim';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
		$stmt->bindValue(':data_fim',$this->dashboard->__get('data_fim'));
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->numero_elogios;
	}

}

// Lógica do script
$dashboard = new Dashboard();
$conexao = new Conexao();
$bd = new Bd($conexao, $dashboard);



$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];

// Esses valores servirão como padrão
$dashboard->__set('numero_vendas', '?');
$dashboard->__set('total_vendas', '?');
$dashboard->__set('total_despesas', '?');
$dashboard->__set('numero_reclamacoes', '?');
$dashboard->__set('numero_sugestoes', '?');
$dashboard->__set('numero_elogios', '?');

// Irá definir os valores se a informação do mês for preenchida
if ($ano && $mes) {
	$dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

	$dashboard->__set('data_inicio', $ano . '-' . $mes . '-01');
	$dashboard->__set('data_fim', $ano . '-' . $mes . '-' . $dias_do_mes);
	
	$dashboard->__set('numero_vendas', $bd->getNumeroVendas());
	$dashboard->__set('total_vendas', $bd->getTotalVendas());
	$dashboard->__set('total_despesas', $bd->getTotalDespesas());

	$dashboard->__set('numero_reclamacoes', $bd->getNumeroReclamacoes());
	$dashboard->__set('numero_sugestoes', $bd->getNumeroSugestoes());
	$dashboard->__set('numero_elogios', $bd->getNumeroElogios());

	// Se o total de vendas ficar como null, ele será definido como 0
	if ($dashboard->__get('total_vendas') == null){
		$dashboard->__set('total_vendas', 0);
	}

	if ($dashboard->__get('total_despesas') == null){
		$dashboard->__set('total_despesas', 0);
	}



}

$dashboard->__set('clientes_ativos', $bd->getNumeroClientesAtivos());
$dashboard->__set('clientes_inativos', $bd->getNumeroClientesInativos());


echo json_encode($dashboard);

?>
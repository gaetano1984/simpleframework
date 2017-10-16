<?php

	namespace app\Repository;

	use Aura\SqlQuery\QueryFactory;

	class Repository{
		public function __construct(){
			global $config_db;
			$this->factory = new QueryFactory($config_db['driver']);
		}
		public function softDelete($table, $id){
			global $app;

			$upd = $this->factory->newUpdate();
			$upd->table($table)
				->set('deleted_at', 'NOW()')
				->where('id = :id')
				->bindValues([
					'id' => intval($id)
				]);
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": cancello recordo dalla tabella ".$table);	
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": ".$upd->getStatement());
			$sth = $app->db->prepare($upd->getStatement());
			$sth->execute($upd->getBindValues());
		}
	}

?>
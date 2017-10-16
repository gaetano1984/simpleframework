<?php

	namespace app\Repository;

	use app\Repository\Repository;

	class UserRepository extends Repository{
		public $table = 'users';
		public function userList(){
			global $app;
			$select = $this->factory->newSelect();
			$select
				->cols(['*'])
				->from($this->table)
				->where('deleted_at is null');
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": recupero la lista di creazione utente");	
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": ".$select->getStatement());
			$sth = $app->db->prepare($select->getStatement());
			$sth->execute();
			$res = $sth->fetchAll(\PDO::FETCH_ASSOC);
			return $res;
		}
		public function create($data){
			global $app;
			$insert = $this->factory->newInsert();
			$insert
				->into($this->table)
				->cols(array_keys($data))
				->bindValues($data);
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": creo il nuovo utente");	
			$app->log->db->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": ".$insert->getStatement());
			$sth = $app->db->prepare($insert->getStatement());
			$res = $sth->execute($insert->getBindValues());
			return $res;
		}
		public function delete($data){
			$this->softDelete($this->table, $data['id']);
		}
	}

?>
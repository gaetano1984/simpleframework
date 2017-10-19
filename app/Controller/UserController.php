<?php

	namespace app\Controller;

	use app\Controller\Controller;
	use app\Repository\UserRepository;
	use app\Validation\User\validationCreate as validationCreate;
	use Nette\Caching\Cache as Cache;

	class UserController extends Controller{
		public function __construct(){
			$this->repos = new UserRepository();
		}
		public function list(){
			global $app;
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": recupero la lista degli utenti");
			$res = $this->repos->userList();
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": ".count($res)." utenti trovati");
			$html =  $app->twig->load('user/list.php');
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
			echo $html->render(['title' => 'Lista Utenti', 'users' => $res]);
		}
		public function formCreate(){
			global $app;
			$html = $app->twig->load('user/create.php');
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
			echo $html->render();
		}
		public function create($request){
			global $app;
			$v = new validationCreate();
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": valido la richiesta di creazione utente");
			$res = $v->validate($request);
			if(is_int($res)){
				$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": i dati inseriti sonon validi, procedo con la creazione");
				$this->repos->create($request->all());
				$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": carico la vista di creazione_ok");
				$html = $app->twig->load('user/creation_ok.php');
				$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
				echo $html->render();
			}
			else{
				$app->log->general->error(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": i dati inseriti non sono valido");
				$html = $app->twig->load('user/create.php');
				$app->log->general->error(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": carico il template di creazione utente evidenzindo i campi con errori");
				$app->log->general->error(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
				echo $html->render(['err_mess' => $res]);
			}
		}
		public function delete($request){
			global $app;
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": cancello utente");
			$this->repos->delete($request->all());
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": carico la vista di cancellazione avvenuta");
			$html = $app->twig->load('user/delete_ok.php');
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
			echo $html->render();
		}
		public function userList_pdf(){
			global $app;
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": recupero la list degli utenti");
			$res = $this->repos->userList();			
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": ".count($res)." utenti trovati");
			$html =  $app->twig->load('user/list.php');
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": renderizzo il template");
			$html_pdf = $html->render(['title' => 'Lista Utenti', 'users' => $res]);
			$app->log->general->info(date('Y-m-d H:i:s')." ".__CLASS__."=>".__FUNCTION__.": esport la lista in formato pdf");
			$this->exportPdf($html_pdf);
		}
		public function userList_xls(){
			$arr = $this->repos->userList();			
			$this->exportXls($arr, 'user');
		}
		public function insertFake(){
			global $app;
			for($i=0; $i<1000; $i++){
				$data = [
					'name' => \Faker\Name::firstname()
					,'surname' => \Faker\Name::lastname()
					,'email' => \Faker\Internet::email()
				];
				$this->repos->create($data);
			}
			$html = $app->twig->load('user/creation_ok.php');
			echo $html->render();
		}
	}

?>
<?php

	global $app;
	global $request;

	$app = new Config();

	use Phroute\Phroute\RouteCollector;
	use app\Controller\UserController;
	use Illuminate\Http\Request;

	$request = Request::capture();

	$r = new RouteCollector();
	$r->group(['prefix' => 'index.php'], function($r) use ($request){
		$r->group(['prefix' => 'users'], function($r) use ($request){
			$u = new UserController();
			$r->get('list', function() use ($u){
				$u->list();
			});
			$r->get('create', function() use ($u){
				$u->formCreate();
			});
			$r->post('create', function() use ($u, $request){
				$u->create($request);
			});
			$r->post('delete', function() use ($u, $request){
				$u->delete($request);
			});
			$r->get('exportpdf', function() use ($u){
				$u->userList_pdf();
			});
			$r->get('exportxls', function() use ($u){
				$u->userList_xls();
			});
			$r->get('fake', function() use ($u){
				$u->insertFake();
			});
		});
	});

	try{
		$dispatcher = new Phroute\Phroute\Dispatcher($r->getData());
		$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	} catch(Phroute\Phroute\Exception\HttpRouteNotFoundException $e){
		$app->log->access_error->warning('404: Route '.$_SERVER['REQUEST_URI'].' not found');
		echo $app->twig->load('errors/404.php')->render();
	} catch(Phroute\Phroute\Exception\HttpMethodNotAllowedException $e){
		$app->log->access_error->warning('403: Route '.$_SERVER['REQUEST_URI'].' method not allowed');
		echo $app->twig->load('errors/403.php')->render();
	}
	
?>
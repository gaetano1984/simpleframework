<?php

	require_once('./config/twig.php');
	require_once('./config/database.php');
	require_once('./config/logger.php');

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Monolog\Logger as Logger;
	use Monolog\Handler\StreamHandler;
	use Dompdf\Dompdf;
	use Box\Spout\Writer\WriterFactory;
	use Box\Spout\Common\Type;
	use Bramus\Monolog\Formatter\ColoredLineFormatter;

	class Config{
		public function __construct(){
			$this->twig = $this->setTwig();
			$this->db = $this->setDB();
			$this->log = $this->setLogger();
			$this->pdf = $this->setPdf();
			$this->excel = $this->setExcel();
			$this->includeAll('./app');
		}
		public function setTwig(){
			global $twig_config;
			$loader = new Twig_Loader_Filesystem($twig_config['tpl_dir']);
			$twig = new Twig_Environment($loader, [
				'cache' => $twig_config['cache']
			]);
			return $twig;
		}
		public function setDB(){
			global $config_db;
			try{
				$dsn = 'mysql:dbname='.$config_db['database'].';host='.$config_db['host'];
				$pdo = new \PDO($dsn, 'root', 'root');
				return $pdo;
			}
			catch(PDOException $e){
				echo $e->getMessage();
				die();
			}
		}
		public function setLogger(){
			global $config_log;	
			$logger = new stdClass();
			
			$log = new Logger('general');
			$handler = new StreamHandler($config_log['general_log'], Logger::INFO);
			$handler->setFormatter(new ColoredLineFormatter());
			$log->pushHandler($handler);
			$logger->general = $log;

			$log = new Logger('db');
			$handler = new StreamHandler($config_log['db_log'], Logger::INFO);
			$handler->setFormatter(new ColoredLineFormatter());
			$log->pushHandler($handler);
			$logger->db = $log;

			$log = new Logger('access_error');
			$handler = new StreamHandler($config_log['access_error_log'], Logger::INFO);
			$handler->setFormatter(new ColoredLineFormatter());
			$log->pushHandler($handler);
			$logger->access_error = $log;			

			return $logger;
		}
		public function setPdf(){
			$pdf = new Dompdf();
			return $pdf;
		}
		public function setExcel(){
			$excel = WriterFactory::create(Type::CSV); 
			return $excel;
		}
		public function includeAll($dir){
			$it = new RecursiveDirectoryIterator($dir);
			foreach(new RecursiveIteratorIterator($it) as $file) {
				if(!$it->isDot() && pathinfo($file, PATHINFO_EXTENSION) == 'php'){
					require_once($file);
				}
			}
		}
	}

?>
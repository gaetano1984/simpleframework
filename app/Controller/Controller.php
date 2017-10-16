<?php

	namespace app\Controller;

	class Controller{
		public function __construct(){

		}
		public function exportPdf($html_pdf){
			global $app;
			$app->pdf->loadHtml($html_pdf);
			$app->pdf->render();
			$app->pdf->stream();
		}
		public function exportXls($data, $tipo, $ext = 'csv'){
			global $app;
			$writer = $app->excel;
			$filename = "export_".date('YmdHis').".".$ext;
			$writer->openToFile($filename);
			foreach($data as $row){
				$writer->addRow($row);	
			}
			$writer->close();
			$this->downloadExcel($filename);
		}
		public function downloadExcel($filename){
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header("Content-Disposition: attachment;filename=\"$filename\"");
			header("Cache-Control: max-age=0");
		}
	}

?>
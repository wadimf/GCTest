<?php


namespace GC;
require dirname(__DIR__) . '/../libs/vendor/autoload.php';


/**
 * Class PrintSheet
 * @package GC
 */
class PrintSheet {

	private $sheetsData = null;

	public function generatePrintSheet(){

		$this->getInputParams();

		$this->sheetsData->validateInputData();

		$calc = new Calculation();

		$calc->calcSheetsPlacements($this->sheetsData);

		$pdf = new FpdiPdfGenerator();

		$pdf->generatePdf($this->sheetsData);

	}


    private function getInputParams(){

        $cmd = new \Commando\Command();

        $cmd->option('frontSides')
	            ->require()
	            ->expectsFile()
            ->option('backSides')
	            ->require()
	            ->expectsFile()
            ->option('slideWidth')
	            ->require()
            ->option('slideHeight')
	            ->require()

            ->option('output')
	            ->require()

            ->option('printSheetWidth')
	            ->require()
            ->option('printSheetHeight')
	            ->require()

            ->option('rowCnt')
	            ->require()
            ->option('colCnt')
	            ->require()
            ->option('deg')
	            ->require()
	            ->must(function($degree) {
                    $degrees = array('0', '90', '180');
                    return in_array($degree, $degrees);
                })

            ->option('barcodes')
            ->option('barcodeX')
            ->option('barcodeY');

	    $barcodes = null;

	    if(null !== ($cmd['barcodes'])){
		    $barcodes = explode(",", $cmd['barcodes']);
	    }

	    $this->sheetsData = new DataAllSheets(
		                    explode(",", $cmd['frontSides']),
		                    explode(",", $cmd['backSides']),
						    $cmd['slideWidth'],
		                    $cmd['slideHeight'],
		                    $cmd['output'],
		                    $cmd['printSheetWidth'],
		                    $cmd['printSheetHeight'],

		                    $cmd['rowCnt'],
		                    $cmd['colCnt'],

	                        $cmd['deg'],

		                    $barcodes,
	                        $cmd['barcodeX'],
		                    $cmd['barcodeY'],
		                    null
	                    );
    }

} 
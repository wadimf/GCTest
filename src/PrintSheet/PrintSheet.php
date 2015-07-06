<?php


namespace GC;
require dirname(__DIR__) . '/../libs/vendor/autoload.php';


/**
 * Class PrintSheet
 * @package GC
 */
class PrintSheet {

	private $sheetsData = null;
	private $errors = false;
	private $errorMessage = "";

	public function generatePrintSheet(){

		$this->getInputParams();

		$this->validateData();

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

	    $this->sheetsData = AllSheetsFactory::create(
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


	private function setErrorMessage($message){
		$this->errors = true;
		$this->errorMessage .= $message . PHP_EOL;
	}


	private function validateData(){

        if (!$this->errors) {
            if (($this->sheetsData->sizeX > $this->sheetsData->printSheetX) || ($this->sheetsData->sizeY > $this->sheetsData->printSheetY)) {
	            $this->setErrorMessage('Input size is bigger then output size');
            }
        }

	    if (!$this->errors) {
	        if (count($this->sheetsData->frontSides) !== count($this->sheetsData->backSides)){
		        $this->setErrorMessage('Frontsides and backsides amount did not match');
	        }
	    }

	    if ($this->errors){
		    if ($this->$barcodes !== null || $this->$barcodeX !== 0 || $this->$barcodeY !== 0) {
			    $this->setErrorMessage('Barcode generation is not implemented yet');
		    }
	    }

	    if ($this->errors){
		    exit($this->errorMessage);
	    }
    }

} 
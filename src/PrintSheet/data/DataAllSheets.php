<?php

namespace GC;


/**
 * Class DataAllSheets
 * @package GC
 */
class DataAllSheets {
	public $frontSides = null;
	public $backSides = null;
	public $sizeX = 0;
	public $sizeY = 0;
	public $output = "";
	public $printSheetX = 0;
	public $printSheetY = 0;
	public $rowCnt = 0;
	public $colCnt = 0;
	public $deg = 0;
	public $barcodes = null;
	public $barcodeX = 0;
	public $barcodeY = 0;
	public $allSheets = null;

	private $errors = false;
	private $errorMessage = "";

	function __construct( $frontSides, $backSides, $sizeX, $sizeY, $output, $printSheetX, $printSheetY, $rowCnt, $colCnt, $deg, $barcodes, $barcodeX, $barcodeY, $allSheets ) {
		$this->frontSides  = $frontSides;
		$this->backSides   = $backSides;
		$this->sizeX       = $sizeX;
		$this->sizeY       = $sizeY;
		$this->output      = $output;
		$this->printSheetX = $printSheetX;
		$this->printSheetY = $printSheetY;
		$this->rowCnt      = $rowCnt;
		$this->colCnt      = $colCnt;
		$this->deg         = $deg;
		$this->barcodes    = $barcodes;
		$this->barcodeX    = $barcodeX;
		$this->barcodeY    = $barcodeY;
		$this->allSheets   = $allSheets;
	}

	public function validateInputData(){

		if (!$this->errors) {
			if (($this->sizeX > $this->printSheetX) || ($this->sizeY > $this->printSheetY)) {
				$this->setErrorMessage('Input size is bigger then output size');
			}
		}

		if (!$this->errors) {
			if (count($this->frontSides) !== count($this->backSides)){
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


	private function setErrorMessage($message){
		$this->errors = true;
		$this->errorMessage .= $message . PHP_EOL;
	}

}
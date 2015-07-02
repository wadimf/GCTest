<?php

namespace GC;


/**
 * Class DataSingleSheet
 * @package GC
 */
class DataSingleSheet {
	public $pdfFrontSidePath = "";
	public $pdfBackSidePath = "";
	public $startX = 0;
	public $startY = 0;
	public $barcodePath = "";
	public $barcodeX = 0;
	public $barcodeY = 0;
	public $printingRegistrationsLines = null;

	function __construct( $pdfFrontSidePath, $pdfBackSidePath, $startX, $startY, $barcodePath, $barcodeX, $barcodeY, $printingRegistrationsLines ) {
		$this->pdfFrontSidePath           = $pdfFrontSidePath;
		$this->pdfBackSidePath            = $pdfBackSidePath;
		$this->startX                     = $startX;
		$this->startY                     = $startY;
		$this->barcodePath                = $barcodePath;
		$this->barcodeX                   = $barcodeX;
		$this->barcodeY                   = $barcodeY;
		$this->printingRegistrationsLines = $printingRegistrationsLines;
	}

}
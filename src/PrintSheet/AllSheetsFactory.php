<?php

namespace GC;

include 'data/DataAllSheets.php';

/**
 * Class AllSheetsFactory
 * @package GC
 */
class AllSheetsFactory {

	public static function create($frontSides, $backSides, $sizeX, $sizeY, $output, $printSheetWidth, $printSheetHeight, $rowCnt, $colCnt, $deg, $barcodes, $barcodeX, $barcodeY, $allSheets) {

		return new DataAllSheets($frontSides, $backSides, $sizeX, $sizeY, $output, $printSheetWidth, $printSheetHeight, $rowCnt, $colCnt, $deg, $barcodes, $barcodeX, $barcodeY, $allSheets);
	}

	public function validateInputData(){

	}
}
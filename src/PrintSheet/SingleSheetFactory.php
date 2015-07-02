<?php

namespace GC;
include 'data/DataSingleSheet.php';

/**
 * Class SingleSheetFactory
 * @package GC
 */
class SingleSheetFactory {
	public static function create( $pdfFrontSidePath, $pdfBackSidePath, $startX, $startY, $barcodePath, $barcodeX, $barcodeY, $printingRegistrationsLines ) {

		return new DataSingleSheet( $pdfFrontSidePath, $pdfBackSidePath, $startX, $startY, $barcodePath, $barcodeX, $barcodeY, $printingRegistrationsLines );

	}

}
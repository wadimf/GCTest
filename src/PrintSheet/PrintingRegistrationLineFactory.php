<?php

namespace GC;
include 'data/DataPrintingRegistrationLine.php';

/**
 * Class PrintingRegistrationLineFactory
 * @package GC
 */
class PrintingRegistrationLineFactory {

	public static function create( $x, $y, $w, $h ) {

		return new DataPrintingRegistrationLine( $x, $y, $w, $h );
	}
}
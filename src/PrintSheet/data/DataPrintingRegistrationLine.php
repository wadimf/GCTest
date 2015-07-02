<?php

namespace GC;


/**
 * Class DataPrintingRegistrationLine
 * @package GC
 */
class DataPrintingRegistrationLine {
	public $x = 0;
	public $y = 0;
	public $w = 0;
	public $h = 0;

	function __construct( $x, $y, $w, $h ) {
		$this->x = $x;
		$this->y = $y;
		$this->w = $w;
		$this->h = $h;
	}
}
<?php

namespace GC;


/**
 * Class Calculation
 * @package GC
 */
class Calculation {


    const PRINTPADDING = 2;

	public function calcSheetsPlacements($allData) {
		$widthAllCards = 0;
		$heightAllCards = 0;

		$widthOneCard = $allData->sizeX;
		$heightOneCard = $allData->sizeY;

		$allSingleSheetsArray;

		if ($allData->deg !== 90) {
			$widthAllCards = $allData->sizeX * $allData->colCnt;
			$heightAllCards = $allData->sizeY * $allData->rowCnt;
		} else {
			$widthAllCards = $allData->sizeX * $allData->rowCnt;
			$heightAllCards = $allData->sizeY * $allData->colCnt;

			// Card rotated, swap width and height
			$widthOneCard = $allData->sizeX;
			$heightOneCard = $allData->sizeY;

		}

		$startXInit = $startX = round (($allData->printSheetX - $widthAllCards) / 2);
		$startYInit = $startY = round (($allData->printSheetY - $heightAllCards) / 2);

		$singleSheetData = array(
			"pdfFrontSidePath" => "",
			"pdfBackSidePath" => "",
			"startX" => 0,
			"startY" => 0,
			"barcodePath" => null,
			"barcodeX" => 0,
			"barcodeY" => 0,
			"printingRegistrationsLines" => null
		);

		for ($row = 0; $row < $allData->rowCnt; $row++) {

			$startX = $startXInit;

			for ($col = 0; $col < $allData->colCnt; $col++) {

				$printingRegistrationsLines = $this->calcPrintingRegistrations($startX, $startY, $widthOneCard, $heightOneCard);

				$singleSheetData = new DataSingleSheet(
										$allData->frontSides[0],
										$allData->backSides[0],
										$startX,
										$startY,
										null,
										0,
										0,
										$printingRegistrationsLines
									);

				$allSingleSheetsArray[] = $singleSheetData;

				$startX += $widthOneCard;
			}
			$startY += $heightOneCard;

		}

		$allData->allSheets = $allSingleSheetsArray;
	}

	private function calcPrintingRegistrations($x, $y, $width, $height){
		$leftLine = new DataPrintingRegistrationLine(
			$x + self::PRINTPADDING,
			$y - self::PRINTPADDING,
			$x + self::PRINTPADDING,
			$y + $height + self::PRINTPADDING
		);

		$rightLine = new DataPrintingRegistrationLine(
			$x + $width - self::PRINTPADDING,
			$y - self::PRINTPADDING,
			$x + $width - self::PRINTPADDING,
			$y + $height + self::PRINTPADDING
		);

		$upperLine = new DataPrintingRegistrationLine(
			$x - self::PRINTPADDING,
			$y + self::PRINTPADDING,
			$x + $width + self::PRINTPADDING,
			$y + self::PRINTPADDING
		);

		$lowerLine = new DataPrintingRegistrationLine(
			$x - self::PRINTPADDING,
			$y + $height - self::PRINTPADDING,
			$x + $width + self::PRINTPADDING,
			$y + $height - self::PRINTPADDING
		);

		return array($leftLine, $rightLine, $upperLine, $lowerLine);
	}

} 
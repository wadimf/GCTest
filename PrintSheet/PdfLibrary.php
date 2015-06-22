<?php
/**
 * Created by PhpStorm.
 * User: probearbeitwadim
 * Date: 22.06.15
 * Time: 14:01
 */

namespace GC;


interface PdfLibrary {

    /**
     * @param $frontSheet
     * @param $backSheet
     * @param $inputSizeX
     * @param $inputSizeY
     * @param $outputSizeX
     * @param $outputSizeY
     * @param $rowCnt
     * @param $colCnt
     * @param $nup
     * @return mixed
     */
    public function createOneCardOutputPdf($frontSheet, $backSheet, $inputSizeX, $inputSizeY, $outputSizeX, $outputSizeY, $rowCnt, $colCnt, $nup);

    /**
     * @param $frontSheets
     * @param $backSheets
     * @param $barcode
     * @param $barcodeOffsetX
     * @param $barcodeOffsetY
     * @param $inputSizeX
     * @param $inputSizeY
     * @param $outputSizeX
     * @param $outputSizeY
     * @param $rowCnt
     * @param $colCnt
     * @param $nup
     * @return mixed
     */
    public function createMultipleCardsOutputPdf($frontSheets, $backSheets, $barcode, $barcodeOffsetX, $barcodeOffsetY ,$inputSizeX, $inputSizeY, $outputSizeX, $outputSizeY, $rowCnt, $colCnt, $nup);

} 
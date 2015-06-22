<?php
/**
 * Created by PhpStorm.
 * User: probearbeitwadim
 * Date: 22.06.15
 * Time: 14:45
 */

namespace GC;
require 'PdfLibrary.php';

require_once(dirname(__DIR__) . '/libs/tcpdf/tcpdf_import.php');

class HandlePdf implements PdfLibrary{

    const PRINTPADDING =2;

    public $outputPdf = null;

    public $pdfFormat = 'L'; // Landscape

    public $lineStyle = array(
                            'width' => 0.5,
                            'cap' => 'butt',
                            'join' => 'miter',
                            'dash' => 0,
                            'phase' => 0,
                            'color' => array(0, 0, 0)
                        );

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
    public function createOneCardOutputPdf($frontSheet, $backSheet, $inputSizeX, $inputSizeY, $outputSizeX, $outputSizeY, $rowCnt, $colCnt, $nup){

    }

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
    public function createMultipleCardsOutputPdf($frontSheets, $backSheets, $barcode, $barcodeOffsetX, $barcodeOffsetY ,$inputSizeX, $inputSizeY, $outputSizeX, $outputSizeY, $rowCnt, $colCnt, $nup){

    }


    public function createEmptyPage($width = 460, $height = 320){

        $custom_layout = array($width, $height);

        // create new PDF document
        $this->outputPdf = new \TCPDF_IMPORT($this->pdfFormat, PDF_UNIT, $custom_layout, true, 'UTF-8', false);

        // set document information
        $this->outputPdf->SetCreator(PDF_CREATOR);
        $this->outputPdf->SetAuthor('Goldbek Cards');
        $this->outputPdf->SetTitle('Example');
        $this->outputPdf->SetSubject('Example');
        $this->outputPdf->SetKeywords('exapmle');

        // remove default header/footer
        $this->outputPdf->setPrintHeader(false);
        $this->outputPdf->setPrintFooter(false);

        // set default monospaced font
        $this->outputPdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $this->outputPdf->setJPEGQuality(100);

        // set margins //TODO are margins necessary
        $this->outputPdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $this->outputPdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->outputPdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------

        // set font
        $this->outputPdf->SetFont('times', 'BI', 20);

        // add a page
        $this->outputPdf->AddPage();

        $this->outputPdf->Line(5, 10, 450, 320, $this->lineStyle);//TODO remove test


        // $this->outputPdf->importPDF(dirname(__DIR__) . '/test/front1.pdf'); // TODO REMOVE NOT WORKING

        // ---------------------------------------------------------

        //Close and output PDF document
        $this->outputPdf->Output(dirname(__DIR__) . '/test/output/example_002.pdf', 'F'); //TODO remove test
    }

    public function addPrintingRegistrations(){
        $this->outputPdf->Line(5, 10, 450, 320, $this->lineStyle);//TODO remove test


    }

    public function savePdf($output){
        $this->outputPdf->Output(dirname(__DIR__) . '/test/output/example_002.pdf', 'F');
    }


    /*
     * Front & Back
     * */

    public function placeInputPdfs($pdfsfront){
        $outputHeight =  320;
        $outputWidth =  460;

        $sizeX = 109;
        $sizeY = 152;

        $cols = 4;
        $rows = 2;

        $deg = 0;

        $startX = 0;
        $startY = 0;

        // calc starting point

        if ($deg !== 90) {
            $tempXwidth = $sizeX * $cols;
            $tempYHeight = $sizeY * $rows;
        } else {
            $tempXwidth = $sizeX * $rows;
            $tempYHeight = $sizeY * $cols;
        }

        $startX = ($outputWidth - $tempXwidth) / 2;
        $startY = ($outputHeight - $tempYHeight) / 2;

        // add addPrintingRegistrations
        // TODO outsource in function

        for ($i = 0; $i < $cols; $i++) {
            for ($j = 0; $j < $rows; $j++) {
                // draw left line
                $this->outputPdf->Line(
                                    $startX + self::PRINTPADDING,
                                    $startY - self::PRINTPADDING,
                                    $startX + self::PRINTPADDING,
                                    $startY + $sizeY + self::PRINTPADDING,
                                    $this->lineStyle);

                // draw right line
                $this->outputPdf->Line(
                    $startX + $sizeX - self::PRINTPADDING,
                    $startY - self::PRINTPADDING,
                    $startX + $sizeX - self::PRINTPADDING,
                    $startY + $sizeY + self::PRINTPADDING,
                    $this->lineStyle);

                // draw upper line
                $this->outputPdf->Line(
                    $startX - self::PRINTPADDING,
                    $startY + self::PRINTPADDING,
                    $startX + $sizeX + self::PRINTPADDING,
                    $startY + self::PRINTPADDING,
                    $this->lineStyle);

                // draw lower line
                $this->outputPdf->Line(
                    $startX - self::PRINTPADDING,
                    $startY + $sizeY - self::PRINTPADDING,
                    $startX + $sizeX + self::PRINTPADDING,
                    $startY + $sizeY - self::PRINTPADDING,
                    $this->lineStyle);

                $startY =+ $sizeY;
            }
            $startX =+ $sizeX;
        }

        // place pdfs / images

        // Image method signature:
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
        for ($i = 0; $i < $cols; $i++) {
            for ($j = 0; $j < $rows; $j++) {
                // Place Image as example, tcpdf can't place PDF's
                $pdf->Image($pdfsfront, $startX, $startY, $sizeX, $sizeY, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);
                $startY =+ $sizeY;
            }

            $startX =+ $sizeX;
        }
    }

} 
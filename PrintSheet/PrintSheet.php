<?php
/**
 * Created by PhpStorm.
 * User: probearbeitwadim
 * Date: 22.06.15
 * Time: 13:53
 */


namespace GC;
require dirname(__DIR__) . '/libs/commando/vendor/autoload.php';


class PrintSheet {

    public $frontSides = null;
    public $backSides = null;
    public $sizeX = 0;
    public $sizeY = 0;

    public $output = "";

    public $printSheetX = 0;
    public $printSheetY = 0;

    public $nup = 0;
    public $rowCnt = 0;
    public $colCnt = 0;
    public $deg = 0;

    public $barcodes = null;
    public $barcodeX = 0;
    public $barcodeY = 0;



    /**
     *
     */
    public function getParams(){
        $cmd = new \Commando\Command();
        $cmd->option('frontSides')->require()
            ->option('backSides')->require()
            ->option('sizeX')->require()
            ->option('sizeY')->require()

            ->option('output')->require()

            ->option('printSheetSizeX')->require()
            ->option('printSheetSizeY')->require()

            ->option('nup')->require()
            ->option('rowCnt')->require()
            ->option('colCnt')->require()
            ->option('deg')->require()

            ->option('barcodes')
            ->option('barcodeX')
            ->option('barcodeY');

        $this->frontSides = explode(",", $cmd['frontSides']);
        var_dump($this->frontSides);
        $this->backSides = explode(",", $cmd['backSides']);
        $this->sizeX = $cmd['sizeX'];
        $this->sizeY = $cmd['sizeY'];

        $this->output = $cmd['output'];

        $this->printSheetSizeX = $cmd['printSheetSizeX'];
        $this->printSheetSizeY = $cmd['printSheetSizeY'];

        $this->output = $cmd['output'];

        $this->nup = $cmd['nup'];
        $this->rowCnt = $cmd['rowCnt'];
        $this->colCnt = $cmd['colCnt'];
        $this->deg = $cmd['deg'];

        $this->barcodes = explode(",", $cmd['barcodes']);
        $this->barcodeX = $cmd['barcodeX'];
        $this->barcodeY = $cmd['barcodeY'];
    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: wadim
 * Date: 02.07.15
 * Time: 13:50
 */

class PrintSheetTests extends PHPUnit_Framework_TestCase{


	public function testDataPrintingRegistrationLine(){
		$data = array(1,2,3,4);
		$printingRegistrationLine = new \GC\DataPrintingRegistrationLine(1,2,3,4);

		$this->assertEquals($printingRegistrationLine->x, $data[0]);
		$this->assertEquals($printingRegistrationLine->y, $data[1]);
		$this->assertEquals($printingRegistrationLine->w, $data[2]);
		$this->assertEquals($printingRegistrationLine->h, $data[3]);
	}

	public function testDataSingleSheet(){
		$data = array('path/front.pdf', 'path/back.pdf', 1, 2, 'path/code.pdf', 3, 4, null);
		$singleSheet = new \GC\DataSingleSheet('path/front.pdf', 'path/back.pdf', 1, 2, 'path/code.pdf', 3, 4, null);


		$this->assertEquals($singleSheet->pdfFrontSidePath, $data[0]);
		$this->assertEquals($singleSheet->pdfBackSidePath, $data[1]);

		$this->assertEquals($singleSheet->startX, $data[2]);
		$this->assertEquals($singleSheet->startY, $data[3]);

		$this->assertEquals($singleSheet->barcodePath, $data[4]);
		$this->assertEquals($singleSheet->barcodeX, $data[5]);
		$this->assertEquals($singleSheet->barcodeY, $data[6]);
		$this->assertEquals($singleSheet->printingRegistrationsLines, $data[7]);
	}

	public function testDataAllSheets(){
		$data = array(array('path/front.pdf'), array('path/back.pdf'), 1, 2, 'path/out.pdf', 3, 4, 5, 6, 0, null, 7,8,null);
		$allSheets = new \GC\DataAllSheets(array('path/front.pdf'), array('path/back.pdf'), 1, 2, 'path/out.pdf', 3, 4, 5, 6, 0, null, 7,8,null);

		$this->assertSame($allSheets->frontSides, $data[0]);
		$this->assertSame($allSheets->backSides, $data[1]);
		$this->assertEquals($allSheets->sizeX, $data[2]);
		$this->assertEquals($allSheets->sizeY, $data[3]);
		$this->assertEquals($allSheets->output, $data[4]);
		$this->assertEquals($allSheets->printSheetX, $data[5]);
		$this->assertEquals($allSheets->printSheetY, $data[6]);
		$this->assertEquals($allSheets->rowCnt, $data[7]);
		$this->assertEquals($allSheets->colCnt, $data[8]);
		$this->assertEquals($allSheets->deg, $data[9]);
		$this->assertEquals($allSheets->barcodes, $data[10]);
		$this->assertEquals($allSheets->barcodeX, $data[11]);
		$this->assertEquals($allSheets->barcodeY, $data[12]);
		$this->assertEquals($allSheets->allSheets, $data[13]);
	}

	public function testCalculation(){
		$data = new \GC\DataAllSheets(array('path/front.pdf'), array('path/back.pdf'), 109, 152, 'path/out.pdf', 460, 320, 2,3,0, null, null, null, null);
		$calc = new \GC\Calculation();
		$calc->calcSheetsPlacements($data);

		/* must be 6 Sheets*/
		$this->assertEquals(count($data->allSheets), 6);
		/* must be lines Sheets*/
		$this->assertEquals(count($data->allSheets[0]->printingRegistrationsLines), 4);

		$firstSheet = new \GC\DataSingleSheet('path/front.pdf', 'path/back.pdf', 67, 8, null, null, null, null);

		/* first sheet */
		$this->assertEquals($data->allSheets[0]->pdfFrontSidePath, $firstSheet->pdfFrontSidePath);
		$this->assertEquals($data->allSheets[0]->pdfBackSidePath, $firstSheet->pdfBackSidePath);

		$this->assertEquals($data->allSheets[0]->startX, $firstSheet->startX);
		$this->assertEquals($data->allSheets[0]->startY, $firstSheet->startY);

		$firstRegistrationLine = new \GC\DataPrintingRegistrationLine(69,6,69,162);

		/* first registration line */
		$this->assertEquals($data->allSheets[0]->printingRegistrationsLines[0]->x, $firstRegistrationLine->x);
		$this->assertEquals($data->allSheets[0]->printingRegistrationsLines[0]->y, $firstRegistrationLine->y);
		$this->assertEquals($data->allSheets[0]->printingRegistrationsLines[0]->w, $firstRegistrationLine->w);
		$this->assertEquals($data->allSheets[0]->printingRegistrationsLines[0]->h, $firstRegistrationLine->h);


	}
}
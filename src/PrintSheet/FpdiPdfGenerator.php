<?php

namespace GC;

class FpdiPdfGenerator implements PdfGeneratorInterface{

    const PDF_FORMAT    = 'L';  // landscape
	const PDF_UNIT      = 'mm';
	const LINE_COLOR_R  = 0;
	const LINE_COLOR_G  = 0;
	const LINE_COLOR_B  = 0;    // black
	const LINE_WIDTH    = 0.5;  // thin

	private $pdf = null;

	public function generatePdf($allData){

		// new print sheet
		$this->pdf = new \FPDI(self::PDF_FORMAT, self::PDF_UNIT, array($allData->printSheetX, $allData->printSheetY));
		$this->initPrintingRegistrationsLines();

		// frontpage
		$this->pdf->addPage();
		$this->addPrintingRegistrations($allData->allSheets);
		$this->generateFrontPage($allData->allSheets);

		// backpage
		$this->pdf->addPage();
		$this->addPrintingRegistrations($allData->allSheets);
		$this->generateBackPage($allData->allSheets);

		//save
		$this->pdf->Output($allData->output, 'F');
	}


	private function generateFrontPage($allSheets){

		foreach ($allSheets as $singleSheet) {
			$this->pdf->setSourceFile($singleSheet->pdfFrontSidePath);
			$tplIdx = $this->pdf->importPage(1);
			$this->pdf->useTemplate($tplIdx, $singleSheet->startX, $singleSheet->startY);
		}
	}

	private function generateBackPage($allSheets){
		foreach ($allSheets as $singleSheet) {
			$this->pdf->setSourceFile($singleSheet->pdfBackSidePath);
			$tplIdx = $this->pdf->importPage(1);
			$this->pdf->useTemplate($tplIdx, $singleSheet->startX, $singleSheet->startY);
		}
	}

	private function initPrintingRegistrationsLines(){
		// line color
		$this->pdf->SetDrawColor(self::LINE_COLOR_R, self::LINE_COLOR_G, self::LINE_COLOR_B);

		// line width
		$this->pdf->SetLineWidth(self::LINE_WIDTH);
	}

	private function addPrintingRegistrations($allSheets){

		foreach ($allSheets as $singleSheet) {
			foreach ($singleSheet->printingRegistrationsLines as $line)
				$this->pdf->Line($line->x, $line->y, $line->w, $line->h);
		}
	}
} 
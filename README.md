# GC Test
Description

### Version
0.0.1

### Usage

```sh
$ php printSheet.php -frontSides front1.pdf[,front2.pdf,...] -backSides back1.pdf[,back2.pdf,...] -sizeX 100 -sizeY 200 -output out.pdf -printSheetSizeX 460 -printSheetSizeY 320 -colCnt 3 -rowCnt 2 -nup 3 -deg 0 -barcodes code1.pdf[,code2.pdf,...] -barcodeX 123 -barcodeY 123
```

Required:
* frontSides (min=1)
* backSides (min=1)
* sizeX
* sizeY
* output
* printSheetSizeX
* printSheetSizeY
* nup
* rowCnt
* colCnt
* deg (0, 90, 180)

Optional:

* barcodes
* barcodeX
* barcodeY

frontSides, backSides, barcodes, barcodeX, barcodeY must match amounts 

### Libraries

* TCPdf
* commando

### Example
```sh
php printSheetTest.php -frontSides test/front1.pdf -backSides test/back1.pdf -sizeX 152 -sizeY 109 -output output/out.pdf -printSheetSizeX 460 -printSheetSizeY 320 -colCnt 3 -rowCnt 2 -nup 6 -deg 0
```

### Todo's

----
**bold**

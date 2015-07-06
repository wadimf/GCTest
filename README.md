# GC Test
This PHP CLI program places a given postcard front- and backpage on a print sheet and adds registration marks. 

**Multiple front and backsides are not implemented yet**
**Barcodes are not implemented yet**
### Version
0.0.2

### Usage

```sh
$ php index.php -frontSides front1.pdf[,front2.pdf,...] -backSides back1.pdf[,back2.pdf,...] -slideWidth 100 -slideHeight 200 -output out.pdf -printSheetWidth 460 -printSheetHeight 320 -colCnt 3 -rowCnt 2 -deg 0 -barcodes code1.pdf[,code2.pdf,...] -barcodeX 123 -barcodeY 123
```

Required:
* frontSides (min=1)
* backSides (min=1)
* slideWidth
* slideHeight
* output
* printSheetWidth
* printSheetHeight
* rowCnt
* colCnt
* deg (0, 90, 180)

Optional:

* barcodes
* barcodeX
* barcodeY

frontSides, backSides, barcodes, barcodeX, barcodeY must match amounts 

### Libraries

* fpdf
* fpdi
* commando

### Installation

```sh
./composer.phar install
```

### Example
```sh
php index.php -frontSides test/front1.pdf -backSides test/back1.pdf -slideWidth 109 -slideHeight 152 -output test/out.pdf -printSheetWidth 460 -printSheetHeight 320 -colCnt 3 -rowCnt 2 -deg 0
```

### Testing
```sh
libs/vendor/bin/phpunit --bootstrap libs/vendor/autoload.php test/phpunit/tests.php
```

### Todo's

----
**bold**

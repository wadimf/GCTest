#! /usr/bin/env php
<?php
// The library works fine as an executable as well
// This example is Unix-ish specific
// Usage
// ./basic test

require 'src/PrintSheet/PrintSheet.php';

$printSheet = new \GC\PrintSheet();
$printSheet->generatePrintSheet();

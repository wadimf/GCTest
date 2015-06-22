#! /usr/bin/env php
<?php
// The library works fine as an executable as well
// This example is Unix-ish specific
// Usage
// ./basic test

require 'PrintSheet/PrintSheet.php';

$myTest = new \GC\PrintSheet();
$myTest->getParams();

// $myTest = new \GC\HandlePdf();
// $myTest->createEmptyPage();
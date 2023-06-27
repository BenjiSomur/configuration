<?php
require 'vendor/autoload.php';

use PHPStamp\Templator;
use PHPStamp\Document\WordDocument;

$cachePath = __DIR__ . "/results";
$templator = new Templator($cachePath);

date_default_timezone_set('America/Mexico_City');

$dategen = date("");


?>
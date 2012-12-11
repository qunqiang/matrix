<?php
define('DEBUG_MODE', true);
require_once 'lib/BIOS.php';
BIOS::load(array('AppType'=>'http'))->startOS(new MatrixOS);

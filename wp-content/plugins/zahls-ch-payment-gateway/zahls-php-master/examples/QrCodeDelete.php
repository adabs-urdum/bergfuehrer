<?php

spl_autoload_register(function($class) {
    $root = dirname(__DIR__);
    $classFile = $root . '/lib/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

// $instanceName is a part of the url where you access your zahls installation.
// https://{$instanceName}.zahls.ch
$instanceName = 'YOUR_INSTANCE_NAME';

// $secret is the zahls secret for the communication between the applications
// if you think someone got your secret, just regenerate it in the zahls administration
$secret = 'YOUR_SECRET';

$zahls = new \Zahls\Zahls($instanceName, $secret);

$qrCode = new \Zahls\Models\Request\QrCode();
$qrCode->setId('QR_CODE_ID');

try {
    $response = $zahls->delete($qrCode);
    var_dump($response);
} catch (\Zahls\ZahlsException $e) {
    print $e->getMessage();
}
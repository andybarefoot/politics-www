<?php
// Include the API binding
require_once '../../../includes/twfyapi.php';
// Set up a new instance of the API binding
$twfyapi = new TWFYAPI('BEvqDRDd82nyDD4mVhBB2B5u');
// Get a list of Labour MPs in XML format
$mps = $twfyapi->query('getMPs', array('output' => 'js', 'party' => 'labour'));
// Print out the list
echo $mps;
?>
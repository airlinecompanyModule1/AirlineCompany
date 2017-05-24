<?php

;extension=php_openssl.dll;
//require_once("lib/nusoap.php"); 
 $client = new SoapClient("http://www.webservicex.net/airport.asmx?WSDL");

    $params = array( 'country'  => 'Turkey');

    $result = $client->GetAirportInformationByCountry($params)->TestMethodResult;

    print_r( $result);
    $params = array( 'country'  => 'Turkey');
echo "\n \r";
    $result2 = $client->ShowNameFamely($params)->ShowNameFamelyResult;

    print_r( $result2);
?>
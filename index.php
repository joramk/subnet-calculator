<?php
/*
# Subnet Calculator
# URLs: https://code.google.com/p/subnet-calculator/
# Copyright (C) 2014, Joram Knaack
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

require_once('nusoap/nusoap.php');

$server = new soap_server();

//Define our namespace
$namespace = "http://subnetcalculator.ordos.ddn.lonet.org";
$server->wsdl->schemaTargetNamespace = $namespace;
 
//Configure our WSDL
$server->configureWSDL("SubnetCalculator");

// set our namespace
$server->wsdl->schemaTargetNamespace = $namespace;

//Create a complex type
$server->wsdl->addComplexType('IpInformation','complexType','struct','all','',
array( 'IpAddress' => array('name' => 'IpAddress','type' => 'xsd:string'),
			 'SubnetAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 ));

$server->wsdl->addComplexType('SubnetInformation','complexType','struct','all','',
array( 'StartHostAddress' => array('name' => 'IpAddress','type' => 'xsd:string'),
			 'EndHostAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'StartNetworkAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'EndNetworkAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'MaxNumOfHosts' => array('name' => 'SubnetAddress','type' => 'xsd:int'),
			 'NetworkAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'BroadcastAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'NetworkClass' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
			 'NetworkAddressSize' => array('name' => 'SubnetAddress','type' => 'xsd:int'),
			 'HostAddressSize' => array('name' => 'SubnetAddress','type' => 'xsd:int'),
			 ));

//Register a method that has parameters and return types
$server->register(
// method name:
'SubnetCalculator',
// parameter list:
array('name'=>'tns:IpInformation'),
// return value(s):
array('return'=>'tns:SubnetInformation'),
// namespace:
$namespace,
// soapaction: (use default)
false,
// style: rpc or document
'rpc',
// use: encoded or literal
'encoded',
// description: documentation for the method
'Simple Subnet Calculator');

// Get our posted data if the service is being consumed
// otherwise leave this data blank.
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
// pass our posted data (or nothing) to the soap service
$server->service($POST_DATA);

exit(); 

function SubnetCalculator($IpInformation) {
	var_dump($IpInformation);
	die();
	return "Hello, World!";
}

?>

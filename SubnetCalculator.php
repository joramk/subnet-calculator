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

// Load required classes
require_once('nusoap/nusoap.php');
require_once('SubnetCalculatorImpl.class.php');

// Create a new SOAP server instance
$server = new soap_server();

// Define our namespace
$namespace = "http://subnetcalculator.webservice.lonet.org";
 
// Configure our WSDL
$server->configureWSDL("SubnetCalculator");

// Set our namespace
$server->wsdl->schemaTargetNamespace = $namespace;

// Create complex request/response types
$server->wsdl->addComplexType('IpInformation','complexType','struct','all','', array(
		'IpAddress' => array('name' => 'IpAddress','type' => 'xsd:string'),
		'SubnetAddress' => array('name' => 'SubnetAddress','type' => 'xsd:string'),
		));

$server->wsdl->addComplexType('SubnetInformation','complexType','struct','all','', array(
		'Status' => array('name' => 'Status','type' => 'tns:StatusType'),
		'Result' => array('name' => 'Result','type' => 'tns:ResultType'),
		));

$server->wsdl->addComplexType('StatusType','complexType','struct','all','', array(
		'StatusCode' => array('name' => 'Status','type' => 'xsd:int'),
		'StatusMessage' => array('name' => 'Result','type' => 'xsd:string'),
		));

$server->wsdl->addComplexType('ResultType','complexType','struct','all','', array( 
		'IpAddress' => array('name' => 'IpAddress','type' => 'xsd:decimal'),
		'IpAddressAsDecimal' => array('name' => 'IpAddressAsDecimal','type' => 'xsd:decimal'),
		'IpAddressAsHexadecimal' => array('name' => 'IpAddressAsHexadecimal','type' => 'xsd:string'),
		'IpAddressAsDottedBinary' => array('name' => 'IpAddressAsDottedBinary','type' => 'xsd:string'),
		'SubnetAddress' => array('name' => 'SubnetAddress','type' => 'xsd:decimal'),
		'SubnetAddressAsDecimal' => array('name' => 'SubnetAddressAsDecimal','type' => 'xsd:decimal'),
		'SubnetAddressAsHexadecimal' => array('name' => 'SubnetAddressAsHexadecimal','type' => 'xsd:string'),
		'SubnetAddressAsDottedBinary' => array('name' => 'SubnetAddressAsDottedBinary','type' => 'xsd:string'),
		'StartHostAddress' => array('name' => 'StartHostAddress','type' => 'xsd:string'),
		'StartHostAddressAsDecimal' => array('name' => 'StartHostAddressAsDecimal','type' => 'xsd:decimal'),
		'StartHostAddressAsHexadecimal' => array('name' => 'StartHostAddressAsHexadecimal','type' => 'xsd:string'),
		'StartHostAddressAsDottedBinary' => array('name' => 'StartHostAddressAsDottedBinary','type' => 'xsd:string'),
		'EndHostAddress' => array('name' => 'EndHostAddress','type' => 'xsd:string'),
		'EndHostAddressAsDecimal' => array('name' => 'EndHostAddressAsDecimal','type' => 'xsd:decimal'),
		'EndHostAddressAsHexadecimal' => array('name' => 'EndHostAddressAsHexadecimal','type' => 'xsd:string'),
		'EndHostAddressAsDottedBinary' => array('name' => 'EndHostAddressAsDottedBinary','type' => 'xsd:string'),
		'NetworkAddress' => array('name' => 'NetworkAddress','type' => 'xsd:string'),
		'NetworkAddressAsDecimal' => array('name' => 'NetworkAddressAsDecimal','type' => 'xsd:decimal'),
		'NetworkAddressAsHexadecimal' => array('name' => 'NetworkAddressAsHexadecimal','type' => 'xsd:string'),
		'NetworkAddressAsDottedBinary' => array('name' => 'NetworkAddressAsDottedBinary','type' => 'xsd:string'),
		'BroadcastAddress' => array('name' => 'BroadcastAddress','type' => 'xsd:string'),
		'BroadcastAddressAsDecimal' => array('name' => 'BroadcastAddressAsDecimal','type' => 'xsd:decimal'),
		'BroadcastAddressAsHexadecimal' => array('name' => 'BroadcastAddressAsHexadecimal','type' => 'xsd:string'),
		'BroadcastAddressAsDottedBinary' => array('name' => 'BroadcastAddressAsDottedBinary','type' => 'xsd:string'),
		'MaxNumOfHosts' => array('name' => 'MaxNumOfHosts','type' => 'xsd:int'),
		'MaxNumOfSubnets' => array('name' => 'MaxNumOfSubnets','type' => 'xsd:int'),
		'NetworkClass' => array('name' => 'NetworkClass','type' => 'xsd:string'),
		'NetworkAddressSize' => array('name' => 'NetworkAddressSize','type' => 'xsd:int'),
		'HostAddressSize' => array('name' => 'HostAddressSize','type' => 'xsd:int'),
		'NetworkRemarks' => array('name' => 'NetworkRemarks','type' => 'xsd:string'),
		));

// Register a method that has parameters and return types
$server->register('SubnetCalculator', array('name'=>'tns:IpInformation'), array('return'=>'tns:SubnetInformation'),
		$namespace, false, 'rpc', 'encoded', 'A simple subnet calculator web service');

// Get our posted data if the service is being consumed
// otherwise leave this data blank.
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
// Pass our posted data (or nothing) to the SOAP service
$server->service($POST_DATA);

// Exit the program gracefully
exit(); 

// Registered SubnetCalculator function called by nusoap
function SubnetCalculator($IpInformation) {
	try {
		$sc = new SubnetCalculatorImpl();
		$sc->setIpAndSubnetAddress($IpInformation['IpAddress'], $IpInformation['SubnetAddress']);
		return array('Status' => array('StatusCode' => 0, 'StatusMessage' => ''), 'Result' => array(
				'IpAddress' => $sc->getIpAddress(),
				'IpAddressAsDecimal' => $sc->getIpAddressAsDecimal(),
				'IpAddressAsHexadecimal' => $sc->getIpAddressAsHexadecimal(),
				'IpAddressAsDottedBinary' => $sc->getIpAddressAsDottedBinary(),
				'SubnetAddress' => $sc->getSubnetAddress(),
				'SubnetAddressAsDecimal' => $sc->getSubnetAddressAsDecimal(),
				'SubnetAddressAsHexadecimal' => $sc->getSubnetAddressAsHexadecimal(),
				'SubnetAddressAsDottedBinary' => $sc->getSubnetAddressAsDottedBinary(),
				'StartHostAddress' => $sc->getStartHostAddress(),
				'StartHostAddressAsDecimal' => $sc->getStartHostAddressAsDecimal(),
				'StartHostAddressAsHexadecimal' => $sc->getStartHostAddressAsHexadecimal(),
				'StartHostAddressAsDottedBinary' => $sc->getStartHostAddressAsDottedBinary(),
				'EndHostAddress' => $sc->getEndHostAddress(),
				'EndHostAddressAsDecimal' => $sc->getEndHostAddressAsDecimal(),
				'EndHostAddressAsHexadecimal' => $sc->getEndHostAddressAsHexadecimal(),
				'EndHostAddressAsDottedBinary' => $sc->getEndHostAddressAsDottedBinary(),
				'NetworkAddress' => $sc->getNetworkAddress(),
				'NetworkAddressAsDecimal' => $sc->getNetworkAddressAsDecimal(),
				'NetworkAddressAsHexadecimal' => $sc->getNetworkAddressAsHexadecimal(),
				'NetworkAddressAsDottedBinary' => $sc->getNetworkAddressAsDottedBinary(),
				'BroadcastAddress' => $sc->getBroadcastAddress(),
				'BroadcastAddressAsDecimal' => $sc->getBroadcastAddressAsDecimal(),
				'BroadcastAddressAsHexadecimal' => $sc->getBroadcastAddressAsHexadecimal(),
				'BroadcastAddressAsDottedBinary' => $sc->getBroadcastAddressAsDottedBinary(),
				'MaxNumOfHosts' => $sc->getMaxNumOfHosts(),
				'MaxNumOfSubnets' => $sc->getMaxNumOfSubnets(),
				'NetworkClass' => $sc->getNetworkClass(),
				'NetworkAddressSize' => $sc->getNetworkAddressSize(),
				'HostAddressSize' => $sc->getHostAddressSize(),
				'NetworkRemarks' => $sc->getNetworkRemarks(),
				));
	} catch (Exception $e) {
		return array('Status' => array('StatusCode' => $e->getCode(), 'StatusMessage' => $e->getMessage()), 'Result' => array());
	}
}

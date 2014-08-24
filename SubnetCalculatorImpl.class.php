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

require_once('SubnetCalculator.class.php');

class SubnetCalculatorImpl implements SubnetCalculator {

	private $SubnetAddress;
	private $IpAddress;
	private $NetworkAddressSize;
	private $HostAddressSize;
	private $MaxNumOfHosts;
	private $MaxNumOfSubnets;
	private $BroadcastAddress;
	private $NetworkClass;
	private $NetworkAddress;
	private $StartHostAddress;
	private $EndHostAddress;
	private $StartNetworkAddress;
	private $EndNetworkAddress;
	private $NetworkRemarks;

	public function setIpAndSubnetAddress($ip, $netmask) {
		if(!$this->setSubnetAddress($netmask) || !$this->setIpAddress($ip))
			throw new Exception("Invalid formatted input data", 1);
	}
	
	public function getIpAddress() {
		if ($this->isSetIpAndSubnetAddress())
			return $this->transformBinaryToDotted($this->IpAddress);
		else
			return false;
	}

	public function getIpAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress())
			return $this->transformBinaryToDecimal($this->IpAddress);
		else
			return false;
	}

	public function getIpAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress())
			return dechex($this->getIpAddressAsDecimal());
		else
			return false;
	}
	
	public function getSubnetAddress() {
		if ($this->isSetIpAndSubnetAddress())
			return $this->transformBinaryToDotted($this->SubnetAddress);
		else
			return false;
	}
	
	public function getSubnetAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress())
			return $this->transformBinaryToDecimal($this->SubnetAddress);
		else
			return false;
	}
	
	public function getSubnetAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress())
			return dechex($this->getSubnetAddressAsDecimal());
		else
			return false;
	}
	
	public function getIpAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress())
			return substr(chunk_split($this->IpAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getSubnetAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress())
			return substr(chunk_split($this->SubnetAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getNetworkRemarks() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkRemarks))
			return $this->NetworkRemarks;
		else
			return false;
	}

	public function getStartHostAddress() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->StartHostAddress))
			return $this->transformBinaryToDotted($this->StartHostAddress);
		else
			return false;
	}

	public function getStartHostAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->StartHostAddress))
			return $this->transformBinaryToDecimal($this->StartHostAddress);
		else
			return false;
	}

	public function getStartHostAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->StartHostAddress))
			return dechex($this->getStartHostAddressAsDecimal());
		else
			return false;
	}
	
	public function getStartHostAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->StartHostAddress))
			return substr(chunk_split($this->StartHostAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getEndHostAddress() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->EndHostAddress))
			return $this->transformBinaryToDotted($this->EndHostAddress);
		else
			return false;
	}

	public function getEndHostAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->EndHostAddress))
			return $this->transformBinaryToDecimal($this->EndHostAddress);
		else
			return false;
	}

	public function getEndHostAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->EndHostAddress))
			return dechex($this->getEndHostAddressAsDecimal());
		else
			return false;
	}
		
	public function getEndHostAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->EndHostAddress))
			return substr(chunk_split($this->EndHostAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getNetworkAddress() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkAddress))
			return $this->transformBinaryToDotted($this->NetworkAddress);
		else
			return false;
	}
	
	public function getNetworkAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkAddress))
			return $this->transformBinaryToDecimal($this->NetworkAddress);
		else
			return false;
	}

	public function getNetworkAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkAddress))
			return dechex($this->getNetworkAddressAsDecimal());
		else
			return false;
	}
		
	public function getNetworkAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkAddress))
			return substr(chunk_split($this->NetworkAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getNetworkClass() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkClass))
			return $this->NetworkClass;
		else
			return false;
	}
	
	public function getBroadcastAddress() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->BroadcastAddress))
			return $this->transformBinaryToDotted($this->BroadcastAddress);
		else
			return false;
	}

	public function getBroadcastAddressAsDecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->BroadcastAddress))
			return $this->transformBinaryToDecimal($this->BroadcastAddress);
		else
			return false;
	}

	public function getBroadcastAddressAsHexadecimal() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->BroadcastAddress))
			return dechex($this->getBroadcastAddressAsDecimal());
		else
			return false;
	}
		
	public function getBroadcastAddressAsDottedBinary() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->BroadcastAddress))
			return substr(chunk_split($this->BroadcastAddress, 8, "."), 0, -1);
		else
			return false;
	}
	
	public function getMaxNumOfHosts() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->MaxNumOfHosts))
			return $this->MaxNumOfHosts;
		else
			return false;
	}

	public function getMaxNumOfSubnets() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->MaxNumOfSubnets))
			return $this->MaxNumOfSubnets;
		else
			return false;
	}

	public function getNetworkAddressSize() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->NetworkAddressSize))
			return $this->NetworkAddressSize;
		else
			return false;
	}
	
	public function getHostAddressSize() {
		if ($this->isSetIpAndSubnetAddress() && isset($this->HostAddressSize))
			return $this->HostAddressSize;
		else
			return false;
	}
	
	private function isSetIpAndSubnetAddress() {
		if (!empty($this->IpAddress) && !empty($this->SubnetAddress))
			return true;
		else
			return false;
	}

	private function setIpAddress($address) {
		if ($this->validateAddress($address)) {
			$this->IpAddress = $this->transformDottedToBinary($address);
			$this->BroadcastAddress = $this->determineBroadcastAddress($this->IpAddress, $this->NetworkAddressSize);
			$this->NetworkAddress = $this->determineNetworkAddress($this->IpAddress, $this->NetworkAddressSize);
			$this->NetworkClass = $this->determineNetworkClass($this->NetworkAddress);
			$this->NetworkRemarks = $this->determineNetworkRemarks($this->NetworkAddress);
			$this->StartHostAddress = $this->determineStartHostAddress($this->NetworkAddress);
			$this->EndHostAddress = $this->determineEndHostAddress($this->BroadcastAddress);
			return true;
		} else
			return false;
	}

	private function setSubnetAddress($address) {
		if ($this->validateAddress($address, true)) {
			$this->SubnetAddress = $this->transformDottedToBinary($address);
			$this->NetworkAddressSize = $this->transformBinaryToCidr($this->SubnetAddress);
			$this->HostAddressSize = 32 - $this->NetworkAddressSize;
			$this->MaxNumOfHosts = $this->determineMaxNumOfHosts($this->NetworkAddressSize);
			$this->MaxNumOfSubnets = $this->determineMaxNumOfSubnets($this->HostAddressSize);
			return true;
		} else
			return false;
	}

	private function transformBinaryToCidr($binary){
		return strlen(rtrim(str_replace(".", "", $binary), "0"));
	}

	private function transformDottedToBinary($address) {
		$parts = explode(".", $address);
		$bin = array();
		foreach ($parts as $part)
			$bin[] = str_pad(decbin($part), 8, "0", STR_PAD_LEFT);
		return implode("", $bin);
	}

	private function transformBinaryToDecimal($binary) {
		$parts = explode(".", $this->transformBinaryToDotted($binary));
		return $parts[0] * 255 * 255 * 255 + $parts[1] * 255 * 255 + $parts[2] * 255 + $parts[3];
	}

	private function transformBinaryToDotted($binary) {
		$dotted=array();
		$parts=str_split($binary, 8);
		foreach($parts as $part)
			$dotted[] = bindec($part);
		return implode(".", $dotted) ;
	}
	
	private function determineBroadcastAddress($host, $subnet) {
		return str_pad(substr($host, 0, $subnet), 32, 1);
	}

	private function determineNetworkAddress($host, $subnet) {
		return str_pad(substr($host, 0, $subnet), 32, 0);
	}
	
	private function determineStartHostAddress($network) {
		return str_pad(substr($network, 0, 31), 32, 1);
	}
	
	private function determineEndHostAddress($broadcast) {
		return str_pad(substr($broadcast, 0, 31), 32, 0);
	}
	
	private function determineNetworkRemarks($network) {
		// 10.0.0.0/8 + 172.16.0.0/12 + 192.168.0.0/16
		if (strpos($network, '00001010') === 0
			|| strpos($network, '101011000001') === 0
			|| strpos($network, '1100000010101000') === 0)
  		return 'Private IPv4 address space [RFC1918]';
		// 127.0.0.0/8
  	elseif(strpos($network, '01111111') === 0)
  		return 'Loopback IPv4 address space [RFC1700]';
		// 169.254.0.0/16
  	elseif(strpos($network, '1010100111111110') === 0)
  		return 'Link local';
		// 39.0.0.0/8 + 128.0.0.0/16 + 191.255.0.0/16 + 223.255.255.0/24
  	elseif(strpos($network, '00100111') === 0
  		|| strpos($network, '1000000000000000') === 0
  		|| strpos($network, '1011111111111111') === 0
  		|| strpos($network, '110111111111111111111111') === 0)
  		return 'Reserved but subject to allocation';
  	// 192.0.2.0/24
  	elseif(strpos($network, '110000000000000000000010') === 0)
  		return 'Test-Net';
  	// 198.18.0.0/15
  	elseif(strpos($network, '110001100001001') === 0)
  		return 'Network interconnect device benchmark testing [RFC2544]';
		// 192.88.99.0/24
  	elseif(strpos($network, '110000000101100001100011') === 0)
  		return '6to4 Relay Anycast [RFC3068]';
		// 224.0.0.0/4
  	elseif(strpos($network, '1110') === 0)
			return "Multicast IPv4 address space [RFC3171]";
		// 240.0.0.0/4
  	elseif(strpos($network, '1111') === 0)
			return "Special-use IPv4 address space [RFC3330]";
		else
			return '';
	}

	private function determineNetworkClass($network) {
		if (strpos($network, '0') === 0)
			return "A";
		elseif (strpos($network, '10') === 0)
			return "B";
		elseif (strpos($network, '110') === 0)
		 	return "C";
		elseif (strpos($network, '1110') === 0)
  		return "D";
		else
	  	return "E";
	}

	private function determineMaxNumOfHosts($networkAddressSize) {
		return bindec(str_pad("", (32 - $networkAddressSize), 1)) - 1;
	}

	private function determineMaxNumOfSubnets($hostAddressSize) {
		return bindec(str_pad("", (24 - $hostAddressSize), 1)) + 1;
	}

	private function validateAddress($address, $isSubnet = false) {
		$parts = explode(".", $address);
		if (count($parts) != 4)
			return false;
		if ($isSubnet === true)
			foreach ($parts as $part)
				if ($part != 255 && $part != 254 && $part != 252 && $part != 248 && $part != 240 && $part != 224 && $part != 192 &&  $part != 128 &&  $part != 0)
				 	return false; 
		if (($isSubnet === true && $parts[0] != 255) || strval(intval($parts[0])) !== $parts[0] || $parts[0] > 255 || $parts[0] < 0)
			return false;
		if (($isSubnet === true && $parts[1] > $parts[0]) || strval(intval($parts[1])) !== $parts[1] || $parts[1] > 255 || $parts[1] < 0)
			return false;
		if (($isSubnet === true && $parts[2] > $parts[1]) || strval(intval($parts[2])) !== $parts[2] || $parts[2] > 255 || $parts[2] < 0)
			return false;
		if (($isSubnet === true && $parts[3] > $parts[2]) || strval(intval($parts[3])) !== $parts[3] || $parts[3] > 255 || $parts[3] < 0)
			return false;
		if ($isSubnet === true && ($part[3] == 255 || $part[3] == 254))
			return false;
		return true;
	}
}

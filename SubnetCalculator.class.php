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

interface SubnetCalculator {

	public function setIpAndSubnetAddress($ip, $netmask);

	public function getIpAddressAsDecimal();

	public function getIpAddress();

	public function getIpAddressAsHexadecimal();

	public function getIpAddressAsDottedBinary();

	public function getSubnetAddress();

	public function getSubnetAddressAsDecimal();

	public function getSubnetAddressAsHexadecimal();

	public function getSubnetAddressAsDottedBinary();

	public function getNetworkRemarks();

	public function getStartHostAddress();

	public function getStartHostAddressAsDecimal();

	public function getStartHostAddressAsHexadecimal();

	public function getStartHostAddressAsDottedBinary();

	public function getEndHostAddress();

	public function getEndHostAddressAsDecimal();

	public function getEndHostAddressAsHexadecimal();

	public function getEndHostAddressAsDottedBinary();

	public function getNetworkAddress();

	public function getNetworkAddressAsDecimal();

	public function getNetworkAddressAsHexadecimal();

	public function getNetworkAddressAsDottedBinary();

	public function getNetworkClass();

	public function getBroadcastAddress();

	public function getBroadcastAddressAsDecimal();

	public function getBroadcastAddressAsHexadecimal();

	public function getBroadcastAddressAsDottedBinary();

	public function getMaxNumOfHosts();

	public function getMaxNumOfSubnets();

	public function getNetworkAddressSize();

	public function getHostAddressSize();
}

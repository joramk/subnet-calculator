
```
<?xml version="1.0" encoding="ISO-8859-1"?>
<definitions xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:tns="http://ordos.ddn.lonet.org/soap/SubnetCalculator" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns="http://schemas.xmlsoap.org/wsdl/" targetNamespace="http://ordos.ddn.lonet.org/soap/SubnetCalculator">
<types>
<xsd:schema targetNamespace="http://ordos.ddn.lonet.org/soap/SubnetCalculator">
 <xsd:import namespace="http://schemas.xmlsoap.org/soap/encoding/" />
 <xsd:import namespace="http://schemas.xmlsoap.org/wsdl/" />
 <xsd:complexType name="IpInformation">
  <xsd:all>
   <xsd:element name="IpAddress" type="xsd:string"/>
   <xsd:element name="SubnetAddress" type="xsd:string"/>
  </xsd:all>
 </xsd:complexType>
 <xsd:complexType name="SubnetInformation">
  <xsd:all>
   <xsd:element name="Status" type="tns:StatusType"/>
   <xsd:element name="Result" type="tns:ResultType"/>
  </xsd:all>
 </xsd:complexType>
 <xsd:complexType name="StatusType">
  <xsd:all>
   <xsd:element name="StatusCode" type="xsd:int"/>
   <xsd:element name="StatusMessage" type="xsd:string"/>
  </xsd:all>
 </xsd:complexType>
 <xsd:complexType name="ResultType">
  <xsd:all>
   <xsd:element name="IpAddress" type="xsd:decimal"/>
   <xsd:element name="IpAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="IpAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="IpAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="SubnetAddress" type="xsd:decimal"/>
   <xsd:element name="SubnetAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="SubnetAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="SubnetAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="StartHostAddress" type="xsd:string"/>
   <xsd:element name="StartHostAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="StartHostAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="StartHostAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="EndHostAddress" type="xsd:string"/>
   <xsd:element name="EndHostAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="EndHostAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="EndHostAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="NetworkAddress" type="xsd:string"/>
   <xsd:element name="NetworkAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="NetworkAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="NetworkAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="BroadcastAddress" type="xsd:string"/>
   <xsd:element name="BroadcastAddressAsDecimal" type="xsd:decimal"/>
   <xsd:element name="BroadcastAddressAsHexadecimal" type="xsd:string"/>
   <xsd:element name="BroadcastAddressAsDottedBinary" type="xsd:string"/>
   <xsd:element name="MaxNumOfHosts" type="xsd:int"/>
   <xsd:element name="MaxNumOfSubnets" type="xsd:int"/>
   <xsd:element name="NetworkClass" type="xsd:string"/>
   <xsd:element name="NetworkAddressSize" type="xsd:int"/>
   <xsd:element name="HostAddressSize" type="xsd:int"/>
   <xsd:element name="NetworkRemarks" type="xsd:string"/>
  </xsd:all>
 </xsd:complexType>
</xsd:schema>
</types>
<message name="SubnetCalculatorRequest">
  <part name="name" type="tns:IpInformation" /></message>
<message name="SubnetCalculatorResponse">
  <part name="return" type="tns:SubnetInformation" /></message>
<portType name="SubnetCalculatorPortType">
  <operation name="SubnetCalculator">
    <documentation>A simple subnet calculator web service</documentation>
    <input message="tns:SubnetCalculatorRequest"/>
    <output message="tns:SubnetCalculatorResponse"/>
  </operation>
</portType>
<binding name="SubnetCalculatorBinding" type="tns:SubnetCalculatorPortType">
  <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
  <operation name="SubnetCalculator">
    <soap:operation soapAction="https://ordos.ddn.lonet.org/webservice/subnetcalculator/SubnetCalculator.php/SubnetCalculator" style="rpc"/>
    <input><soap:body use="encoded" namespace="http://subnetcalculator.webservice.lonet.org" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></input>
    <output><soap:body use="encoded" namespace="http://subnetcalculator.webservice.lonet.org" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/></output>
  </operation>
</binding>
<service name="SubnetCalculator">
  <port name="SubnetCalculatorPort" binding="tns:SubnetCalculatorBinding">
    <soap:address location="https://ordos.ddn.lonet.org:443/webservice/subnetcalculator/SubnetCalculator.php"/>
  </port>
</service>
</definitions>
```
<?php

namespace Onetoweb\Yuki\Sales;

use Spatie\ArrayToXml\ArrayToXml;
use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;
use SoapVar;

/**
 * Yui Api Client - Sales
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/Sales.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/Sales.asmx?WSDL';
    }
    
    /**
     * @return array
     */
    public function getSalesItems(): array
    {
        $response = $this->client->GetSalesItems([
            'sessionID' => $this->getSessionId(),
            'administrationID' => $this->getAdministrationId(),
        ]);
        
        if (isset($response->GetSalesItemsResult->any)) {
            
            $xml = new SimpleXMLElement($response->GetSalesItemsResult->any);
            
            return $this->toArray($xml->SalesItem);
        }
        
        return [];
    }
    
    /**
     * @param array $salesInvoices
     * 
     * @return void
     */
    public function processSalesInvoices(array $salesInvoices): void
    {
        $arrayToXml = new ArrayToXml($salesInvoices, [
            'rootElementName' => 'SalesInvoices',
            '_attributes' => [
                'xmlns' => 'urn:xmlns:http://www.theyukicompany.com:salesinvoices',
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            ],
        ]);
        $arrayToXml->dropXmlDeclaration();
        
        $xml = $arrayToXml->toXml();
        
        $xmlvar = new SoapVar('<ns1:xmlDoc>'.$xml.'</ns1:xmlDoc>', XSD_ANYXML);
        
        $processSalesInvoices = [
            'sessionId' => $this->getSessionId(),
            'administrationId' => $this->getAdministrationId(),
            'xmlDoc' => $xmlvar
        ];
        
        $this->client->ProcessSalesInvoices($processSalesInvoices);
    }
}
<?php

namespace Onetoweb\Yuki;

use SoapClient;
use SimpleXMLElement;

/**
 * Yuki Api Client Abstract
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
abstract class ClientAbstract implements ClientInterface
{
    /**
     * @var string
     */
    private $accessKey;
    
    /**
     * @var string
     */
    private $sessionId;
    
    /**
     * @var string
     */
    private $administrationId;
    
    /**
     * @var SoapClient
     */
    protected $client;
    
    /**
     * @param string $accessKey
     */
    public function __construct(string $accessKey)
    {
        $this->accessKey = $accessKey;
        
        $this->client = new SoapClient(static::getWdsl(), [
            'soap_version' => SOAP_1_2,
            'trace' => true
        ]);
    }
    
    /**
     * @return string
     */
    public function getSessionId(): string
    {
        if ($this->sessionId === null) {
            
            $response = $this->client->Authenticate([
                'accessKey' => $this->accessKey,
            ]);
            
            $this->sessionId = $response->AuthenticateResult;
        }
        
        return $this->sessionId;
    }
    
    /**
     * @return array
     */
    public function getAdministration(): array
    {
        $response = $this->client->Administrations([
            'sessionID' => $this->getSessionId(),
        ]);
        
        if (isset($response->AdministrationsResult->any)) {
            
            $xml = new SimpleXMLElement($response->AdministrationsResult->any);
            
            return $this->toArray($xml->Administration);
        }
        
        return [];
    }
    
    /**
     * @param string $administrationId
     * 
     * @return void
     */
    public function setAdministrationId(string $administrationId): void
    {
        $this->administrationId = $administrationId;
    }
    
    /**
     * @return string
     */
    public function getAdministrationId(): string
    {
        if ($this->administrationId === null) {
            
            $administration = $this->getAdministration();
            
            $this->administrationId =  $administration['ID'];
        }
        
        return $this->administrationId;
    }
    
    /**
     * @return array
     */
    public function getSupportedLanguages(): array
    {
        $response = $this->client->SupportedLanguages([
            'sessionID' => $this->getSessionId(),
        ]);
        
        if (isset($response->SupportedLanguagesResult->any)) {
            
            $xml = new SimpleXMLElement($response->SupportedLanguagesResult->any);
            
            return $this->toArray($xml->Language);
        }
        
        return [];
    }
    
    /**
     * @return array
     */
    public function getCompanies(): array
    {
        $response = $this->client->Companies([
            'sessionID' => $this->getSessionId(),
        ]);
        
        if (isset($response->CompaniesResult->any)) {
            
            $xml = new SimpleXMLElement($response->CompaniesResult->any);
            
            return $this->toArray($xml->Company);
        }
        
        return [];
    }
    
    /**
     * @return array
     */
    public function getDomains(): array
    {
        $response = $this->client->Domains([
            'sessionID' => $this->getSessionId(),
        ]);
        
        if ($response->DomainsResult->any) {
            
            $xml = new SimpleXMLElement($response->DomainsResult->any);
            
            return $this->toArray($xml->Domain);
        }
        
        return [];
    }
    
    /**
     * @return array
     */
    public function getCurrentDomain(): array
    {
        $response = $this->client->GetCurrentDomain([
            'sessionID' => $this->getSessionId(),
        ]);
        
        if (isset($response->GetCurrentDomainResult->any)) {
            
            $xml = new SimpleXMLElement($response->GetCurrentDomainResult->any);
            
            return $this->toArray($xml->Domain);
        }
        
        return [];
    }
    
    /**
     * @return string
     */
    public function getLanguage(): string
    {
        $response = $this->client->Language([
            'sessionID' => $this->getSessionId(),
        ]);
        
        return (string) $response->LanguageResult;
    }
    
    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->client->SetLanguage([
            'sessionID' => $this->getSessionId(),
            'language' => $language,
        ]);
    }
    
    /**
     * @param string $domainId
     */
    public function setCurrentDomain(string $domainId): void
    {
        $this->client->SetCurrentDomain([
            'sessionID' => $this->getSessionId(),
            'domainID' => $domainId,
        ]);
    }
    
    /**
     * @param array &$data
     * @return array
     */
    protected function mergeAttributes(array &$data): array
    {
        foreach ($data['@attributes'] as $attribute => $value) {
            $data[$attribute] = $value;
        }
        
        unset($data['@attributes']);
        
        return $data;
    }
    
    /**
     * @param SimpleXMLElement $xml
     * @return array
     */
    protected function toArray(SimpleXMLElement $xml): array
    {
        $data = [];
        
        if ($xml->count() > 1) {
            
            foreach ($xml as $element) {
                
                $dataElement = (array) $element;
                
                $this->mergeAttributes($dataElement);
                
                $data[] = $dataElement;
            }
            
        } elseif ($xml->count() == 1) {
            
            $data = (array) $xml;
            
            $this->mergeAttributes($data);
            
        }
        
        return $data;
    }
}
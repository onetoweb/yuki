<?php

namespace Onetoweb\Yuki\Domains;

use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;

/**
 * Yuki Api Client - Domains
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/Domains.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/Domains.asmx?WSDL';
    }
}
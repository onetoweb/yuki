<?php

namespace Onetoweb\Yuki\PettyCash;

use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;

/**
 * Yuki Api Client - PettyCash
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/PettyCash.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/PettyCash.asmx?WSDL';
    }
}
<?php

namespace Onetoweb\Yuki\Archive;

use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;

/**
 * Yuki Api Client - Archive
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/Archive.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/Archive.asmx?WSDL';
    }
}
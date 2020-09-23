<?php

namespace Onetoweb\Yuki\Contact;

use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;

/**
 * Yuki Api Client - Contact
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/Contact.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/Contact.asmx?WSDL';
    }
}
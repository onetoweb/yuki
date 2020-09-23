<?php

namespace Onetoweb\Yuki\Projects;

use Onetoweb\Yuki\ClientAbstract;
use SimpleXMLElement;

/**
 * Yuki Api Client - Projects
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 * @link https://api.yukiworks.be/ws/Projects.asmx
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public static function getWdsl(): string
    {
        return 'https://api.yukiworks.be/ws/Projects.asmx?WSDL';
    }
}
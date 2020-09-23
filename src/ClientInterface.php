<?php

namespace Onetoweb\Yuki;

/**
 * Yuki Client Interface
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
interface ClientInterface
{
    /**
     * @return string
     */
    public static function getWdsl(): string;
}
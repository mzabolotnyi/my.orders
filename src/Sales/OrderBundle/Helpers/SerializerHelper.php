<?php

namespace Sales\OrderBundle\Helpers;

use JMS\Serializer\SerializationContext;

class SerializerHelper
{
    /**
     * Returns serialization context for JMS\Serializer
     *
     * @param array $groups
     * @return SerializationContext
     */
    public static function createContext($groups)
    {
        $context = new SerializationContext();
        $context->setGroups($groups)
            ->setSerializeNull(true);

        return $context;
    }
}
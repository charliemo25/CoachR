<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class EditServices
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {}

    public function edit($object, $objectJson)
    {
        foreach (get_class_methods(get_class($objectJson)) as $key => $value) {
            if (strpos($value, 'get') !== false && $value !== 'getId') {
                $methodName = substr($value, 3);
                if (method_exists($object, 'set' . $methodName)) {
                    $getValue = call_user_func([$objectJson, 'get' . $methodName]);
                    if ($getValue !== null) {
                        call_user_func([$object, 'set' . $methodName], $getValue);
                        $this->em->persist($object);
                    }
                }
            }
        }                    
        
        $this->em->flush();
        return $object;  
    }
}

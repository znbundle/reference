<?php

namespace PhpBundle\Reference\Domain;

use PhpLab\Core\Domain\Interfaces\DomainInterface;

class Domain implements DomainInterface
{

    public function getName()
    {
        return 'reference';
    }


}


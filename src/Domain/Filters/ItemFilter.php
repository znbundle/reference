<?php

namespace ZnBundle\Reference\Domain\Filters;

use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Base\Enums\StatusEnum;
use ZnCore\Domain\Constraints\Enum;

class ItemFilter implements ValidateEntityByMetadataInterface
{

    protected $bookId = null;
    
    protected $bookName = null;

    protected $parentId = null;

    protected $statusId = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('bookId', new Assert\Positive());
        $metadata->addPropertyConstraint('parentId', new Assert\Positive());
        $metadata->addPropertyConstraint('statusId', new Assert\Positive());
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function setBookId($value) : void
    {
        $this->bookId = $value;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getBookName()
    {
        return $this->bookName;
    }

    public function setBookName($bookName): void
    {
        $this->bookName = $bookName;
    }

    public function setParentId($value) : void
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }
}
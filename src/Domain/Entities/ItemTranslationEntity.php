<?php

namespace ZnBundle\Reference\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;

class ItemTranslationEntity implements ValidateEntityByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $itemId = null;

    private $languageCode = null;

    private $title = null;

    private $shortTitle = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {

    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setItemId($value)
    {
        $this->itemId = $value;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function setLanguageCode($value)
    {
        $this->languageCode = $value;
    }

    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setShortTitle($value)
    {
        $this->shortTitle = $value;
    }

    public function getShortTitle()
    {
        return $this->shortTitle;
    }


}


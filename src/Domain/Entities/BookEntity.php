<?php

namespace ZnBundle\Reference\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityInterface;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;
use DateTime;

class BookEntity implements ValidateEntityInterface, EntityIdInterface
{

    private $id = null;

    private $title = null;

    private $levels = 1;

    private $entity = null;

    private $props = '{}';

    private $status = null;

    private $createdAt = null;

    private $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function validationRules()
    {
        return [
            'title' => [
                new Assert\NotBlank,
            ],
            'levels' => [
                new Assert\NotBlank,
                new Assert\Positive(),
            ],
            'entity' => [
                new Assert\NotBlank,
            ],
            'status' => [
                new Assert\PositiveOrZero(),
            ],
            'createdAt' => [
                new Assert\NotBlank,
            ],
        ];
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setLevels($value)
    {
        $this->levels = $value;
    }

    public function getLevels()
    {
        return $this->levels;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setProps($value)
    {
        $this->props = $value;
    }

    public function getProps()
    {
        return $this->props;
    }

    public function setStatus(int $value)
    {
        $this->status = $value;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setCreatedAt($value)
    {
        $this->createdAt = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($value)
    {
        $this->updatedAt = $value;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


}


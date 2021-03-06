<?php

namespace ZnBundle\Reference\Domain\Entities;

use Illuminate\Support\Collection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Base\Helpers\EnumHelper;
use ZnCore\Domain\Interfaces\Entity\EntityIdInterface;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;
use ZnCore\Base\Enums\StatusEnum;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
use ZnCore\Domain\Traits\Entity\SoftDeleteEntityTrait;
use ZnCore\Domain\Traits\Entity\SoftRestoreEntityTrait;
use ZnCore\Domain\Traits\Entity\StatusReadOnlyEntityTrait;

class ItemEntity implements ValidateEntityByMetadataInterface, EntityIdInterface
{

    use StatusReadOnlyEntityTrait;
    use SoftDeleteEntityTrait;
    use SoftRestoreEntityTrait;

    private $id = null;
    private $bookId = null;
    private $parentId = null;
    private $code = null;
    private $title = null;
    private $shortTitle = null;
    private $entity = null;
    private $statusId = StatusEnum::ENABLED;
    private $sort = 0;
    private $props = null;
    private $createdAt = null;
    private $updatedAt = null;
    private $book;
    private $parent;

    /** @var Collection | ItemTranslationEntity[] */
    private $translations = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive);
        $metadata->addPropertyConstraint('bookId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('bookId', new Assert\Positive);
        $metadata->addPropertyConstraint('parentId', new Assert\Positive);
        $metadata->addPropertyConstraint('statusId', new Assert\Choice([
            'choices' => EnumHelper::getValues(StatusEnum::class)
        ]));
        $metadata->addPropertyConstraint('sort', new Assert\Positive);
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBookId($value)
    {
        $this->bookId = $value;
    }

    public function getBookId()
    {
        return $this->bookId;
    }

    public function setParentId($value)
    {
        $this->parentId = $value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setCode($value)
    {
        $this->code = $value;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTitle()
    {
        if (empty($this->title) && !empty($this->translations) && $this->translations->count()) {
            /** @var ItemTranslationEntity $translationEntity */
            $translationEntity = $this->translations->first();
            $this->title = $translationEntity->getTitle();
        }
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getShortTitle()
    {
        if (empty($this->shortTitle) && !empty($this->translations) && $this->translations->count()) {
            /** @var ItemTranslationEntity $translationEntity */
            $translationEntity = $this->translations->first();
            $this->shortTitle = $translationEntity->getShortTitle();
        }
        return $this->shortTitle;
    }

    public function setShortTitle($shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    public function setEntity($value)
    {
        $this->entity = $value;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function setProps($value)
    {
        $this->props = $value;
    }

    public function getProps()
    {
        return $this->props;
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

    public function getTranslations(): ?Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations = null): void
    {
        $this->translations = $translations;
    }

    public function getBook(): ?BookEntity
    {
        return $this->book;
    }

    public function setBook(BookEntity $book): void
    {
        $this->book = $book;
    }

    public function getParent(): ?ItemEntity
    {
        return $this->parent;
    }

    public function setParent(ItemEntity $parent): void
    {
        $this->parent = $parent;
    }

}


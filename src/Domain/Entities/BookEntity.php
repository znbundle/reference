<?php

namespace ZnBundle\Reference\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnBundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use ZnCore\Base\Enums\StatusEnum;
use ZnCore\Base\Helpers\EnumHelper;
use ZnCore\Base\Libs\I18Next\Traits\I18nTrait;
use ZnCore\Domain\Constraints\Enum;
use ZnCore\Domain\Interfaces\Entity\UniqueInterface;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;
use ZnCore\Contract\Domain\Interfaces\Entities\EntityIdInterface;
use DateTime;
use ZnCore\Domain\Traits\Entity\SoftDeleteEntityTrait;
use ZnCore\Domain\Traits\Entity\SoftRestoreEntityTrait;
use ZnCore\Domain\Traits\Entity\StatusReadOnlyEntityTrait;

class BookEntity implements ValidateEntityByMetadataInterface, EntityIdInterface, UniqueInterface
{

    use StatusReadOnlyEntityTrait;
    use SoftDeleteEntityTrait;
    use SoftRestoreEntityTrait;
    use I18nTrait;

    private $id = null;

    private $parentId = null;

    private $code = null;

    private $title = null;

    private $titleI18n = null;

    private $levels = 1;

    private $entity = null;

    private $props = '{}';

    private $statusId = StatusEnum::ENABLED;

    private $createdAt = null;

    private $updatedAt = null;

    public function __construct(RuntimeLanguageServiceInterface $languageService)
    {
        $this->createdAt = new DateTime();
        $this->_setRuntimeLanguageService($languageService);
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new Assert\NotBlank);
        $metadata->addPropertyConstraint('titleI18n', new Assert\NotBlank);
        $metadata->addPropertyConstraint('levels', new Assert\NotBlank);
        $metadata->addPropertyConstraint('levels', new Assert\Positive());
        $metadata->addPropertyConstraint('entity', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
        $metadata->addPropertyConstraint('createdAt', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [
            ['entity'],
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

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): void
    {
        $this->code = $code;
    }

    public function setTitle($value): void
    {
        $this->_setI18n('title', $value);
    }

    public function getTitle()
    {
        return $this->_getI18n('title');
    }

    public function getTitleI18n()
    {
        return $this->_getI18nArray('title');
    }

    public function setTitleI18n($titleI18n): void
    {
        $this->titleI18n = $titleI18n;
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


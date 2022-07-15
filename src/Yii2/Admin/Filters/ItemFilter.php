<?php

namespace ZnBundle\Reference\Yii2\Admin\Filters;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnDomain\Сomponents\EnumRepository\Constraints\Enum;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnLib\Components\Status\Enums\StatusSimpleEnum;

class ItemFilter implements ValidationByMetadataInterface
{

    protected $bookId;
    protected $statusId = StatusSimpleEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusSimpleEnum::class,
        ]));
        $metadata->addPropertyConstraint('bookId', new Assert\Positive());
    }

    public function setStatusId(int $value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getBookId(): ?int
    {
        return $this->bookId;
    }

    public function setBookId(?int $bookId): void
    {
        $this->bookId = $bookId;
    }
}

<?php

namespace ZnBundle\Reference\Yii2\Admin\Filters;

use ZnSandbox\Sandbox\Status\Domain\Filters\BaseStatusFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ItemFilter extends BaseStatusFilter
{

    protected $bookId;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        self::loadStatusValidatorMetadata($metadata);
        $metadata->addPropertyConstraint('bookId', new Assert\Positive());
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

<?php

namespace ZnBundle\Reference\Yii2\Admin\Filters;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Enum\Constraints\Enum;
use ZnCore\Validation\Interfaces\ValidationByMetadataInterface;
use ZnSandbox\Sandbox\Status\Domain\Enums\StatusEnum;

class BookFilter implements ValidationByMetadataInterface
{

    protected $statusId = StatusEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function setStatusId(int $value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }
}

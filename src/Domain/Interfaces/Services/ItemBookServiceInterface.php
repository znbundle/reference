<?php

namespace ZnBundle\Reference\Domain\Interfaces\Services;

use ZnCore\Domain\Interfaces\Service\CrudServiceInterface;

interface ItemBookServiceInterface extends CrudServiceInterface
{

    public function getBookId(): int;

    public function setBookId(int $bookId): void;

    public function getBookName(): string;

    public function setBookName(string $bookName): void;
}


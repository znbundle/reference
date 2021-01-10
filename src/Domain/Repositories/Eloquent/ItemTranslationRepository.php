<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Entities\ItemTranslationEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use ZnCore\Base\Libs\I18Next\Services\TranslationService;
use ZnCore\Domain\Entities\Query\Where;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;
use ZnCore\Domain\Libs\Query;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use ZnLib\Db\Capsule\Manager;

class ItemTranslationRepository extends BaseEloquentCrudRepository implements ItemTranslationRepositoryInterface
{

    protected $tableName = 'reference_item_translation';
    protected $translationService;

    public function getEntityClass(): string
    {
        return ItemTranslationEntity::class;
    }

    public function __construct(EntityManagerInterface $em, Manager $capsule, TranslationService $translationService)
    {
        parent::__construct($em, $capsule);
        $this->translationService = $translationService;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $where = new Where('language_code', $this->translationService->getLanguage());
        $query->whereNew($where);
        return $query;
    }
}

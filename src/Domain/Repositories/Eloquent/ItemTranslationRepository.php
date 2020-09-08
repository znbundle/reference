<?php

namespace ZnBundle\Reference\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Entities\ItemTranslationEntity;
use ZnBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use ZnCore\Base\Domain\Entities\Query\Where;
use ZnCore\Base\Domain\Libs\Query;
use ZnCore\Base\Libs\I18Next\Interfaces\Services\TranslationServiceInterface;
use ZnCore\Db\Db\Base\BaseEloquentCrudRepository;
use ZnCore\Db\Db\Helpers\Manager;

class ItemTranslationRepository extends BaseEloquentCrudRepository implements ItemTranslationRepositoryInterface
{

    protected $tableName = 'reference_item_translation';
    protected $translationService;

    public function getEntityClass(): string
    {
        return ItemTranslationEntity::class;
    }

    public function __construct(Manager $capsule, TranslationServiceInterface $translationService)
    {
        parent::__construct($capsule);
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

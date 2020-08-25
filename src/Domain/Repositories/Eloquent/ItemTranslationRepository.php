<?php

namespace PhpBundle\Reference\Domain\Repositories\Eloquent;

use PhpBundle\Reference\Domain\Entities\ItemTranslationEntity;
use PhpBundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use PhpLab\Core\Domain\Entities\Query\Where;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Libs\I18Next\Interfaces\Services\TranslationServiceInterface;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Eloquent\Db\Helpers\Manager;

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

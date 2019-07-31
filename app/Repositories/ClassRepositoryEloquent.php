<?php

namespace App\Repositories;

use App\Entities\Classes;
use App\Validators\ClassValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class ClassRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClassRepositoryEloquent extends BaseRepository implements ClassRepository
{
    use CacheableRepository;

    protected $fieldSearchable = [
        'name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classes::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return ClassValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

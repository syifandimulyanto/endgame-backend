<?php

namespace App\Repositories;

use App\Entities\ProgramStudy;
use App\Validators\ProgramStudyValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class ProgramStudyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProgramStudyRepositoryEloquent extends BaseRepository implements ProgramStudyRepository
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
        return ProgramStudy::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return ProgramStudyValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

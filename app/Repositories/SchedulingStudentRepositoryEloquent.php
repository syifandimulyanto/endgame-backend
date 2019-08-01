<?php

namespace App\Repositories;

use App\Entities\StudentSchedule;
use App\Validators\SchedulingStudentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class SchedulingStudentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SchedulingStudentRepositoryEloquent extends BaseRepository implements SchedulingStudentRepository
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
        return StudentSchedule::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return SchedulingStudentValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

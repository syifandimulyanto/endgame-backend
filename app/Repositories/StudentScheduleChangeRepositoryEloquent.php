<?php

namespace App\Repositories;

use App\Entities\Student;
use App\Entities\StudentScheduleChange;
use App\Validators\StudentScheduleChangeValidator;
use App\Validators\StudentValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class StudentScheduleChangeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentScheduleChangeRepositoryEloquent extends BaseRepository implements StudentScheduleChangeRepository
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
        return StudentScheduleChange::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return StudentScheduleChangeValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

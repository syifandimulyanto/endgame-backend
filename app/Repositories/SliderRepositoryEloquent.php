<?php

namespace App\Repositories;

use App\Entities\Slider;
use App\Validators\SliderValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class SliderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SliderRepositoryEloquent extends BaseRepository implements SliderRepository
{
    use CacheableRepository;

    protected $fieldSearchable = [
        'title' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Slider::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return SliderValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

<?php

namespace App\Repositories;

use App\Entities\User;
use App\Validators\AccountUserValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class AccountUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountUserRepositoryEloquent extends BaseRepository implements AccountUserRepository
{
    use CacheableRepository;

    protected $fieldSearchable = [
        'first_name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return AccountUserValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}

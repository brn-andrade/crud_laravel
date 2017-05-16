<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NerdRepository;
use App\Entities\Nerd;
use App\Validators\NerdValidator;

/**
 * Class NerdRepositoryEloquent
 * @package namespace App\Repositories;
 */
class NerdRepositoryEloquent extends BaseRepository implements NerdRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Nerd::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NerdValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

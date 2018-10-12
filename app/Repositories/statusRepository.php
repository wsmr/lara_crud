<?php

namespace App\Repositories;

use App\Models\status;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class statusRepository
 * @package App\Repositories
 * @version October 12, 2018, 3:09 pm UTC
 *
 * @method status findWithoutFail($id, $columns = ['*'])
 * @method status find($id, $columns = ['*'])
 * @method status first($columns = ['*'])
*/
class statusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return status::class;
    }
}

<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class TransporterRepository extends Repository
{

    public function getFiltered($filters = [])
    {
        $query = $this->model->on();

        $name = @$filters['name'];

        $query->when($name, function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        });

        $query->where('isDeleted', 0);

        return $query->paginate();
    }
}

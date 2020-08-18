<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class SourceRepository extends Repository
{

    public function getFiltered($filters = [])
    {
        $query = $this->model->on();

        $city = @$filters['city'];
        $state = @$filters['state'];
        $country = @$filters['country'];

        $query->when($city, function ($query, $city) {
            $query->where('city', 'LIKE', '%' . $city . '%');
        });

        $query->when($state, function ($query, $state) {
            $query->where('state', 'LIKE', '%' . $state . '%');
        });

        $query->when($country, function ($query, $country) {
            $query->where('country', 'LIKE', '%' . $country . '%');
        });

        $query->where('isDeleted', 0);

        return $query->paginate();
    }
}

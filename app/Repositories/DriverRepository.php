<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class DriverRepository extends Repository
{

    public function getFiltered($filters = [])
    {
        $query = $this->model->on();

        $name = @$filters['name'];
        $phone = @$filters['phone'];
        $address = @$filters['address'];

        $query->when($name, function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        });

        $query->when($phone, function ($query, $phone) {
            $query->where('phone', 'LIKE', '%' . $phone . '%');
        });

        $query->when($address, function ($query, $address) {
            $query->where('country', 'LIKE', '%' . $address . '%');
        });

        $query->where('isDeleted', 0);

        return $query->paginate();
    }
}

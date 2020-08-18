<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class VehicleRepository extends Repository
{

    public function getFiltered($filters = [])
    {
        $query = $this->model->on();

        $vehicle_no = @$filters['vehicle_no'];
        $vehicle_name = @$filters['vehicle_name'];
        $vehicle_model = @$filters['vehicle_model'];

        $query->when($vehicle_no, function ($query, $vehicle_no) {
            $query->where('vehicle_no', 'LIKE', '%' . strtoupper($vehicle_no) . '%');
        });

        $query->when($vehicle_name, function ($query, $vehicle_name) {
            $query->where('vehicle_name', 'LIKE', '%' . $vehicle_name . '%');
        });

        $query->when($vehicle_model, function ($query, $vehicle_model) {
            $query->where('vehicle_model', 'LIKE', '%' . $vehicle_model . '%');
        });
        $query->where('isDeleted', 0);

        return $query->paginate();
    }
}

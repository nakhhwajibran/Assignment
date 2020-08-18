<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;

class DispatchRepository extends Repository
{

    public function getFiltered($filters = [])
    {
        $query = $this->model->on();

        $deliveryNo = @$filters['delivery_no'];
        $shipmentNo = @$filters['shipment_no'];
        $source = @$filters['source'];
        $destination = @$filters['destination'];
        $vehicleNo = @$filters['vehicle_no'];
        $transporter = @$filters['transporter'];
        $startDate = @$filters['start_date'];
        $endDate = @$filters['end_date'];
        $driver = @$filters['driver'];
        $take = @$filters['take'];
        $skip = @$filters['skip'];

        $query->when($source, function ($query, $source) {
            return $query->whereHas("source", function ($query) use ($source) {
                $query->where('city', 'LIKE', '%' . $source . '%')
                    ->orWhere('state', 'LIKE', '%' . $source . '%')
                    ->orWhere('country', 'LIKE', '%' . $source . '%');
            });
        });

        $query->when($destination, function ($query, $destination) {
            return $query->whereHas("destination", function ($query) use ($destination) {
                $query->where('city', 'LIKE', '%' . $destination . '%')
                    ->orWhere('state', 'LIKE', '%' . $destination . '%')
                    ->orWhere('country', 'LIKE', '%' . $destination . '%');
            });
        });

        $query->when($driver, function ($query, $driver) {
            return $query->whereHas("driver", function ($query) use ($driver) {
                $query->where('name', 'LIKE', '%' . $driver . '%')
                    ->orWhere('phone', 'LIKE', '%' . $driver . '%')
                    ->orWhere('address', 'LIKE', '%' . $driver . '%');
            });
        });

        $query->when($transporter, function ($query, $transporter) {
            return $query->whereHas("transporter", function ($query) use ($transporter) {
                $query->where('name', 'LIKE', '%' . $transporter . '%');
            });
        });

        $query->when($deliveryNo, function ($query, $deliveryNo) {
            $query->where('delivery_no', 'LIKE', '%' . $deliveryNo . '%');
        });

        $query->when($shipmentNo, function ($query, $shipmentNo) {
            $query->where('shipment_no', 'LIKE', '%' . $shipmentNo . '%');
        });

        $query->when($vehicleNo, function ($query, $vehicleNo) {
            return $query->whereHas("vehicle", function ($query) use ($vehicleNo) {
                $query->where('vehicle_no', 'LIKE', '%' . $vehicleNo . '%');
            });
        });

        $query->when($startDate, function ($query, $startDate) {
            $query->where('startDate', 'LIKE', '%' . $startDate . '%');
        });

        $query->when($endDate, function ($query, $endDate) {
            $query->where('endDate', 'LIKE', '%' . $endDate . '%');
        });

        $query->when($skip, function ($query, $skip) {
            $query->skip($skip);
        });

        $query->when($take, function ($query, $take) {
            $query->take($take);
        });

        $query->where('isDeleted', 0);

        $query->with(['source', 'driver', 'destination', 'transporter', 'vehicle']);

        return $query->get();
    }


    public function getdispatchData($arr)
    {
        $dispatch = array();
        foreach ($arr as $k => $d) {
            $dispatch[$k]['id'] = $d->id;
            $dispatch[$k]['delivery_no'] = $d->delivery_no;
            $dispatch[$k]['shipment_no'] = $d->shipment_no;
            $dispatch[$k]['source_city'] = $d->source->city;
            $dispatch[$k]['source_state'] = $d->source->state;
            $dispatch[$k]['source_country'] = $d->source->country;
            $dispatch[$k]['destination_city'] = $d->destination->city;
            $dispatch[$k]['destination_state'] = $d->destination->state;
            $dispatch[$k]['destination_country'] = $d->destination->country;
            $dispatch[$k]['transporter_name'] = $d->transporter->name;
            $dispatch[$k]['driver_name'] = $d->driver->name;
            $dispatch[$k]['driver_phone'] = $d->driver->phone;
            $dispatch[$k]['vehicle_name'] = $d->vehicle->vehicle_name;
            $dispatch[$k]['vehicle_no'] = $d->vehicle->vehicle_no;
            $dispatch[$k]['vehicle_model'] = $d->vehicle->vehicle_model;
            $dispatch[$k]['startDate'] = $d->startDate;
            $dispatch[$k]['endDate'] = $d->endDate;
            $dispatch[$k]['address'] = $d->address;
        }
        return $dispatch;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Transport\Transport;

class Dispatch extends Model
{
    //

    protected $table = "dispatches";

    protected $fillable = [
        'delivery_no', 'shipment_no', 'source_id', 'destination_id', 'vehicle_id', 'address', 'transporter_id', 'driver_id', 'startDate', 'endDate', 'created_by', 'updated_by'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, "driver_id", "id");
    }

    public function source()
    {
        return $this->belongsTo(Source::class, "source_id", "id");
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, "destination_id", "id");
    }

    public function transporter()
    {
        return $this->belongsTo(Transporter::class, "transporter_id", "id");
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, "vehicle_id", "id");
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, "updated_by", "id");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $table = "drivers";

    protected $fillable = [
        'uid', 'name', 'phone', 'address', 'transporter_id', 'created_by', 'updated_by', 'isDeleted'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, "updated_by", "id");
    }
}

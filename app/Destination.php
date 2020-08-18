<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //

    protected $table = 'destination';

    protected $fillable = [
        'uid', 'city', 'country', 'state', 'created_by', 'updated_by'
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    //
    protected $table = 'transporter';

    protected $fillable = [
        'uid', 'name', 'created_by', 'updated_by'
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

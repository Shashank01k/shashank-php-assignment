<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersTaskMaster extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'users_tasks_masters'; // Specify the table name

    // Define fillable fields
    protected $fillable = ['task'];

    protected $hidden = [
        'is_deleted',
        'deleted_at'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }
    public function getUpdatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('d F Y H:i:s');
    }
    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('d F Y H:i:s');
    }
}

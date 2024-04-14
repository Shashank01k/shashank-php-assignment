<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class UsersTask extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $table = 'users_tasks'; // Specify the table name

    // Define fillable fields
    protected $fillable = ['user_id','task_id','task_name','title','description', 'status', 'due_date'];

    protected $hidden = [
        'deleted_at',
        'is_deleted'
    ];

    // Define relationships if any
    public function user()
    {
        return $this->belongsTo(User::class);
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

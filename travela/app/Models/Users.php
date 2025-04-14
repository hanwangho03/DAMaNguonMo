<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; 

    protected $primaryKey = 'userId'; 

    public $timestamps = false; 

    protected $fillable = [
        'username', 'email', 'password', 'isAdmin', 'status'
    ];

    public function getUserId($username)
    {
        return DB::table($this->table)
            ->select('userId')
            ->where('username', $username)
            ->value('userId');
    }

    public function getUser($id)
    {
        return DB::table($this->table)
            ->where('userId', $id)
            ->first();
    }

    public function updateUser($id, $data)
    {
        return DB::table($this->table)
            ->where('userId', $id) 
            ->update($data);
    }
}

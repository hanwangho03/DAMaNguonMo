<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Đảm bảo đúng tên bảng

    protected $primaryKey = 'userId'; // Nếu khóa chính không phải `id`

    public $timestamps = false; // Nếu không dùng `created_at` và `updated_at`

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
            ->where('userId', $id) // Chú ý `userId` thay vì `userid`
            ->update($data);
    }
}

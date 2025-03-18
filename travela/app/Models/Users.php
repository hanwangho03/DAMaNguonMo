<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'user';


    public function getUserId($username)
    {
        return DB::table($this->table)
            ->select('userId')
            ->where('username', $username)->value('userId');
    }
    public function getUser($id)
    {
        $users = DB::table($this->table)
            ->where('userId', $id)->first();

        return $users;
    }

    public function updateUser($id, $data)
    {
        $update = DB::table($this->table)
            ->where('userid', $id)
            ->update($data);

        return $update;
    }
}

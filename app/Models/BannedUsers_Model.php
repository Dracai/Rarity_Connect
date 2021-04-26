<?php namespace App\Models;

use CodeIgniter\Model;

class BannedUsers_Model extends Model
{
    protected $table = 'banned_users';
    protected $allowedFields = ['bannedID', 'userID', 'email'];

    public function checkIfBanned($email)
    {
        $bannedUser = new BannedUsers_Model();
        $banned = $bannedUser->where('email', $email)
                            ->first();
        
        if($banned)
        {
            return true;
        }
        else
            return false;
    }
}
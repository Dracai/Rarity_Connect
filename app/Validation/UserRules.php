<?php namespace App\Validation;

use App\Models\User_Model;
use App\Models\Administrator_Model;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $userModel = new User_Model();
        $adminModel = new Administrator_Model();

        $admin = $adminModel->where('email', $data['email'])
                    ->first();

        $user = $userModel->where('email', $data['email'])
                    ->first();

        if($user)
            return password_verify($data['passwordHash'], $user['passwordHash']);
        else if($admin)    
            return password_verify($data['passwordHash'], $admin['passwordHash']);
        else
            return false;
    }
}
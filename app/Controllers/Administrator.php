<?php namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Administrator_Model;

class Administrator extends BaseController 
{
    public function viewUsers()
    {
        $users = new User_Model();
        $data['users'] = $users->getUsers();
        
        echo view('templates/header', $data);
        echo view('admin_functions_page');
        echo view('templates/footer');
    }
}
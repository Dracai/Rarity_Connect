<?php namespace App\Controllers;

use App\Models\Administrator_Model;
use App\Models\User_Model;
use App\Models\Posts_Model;

class Administrator extends BaseController 
{
    public function viewUsers()
    {
        $users = new User_Model();
        $data['users'] = $users->getUsers();

        //This takes the User Id inputted in the search bar
        //getVar function returns a single variable of from the specified field
        $keyword = $this->request->getVar('searchID');

        //If no User Id was inputted then set the $result to nothing
        if($keyword == null)
        {
            $result['results'] = [];
            
            echo view('templates/header', $data + $result);
            echo view('admin_functions_page');
            echo view('templates/footer');
        }
        //If there was a User Id search for the User in the database and
        //return the User object 
        else {
            $result['results'] = $users->search($keyword);

            echo view('templates/header', $data + $result);
            echo view('admin_functions_page');
            echo view('templates/footer');
        }
    }
}
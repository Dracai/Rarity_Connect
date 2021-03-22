<?php namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Administrator_Model;

class GeneralUser extends BaseController
{

    public function index()
	{
		echo view("templates/header");
		echo view("home");
		echo view("templates/footer");
	}

    public function login()
    {
        $data = [];
		helper(['form']);
        $userModel = new User_Model();
        $adminModel = new Administrator_Model();

		if ($this->request->getMethod() == 'post') {
			
            //Validation rules for Logging In
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'passwordHash' => 'required|min_length[8]|max_length[255]|validateUser[email, passwordHash]',
			];
            
            //Error messgae for when Email and Password don't match the database
			$errors = [
				'passwordHash' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];


			if ($adminModel->adminCheck($_POST['email']))
            {
                    $admin = $adminModel->where('email', $_POST['email'])
								    ->first();

                    $this->setAdminSession($admin);
                    return redirect()->to('dashboard');
            }
            else if ($userModel->userCheck($_POST['email']))
            {
                    $user = $userModel->where('email', $_POST['email'])
								    ->first();

                    $this->setUserSession($user);
                    return redirect()->to('dashboard');
            }
            else 
            {

            }
        }
        echo view('templates/header', $data);
        echo view('login');
        echo view('templates/footer');
    }

    private function setUserSession($user)
    {
        $data = [
            'idUser' => $user['idUser'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'email' => $user['email'],
            'isLoggedInUser' => true,
        ];

        session()->set($data);
        return true;
    }

    private function setAdminSession($admin)
    {
        $data = [
            'idAdmin' => $admin['idAdmin'],
            'firstName' => $admin['firstName'],
            'lastName' => $admin['lastName'],
            'email' => $admin['email'],
            'isLoggedInAdmin' => true,
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post')
        {
            //Validation Rules for registering
            $rules = [
                'firstName' => 'required|min_length[3]|max_length[45]',
                'lastName' => 'required|min_length[3]|max_length[45]',
                'email' => 'required|min_length[6]|max_length[45]|valid_email|is_unique[user.email]',
                'passwordHash' => 'required|min_length[8]|max_length[255]',
                'passwordHash_confirm' => 'matches[passwordHash]',
            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{
                $model = new User_Model();

                $newData = [
                    'firstName' => $_POST['firstName'],
                    'lastName' => $_POST['lastName'],
                    'email' => $_POST['email'],
                    'passwordHash' => $_POST['passwordHash']
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/login');
            }
        }

        echo view('templates/header', $data);
        echo view('register');
        echo view('templates/footer');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

}
<?php namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Administrator_Model;
use App\Models\Moderator_Model;
use App\Models\Posts_Model;

class GeneralUser extends BaseController
{

    public function index()
	{
        //Echo view functions is used to load and disply a particular view file
		echo view("templates/header");
		echo view("home");
		echo view("templates/footer");
	}

    public function login()
    {
        $data = [];

        //Enables me to use functions for working with forms
		helper(['form']);

        //Here I am just getting instances of each model
        $adminModel = new Administrator_Model();
        $modModel = new Moderator_Model();
        $userModel = new User_Model();
        

		if ($this->request->getMethod() == 'post') {

            //Functions in the if statments are validations for if the user exists
            //and if the inputted password corresponds to the User found in the db
			if($adminModel->adminCheck($_POST['email']) && $adminModel->checkPassword($_POST['email'], $_POST['passwordHash']))
            {
                //Looks in the database for the user with the corresponding email
                $admin = $adminModel->where('email', $_POST['email'])
								    ->first();

                //Calls the function to set the user session
                $this->setAdminSession($admin);
                return redirect()->to('/dashboard');
            }
            else if($modModel->modCheck($_POST['email']) && $modModel->checkPassword($_POST['email'], $_POST['passwordHash']))
            {
                $mod = $modModel->where('email', $_POST['email'])
								->first();

                $this->setModSession($mod);
                return redirect()->to('/dashboard');
            }
            else if ($userModel->userCheck($_POST['email']) && $userModel->checkPassword($_POST['email'], $_POST['passwordHash']))
            {
                $user = $userModel->where('email', $_POST['email'])
								->first();

                $this->setUserSession($user);
                return redirect()->to('/dashboard');
            }
            else 
            {
                $session = session();
                //If logging in was unsucessful then flashdata is set to show
                //that the login was unsucessful
                $session->setFlashdata('failed', 'Email and Password don\'t match');
                return redirect()->to('/login');
            }
        }
        echo view('templates/header', $data);
        echo view('login');
        echo view('templates/footer');
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

    private function setModSession($mod)
    {
        $data = [
            'idMod' => $mod['idMod'],
            'firstName' => $mod['firstName'],
            'lastName' => $mod['lastName'],
            'email' => $mod['email'],
            'isLoggedInMod' => true,
        ];

        session()->set($data);
        return true;
    }

    private function setUserSession($user)
    {
        //Gets data about the user and sets the session
        $data = [
            'idUser' => $user['idUser'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'email' => $user['email'],
            'isLoggedInUser' => true,
        ];

        //This sets the session for the User and sets the LoggedIn 
        //state to true
        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];

        //Enables me to use functions for working with forms
        helper(['form']);

        //If the form send a post method then the code in the if will come
        //into affect
        if($this->request->getMethod() == 'post')
        {
            //Validation Rules for registering
            $rules = [
                'firstName' => 'required|min_length[3]|max_length[45]',
                'lastName' => 'required|min_length[3]|max_length[45]',
                'email' => 'required|min_length[6]|max_length[45]|valid_email|is_unique[user.email]|is_unique[administrator.email]|is_unique[moderator.email]',
                'passwordHash' => 'required|min_length[8]|max_length[255]',
                'passwordHash_confirm' => 'matches[passwordHash]',
            ];

            //Firstly the program will check if the inputted information
            //matches the rules set for registering. If not the a message 
            //will be displayed to the user.
            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{
                //Creates an istance of the User Model
                $model = new User_Model();

                //Gets data from the form and saves it to the $newData array
                $newData = [
                    'firstName' => $_POST['firstName'],
                    'lastName' => $_POST['lastName'],
                    'email' => $_POST['email'],
                    'passwordHash' => $_POST['passwordHash']
                ];

                //You take the data from the form and you save the data to the
                //User model which puts the data into the database
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

    //Functions to destroy the session of the User after 
    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function aboutUs()
    {
        $data = [];

        echo view('templates/header', $data);
        echo view('aboutus');
        echo view('templates/footer');
    }

    public function dashboard()
	{
		$data = [];

		echo view("templates/header", $data);
		echo view("dashboard");
		echo view("templates/footer");
	}

    public function displayPosts()
    {
        $model = new Posts_Model();

        $data['news'] = $model->getPosts();

        echo view("templates/header", $data);
		echo view("forum/postsPage");
		echo view("templates/footer");
    }

    public function viewPost($postID)
    {
        $model = new Posts_Model();

        $data['post'] = $model->getPosts($postID);

        echo view("templates/header", $data);
		echo view("forum/posts");
		echo view("templates/footer");
    }

    public function createPost()
    {
        $data = [];

        helper(['form']);

        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'title' => 'required|min_length[5]|max_length[100]',
                'content' => 'required|min_length[5]|max_length[255]'
            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else
            {
                $model = new Posts_Model();
                if(session()->get('isLoggedInUser'))
                {
                    $userID = session()->get('idUser');

                    $model->save(
                    [
                        'userID' => $userID,
                        'title' => $this->request->getVar('title'),
                        'content' =>$this->request->getVar('content')
                    ]
                    );

                    $session = session();
                    $session->setFlashData('posted', 'Post has been posted !');
                    return redirect()->to('/forum/postsPage');
                }
                elseif(session()->get('isLoggedInAdmin'))
                {
                    $adminID = session()->get('idAdmin');

                    $model->save(
                    [
                        'adminID' => $adminID,
                        'title' => $this->request->getVar('title'),
                        'content' =>$this->request->getVar('content')
                    ]
                    );

                    $session = session();
                    $session->setFlashData('posted', 'Post has been posted !');
                    return redirect()->to('/forum/postsPage');
                }
            }
        }

        echo view("templates/header", $data);
		echo view("forum/createPost");
		echo view("templates/footer");
    }
}
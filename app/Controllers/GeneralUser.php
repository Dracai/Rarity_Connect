<?php namespace App\Controllers;

use App\Models\User_Model;
use App\Models\Administrator_Model;
use App\Models\Comments_Model;
use App\Models\Moderator_Model;
use App\Models\Posts_Model;
use App\Models\BannedUsers_Model;

class GeneralUser extends BaseController
{

    // Routing -> $routes->get('view', 'controller', [filter] );

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
        $userModel = new User_Model();
        $bannedUsers = new BannedUsers_Model();
        

		if ($this->request->getMethod() == 'post') 
        {
            if(!$bannedUsers->checkIfBanned($_POST['email']))
            {

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
            else
            {
                $session = session();
                $session->setFlashdata('banned', 'This user had been banned');
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
        $bannedUsers = new BannedUsers_Model();

        //Enables me to use functions for working with forms
        helper(['form']);

        //If the form send a post method then the code in the if will come
        //into affect
        if($this->request->getMethod() == 'post')
        {
            if(!$bannedUsers->checkIfBanned($_POST['email'])){
                
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
            else
            {
                $session = session();
                $session->setFlashdata('banned', 'This user had been banned');
                return redirect()->to('/register');
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

    public function rules()
    {
        $data = [];

        echo view('templates/header', $data);
        echo view('rules');
        echo view('templates/footer');
    }

    public function dashboard()
	{
		$postModel = new Posts_Model();
        $userModel = new User_Model();

        if(session()->get('isLoggedInUser'))
        {
            $data['newest'] = $postModel->getNewestPosts();

            if($data){
                echo view("templates/header", $data);
                echo view("dashboard");
                echo view("templates/footer");
            }
            else
            {
                $data = [];
                echo view("templates/header", $data);
                echo view("dashboard");
                echo view("templates/footer");
            }
        }
        elseif(session()->get('isLoggedInAdmin'))
        {
            $data['newest'] = $postModel->getNewestPosts();
            $postsNum = [
                'postNo' => $postModel->countPosts()
            ];

            $userNum = [
                'userNo' => $userModel->countUsers()
            ];

            if($data){
                echo view("templates/header", $data + $postsNum + $userNum);
                echo view("dashboard");
                echo view("templates/footer");
            }
            else
            {
                $data = [];
                echo view("templates/header", $data + $postsNum + $userNum);
                echo view("dashboard");
                echo view("templates/footer");
            }
        }
	}

    public function displayPosts()
    {
        $model = new Posts_Model();

        $data = [
            'news' => $model->orderBy('publishedAT', 'DESC')
                            ->paginate(10),
            'pager' => $model->pager
        ];

        echo view("templates/header", $data);
		echo view("forum/postsPage");
		echo view("templates/footer");
    }

    public function viewPost($postID)
    {
        $data = [];

        helper(['form']);

        $postModel = new Posts_Model();
        $model = new Comments_Model();

        if($this->request->getMethod() == 'post') 
        {
            $rules = [
                'comment' => 'required|min_length[5]|max_length[255]'
            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else
            {
                if(session()->get('isLoggedInUser'))
                {
                    $commentModel = new Comments_Model();
                    $userID = session()->get('idUser');
                    $userName = session()->get('firstName').' '.session()->get('lastName');

                    $urlsplit = explode('/',current_url());
                    $postID = $urlsplit[count($urlsplit)-1];

                    $commentModel->save(
                    [
                            'postID' => $postID,
                            'userID' => $userID,
                            'content' => $this->request->getVar('comment'),
                            'authorName' => $userName
                    ]);
                    $session = session();
                    $session->setFlashData('commented', 'Comment has been created !');
                    return redirect()->to('/forum/'.$postID);
                }
                elseif(session()->get('isLoggedInAdmin'))
                {
                    $commentModel = new Comments_Model();
                    $adminID = session()->get('idAdmin');
                    $userName = session()->get('firstName').' '.session()->get('lastName');

                    $urlsplit = explode('/',current_url());
                    $postID = $urlsplit[count($urlsplit)-1];

                    $commentModel->save(
                    [
                            'postID' => $postID,
                            'adminID' => $adminID,
                            'content' => $this->request->getVar('comment'),
                            'authorName' => $userName
                    ]);
                    $session = session();
                    $session->setFlashData('commented', 'Comment has been created !');
                    return redirect()->to('/forum/'.$postID);
                }  
            }
        }

        $postData['post'] = $postModel->getPosts($postID);
        $comments['comment'] = $model->getComments($postID);
        if($comments){
            echo view("templates/header", $postData + $comments);
            echo view("forum/posts");
            echo view("templates/footer");
        }
        else{

            $comments['comment'] = [];
            echo view("templates/header", $postData + $comments);
            echo view("forum/posts");
            echo view("templates/footer");
        }
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
                    $userName = session()->get('firstName').' '.session()->get('lastName');

                    $model->save(
                    [
                        'userID' => $userID,
                        'title' => $this->request->getVar('title'),
                        'content' =>$this->request->getVar('content'),
                        'authorName' => $userName
                    ]);

                    $session = session();
                    $session->setFlashData('posted', 'Post has been posted !');
                    return redirect()->to('/forum/postsPage');
                }
                elseif(session()->get('isLoggedInAdmin'))
                {
                    $adminID = session()->get('idAdmin');
                    $adminName = session()->get('firstName').' '.session()->get('lastName');

                    $model->save(
                    [
                        'adminID' => $adminID,
                        'title' => $this->request->getVar('title'),
                        'content' =>$this->request->getVar('content'),
                        'authorName' => $adminName
                    ]);

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
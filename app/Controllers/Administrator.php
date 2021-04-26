<?php namespace App\Controllers;

use App\Models\Administrator_Model;
use App\Models\Comments_Model;
use App\Models\Moderator_Model;
use App\Models\User_Model;
use App\Models\Posts_Model;
use App\Models\Reported_Posts;

class Administrator extends BaseController
{
    public function viewUsers()
    {
        $users = new User_Model();

        $dataUsers['users'] = $users->getUsers();

        //This takes the User Id inputted in the search bar
        //getVar function returns a single variable of from the specified field
        $keyword = $this->request->getVar('searchID');

        //If no User Id was inputted then set the $result to nothing
        if($keyword == null)
        {
            $result['results'] = [];
            
            echo view('templates/header', $dataUsers + $result);
            echo view('admin_functions_page');
            echo view('templates/footer');
        }
        //If there was a User Id search for the User in the database and
        //return the User object 
        else {
            $result['results'] = $users->searchUser($keyword);

            echo view('templates/header', $dataUsers + $result);
            echo view('admin_functions_page');
            echo view('templates/footer');
        }
    }

    public function displayReportedPosts()
    {
        $model = new Reported_Posts();

        $data['news'] = $model->getPosts();

        echo view("templates/header", $data);
		echo view("forum/reported_posts");
		echo view("templates/footer");

    }

    public function delUser()
    {
        $user = new User_Model();

        $urlsplit = explode('/', current_url());
        $userID = $urlsplit[count($urlsplit) - 1];

        $user->deleteUser($userID);
        $session = session();
		$session->setFlashdata('deletedUser', 'User has been deleted');

        return redirect()->back();
    }

    public function delPost()
    {
        $posts = new Posts_Model();

        $urlsplit = explode('/', current_url());
        $postID = $urlsplit[count($urlsplit) - 1];

        $posts->deletePost($postID);
        $session = session();
		$session->setFlashdata('deletedPost', 'Post has been deleted.');
        return redirect()->back();
    }

    public function deleteComment()
    {
        $posts = new Comments_Model();

        $urlsplit = explode('/', current_url());
        $commentID = $urlsplit[count($urlsplit) - 1];

        $posts->deleteComment($commentID);
        $session = session();
		$session->setFlashdata('deletedComment', 'Comment has been deleted.');
        return redirect()->back();
    }

    public function leavePost()
    {
        $reportedPost = new Reported_Posts();

        $urlsplit = explode('/', current_url());
        $postID = $urlsplit[count($urlsplit) - 1];

        $reportedPost->deleteReportedPost($postID);
        $session = session();
		$session->setFlashdata('reportDeleted', 'Report has been deleted.');
        return redirect()->back();
    }
}
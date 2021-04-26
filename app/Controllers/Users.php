<?php namespace App\Controllers;

use App\Models\Posts_Model;
use App\Models\Reported_Posts;
use App\Models\User_Model;

class Users extends BaseController
{
    public function profile()
    {
        $data = [];
        helper(['form']);
        $userModel = new User_Model();
        $postModel = new Posts_Model();

        if ($this->request->getMethod() == 'post') 
		{
			$rules = [
				'oldPassword' => 'required|min_length[3]|max_length[20]',
				'newPassword' => 'required|min_length[3]|max_length[20]',
			];
			
			if(! $this->validate($rules))
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				if ($userModel->checkPassword(session()->get('email'), $_POST['oldPassword']))
				{

					$userModel->updatePassword(session()->get('idUser'), $_POST['newPassword']);

					session()->setFlashdata('success', 'Password is updated');
					return redirect()->to('/profile');

				}else{
					$session = session();
					//If logging in was unsucessful then flashdata is set to show
					//that the login was unsucessful
					$session->setFlashdata('failed', 'Password didn\'t match');
					return redirect()->to('/profile');
				}
			}
			
		}
		

        $userDetails['user'] = $userModel->where('idUser', session()->get('idUser'))
                                ->first();
        
        $userPosts['userPosts'] = $postModel->getUserPosts(session()->get('idUser'));

        echo view('templates/header', $userDetails + $userPosts);
        echo view('profile');
        echo view('templates/footer');
    }

	public function reportPost()
	{
		$posts = new Posts_Model();
		$reportedPosts = new Reported_Posts();

        $urlsplit = explode('/', current_url());
        $postID = $urlsplit[count($urlsplit) - 1];

		$post = $posts->getPosts($postID);

        $reportedPosts->save($post);
        $session = session();
		$session->setFlashdata('postReported', 'Post has been Reported');
        return redirect()->back();
	}

	public function deleteOwnPost()
	{
		$posts = new Posts_Model();

        $urlsplit = explode('/', current_url());
        $postID = $urlsplit[count($urlsplit) - 1];

        $posts->deletePost($postID);
        $session = session();
		$session->setFlashdata('deletedOwnPost', 'Your post has been deleted !');
        return redirect()->back();
	}
}
<?php namespace App\Controllers;

use App\Models\Posts_Model;
use App\Models\User_Model;

class Users extends BaseController
{
    public function profile()
    {
        $data = [];
        helper(['form']);
        $userModel = new User_Model();
        $postModel = new Posts_Model();
        $userID = session()->get('idUser');

        if ($this->request->getMethod() == 'post') {
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				];

			if($this->request->getPost('password') != ''){
				$rules['passwordHash'] = 'required|min_length[8]|max_length[255]';
				$rules['passwordHash_confirm'] = 'matches[passwordHash]';
			}


			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

				$newData = [
					'idUser' => session()->get('idUser'),
					'firstName' => $this->request->getPost('firstName'),
					'lastName' => $this->request->getPost('lastName'),
					];
					if($this->request->getPost('password') != ''){
						$newData['passwordHash'] = $this->request->getPost('passwordHash');
					}
				$userModel->save($newData);

				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');

			}
		}

        $userDetails['user'] = $userModel->where('idUser', session()
                                ->get('idUser'))
                                ->first();
        
        $userPosts['userPosts'] = $postModel->getUserPosts($userID);

        echo view('templates/header', $userDetails + $userPosts);
        echo view('profile');
        echo view('templates/footer');
    }
}
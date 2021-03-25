<?php namespace App\Models;

use CodeIgniter\Model;

class User_Model extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['firstName', 'lastName', 'email', 'passwordHash'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->hashingPassword($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->hashingPassword($data);
        return $data;
    }

    protected function hashingPassword(array $data)
    {
        if(isset($data['data']['passwordHash']))
        {
            $data['data']['passwordHash'] = password_hash($data['data']['passwordHash'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function userCheck($email)
    {
        $builder = $this->builder();
        $query = $builder->getWhere(['email' => $email])->getFirstRow();

        if($query)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkPassword($email, $passwordHash)
    {
        $userModel = new User_Model();

        $user = $userModel->where('email', $email)
                    ->first();

        if($user)
            return password_verify($passwordHash, $user['passwordHash']);
        else
            return false;
    }

    public function getUsers() {
        return $this->findAll();
    }

    function search($keyword)
    {
        $builder = $this->builder();
        $query = $builder->getWhere(['idUser' => $keyword])->getFirstRow();
        
        if($query){
            return $query;
        }   
        else
            return null;
    }
}
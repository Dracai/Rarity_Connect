<?php namespace App\Models;

use CodeIgniter\Model;

class Moderator_Model extends Model
{
    protected $table = 'moderator';
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

    public function modCheck($email)
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
        $modModel = new Moderator_Model();

        $mod = $modModel->where('email', $email)
                    ->first();

        if($mod)
            return password_verify($passwordHash, $mod['passwordHash']);
        else
            return false;
    }
}
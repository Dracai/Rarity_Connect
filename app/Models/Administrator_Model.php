<?php namespace App\Models;

use CodeIgniter\Model;

class Administrator_Model extends Model
{
    protected $table = 'administrator';
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

    public function adminCheck($email)
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
}
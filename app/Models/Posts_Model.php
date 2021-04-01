<?php namespace App\Models;

use CodeIgniter\Model;

class Posts_Model extends Model
{
    protected $table = 'post';
    protected $allowedFields = ['postID','userID', 'modID', 'adminID', 'title', 'content'];

    public function getPosts($postID = null)
    {
        if(!$postID)
        {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['postID' => $postID])
                    ->first();
    }
}
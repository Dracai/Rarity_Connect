<?php namespace App\Models;

use CodeIgniter\Model;

class Posts_Model extends Model
{
    protected $table = 'post';
    protected $allowedFields = ['postID','userID', 'modID', 'adminID', 'title', 'content', 'publishedAT', 'authorName'];

    public function getPosts($postID = null)
    {
        if(!$postID)
        {
            return $this->orderBy('publishedAT', 'DESC')->findAll();          
        }

        return $this->asArray()
                    ->where(['postID' => $postID])
                    ->first();
    }

    public function getNewestPosts()
    {
        return $this->orderBy('publishedAT', 'DESC')
                    ->findAll(5);
    }

    public function getUserPosts($userID)
    {
        return $this->asArray()
                    ->where(['userID' => $userID])
                    ->findAll();
    }

    function deletePost($postID)
    {
        $this->db->table('post')->where('postID', $postID)->delete();
        return;
    }
}
<?php namespace App\Models;

use CodeIgniter\Model;

class Comments_Model extends Model
{
    protected $table = 'postcomment';
    protected $allowedFields = ['commentID' ,'postID', 'userID', 'modID', 'adminID', 'title', 'content', 'publishedAT', 'authorName'];

    public function getComments($postID)
    {
        return $this->orderBy('publishedAT', 'DESC')
                    ->where(['postID' => $postID])
                    ->findAll();
    }

    function deleteComment($commentID)
    {
        $this->db->table('postcomment')->where('commentID', $commentID)->delete();
        return;
    }
}
<?php namespace App\Models;

use CodeIgniter\Model;

class Reported_Posts extends Model
{
    protected $table = 'reportedposts';
    protected $allowedFields = ['reportedID', 'postID','userID', 'modID', 'adminID', 'title', 'content', 'published_at', 'authorName'];

    public function getPosts($postID = null)
    {
        if(!$postID)
        {
            return $this->orderBy('published_at', 'DESC')->findAll();          
        }

        return $this->asArray()
                    ->where(['postID' => $postID])
                    ->first();
    }

    function deleteReportedPost($postID)
    {
        $this->db->table('reportedposts')->where('postID', $postID)->delete();
        return;
    }
}
<?php namespace App\Controllers;

use App\Models\Moderator_Model;
use App\Models\Posts_Model;

class Moderators extends BaseController
{
    public function deleteP()
    {
        $posts = new Posts_Model();

        $urlsplit = explode('/', current_url());
        $postID = $urlsplit[count($urlsplit) - 1];

        $posts->deletePost($postID);
        return redirect()->back();
    }
}
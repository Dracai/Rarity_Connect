<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class AllAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if user not logged in
        if(!session()->get('isLoggedInAdmin') && !session()->get('isLoggedInUser')){
                return redirect()->to('/login');
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
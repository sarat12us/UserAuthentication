<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;

class AuthenticationController extends Controller {

    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /** ************************ APIs ***************************** */

    /**
     * postLogin method
     * this function is used to signin of a existing user.
     * 
     * @return json
     */
    public function postLogin() {

        $userData = array();
        $userObj = new \App\User();
        $success = 'no';
        $status = parent::HTTP_CODE_BAD_REQUEST;
        
         if ($this->request->get('username') != '' && $this->request->get('password') != '') 
        {
            $userDetail = \App\User::where("username", $this->request->get('username'))->where('password', '=', $this->request->get('password'))->first();
            
            // Check if record exists
            if (count($userDetail) > 0) {
                $success = 'yes';
                $status = parent::HTTP_CODE_SUCCESS;
                $message = 'User logged in';
            
            } 
            else {

                $success = 'no';
                $status = parent::HTTP_CODE_AUTH_FAIL;
                $message = 'The entered username or password is incorrect. Please check and try again';
            }

        } else {
            switch ($this) {
                case empty($this->request->get('username')):
                    $message = 'username cannot be blank';
                    break;
                
                case empty($this->request->get('password')):
                    $message = 'Password cannot be blank';
                    break;
            }
        }
            
        return response()->json(['data' => $userData, 'message' => $message, 'success' => $success], $status);
    }
    

    /**
     * postRegister method
     * this function is used to signup for new user..
     * 
     * @return json
     */
    public function postRegister() {

        $userData = array();
        $userObj = new \App\User();
        $success = 'no';
        $status = parent::HTTP_CODE_BAD_REQUEST;
        
         // if user will try to signup with username and password..
        if ($this->request->get('username') != '' &&
            $this->request->get('name') != '' &&
            $this->request->get('password') != '') {
            $userDetail = \App\User::where('username', $this->request->get('username'))->first();
            // Check if record exists
            if (count($userDetail) == 0) {
                $userArray = array(
                    'name' => $this->request->get('name'),
                    'username' => $this->request->get('username'),
                    'password' => $this->request->get('password'),
                );
                $userObj = \App\User::create($userArray);
                if (isset($userObj->id)) {
                    $success = 'yes';
                    $status = parent::HTTP_CODE_SUCCESS;
                    $message = 'User registered successfully';
                } else {
                    $success = 'no';
                    $status = parent::HTTP_CODE_SERVER_ERROR;
                    $message = 'There was a problem in processing your request';
                }
            } else {

                $success = 'no';
                $status = parent::HTTP_CODE_SERVER_ERROR;
                $message = 'Account already exists. Please check and try again';
            }

        } else {

            switch ($this) {
                case empty($this->request->get('name')):
                    $message = 'name cannot be blank';
                    break;
                case empty($this->request->get('username')):
                    $message = 'Username cannot be blank';
                    break;
                case empty($this->request->get('password')):
                    $message = 'Password cannot be blank';
                    break;
            }
        }

        return response()->json(['data' => $userData, 'message' => $message, 'success' => $success], $status);
    }

}

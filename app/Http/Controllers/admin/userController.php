<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;

class userController extends Controller
{
    //
    public function show(){
        $users = $this->getUsersData();
        $array = array('users' => $users);
        return view('admin.users.all',$array);
    }

    // Get users Data
    private function getUsersData(){
        $users = DB::table('users')->orderBy('id', 'DESC')->get();
        return $users;
    }

    // block user
    public function blockUser($id){
        $user = DB::table('users')->where('id',$id)->update(['state' => 0]);
        return $this->show();
    }

    // unblock user
    public function unBlockUser($id){
        $user = DB::table('users')->where('id',$id)->update(['state' => 1]);
        return $this->show();
    }

    // delete user
    public function deleteUser($id){
        $user = DB::table('users')->where('id',$id)->delete($id);
        return $this->show();
    }

    // get user edit page
    public function getUsereditPage($id){
        $user = DB::table('users')->where('id',$id)->first();
        $user->image =  $this->getMediaFile($user->avatar);
        unset($user->password);
        $array = array('user' => $user);
        return view('admin.users.edit',$array);
    }

    // edit uder
    public function editUser(Request $request){
        $id = $request->id;
        if(isset($request->role)){
            if($request->role == 0){
                dd($request);
            }else {
                $this->editUserRole($id,$request->role);
            }
        }
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'adress' => $request->adress,
            'zip' => $request->zip,
            'age' => $request->age,
            'avatar' => $request->avatar,
        ];
        $user = DB::table('users')->where('id',$id)->update($data);
        return $this->getUsereditPage($id);
    }

    // edit user role
    private function editUserRole($id,$role){
        DB::table('users')->where('id',$id)->update(['role' => $role]);
    }

    // edit user password
    public function editUserPassword(Request $request){
        $id = $request->id;
        if($request->password === $request->passowrd_conf){
            $oldPassword = (DB::table('users')->where('id',$id)->first())->password;
            if (password_verify($request->old_password, $oldPassword)) {
                $newPassword = password_hash($request->password, PASSWORD_DEFAULT);
                DB::table('users')->where('id',$id)->update(['password'=>$newPassword,'updated_at'=> now()]);
                return $this->getUsereditPage($id);
            } else {
                $user = DB::table('users')->where('id',$id)->first();
                $user->image =  $this->getMediaFile($user->avatar);
                unset($user->password);
                $array = array('user' => $user,'passwordError' => 'Votre ancien mot de passe est incorrect');
                return view('admin.users.edit',$array);
            }
        }else{
            $user = DB::table('users')->where('id',$id)->first();
            $user->image =  $this->getMediaFile($user->avatar);
            unset($user->password);
            $array = array('user' => $user,'passwordError' => 'Le mot de passe ne correspond pas');
            return view('admin.users.edit',$array);
        }
    }

    //Get newUser page
    public function getNewUserPage(){
        return view('admin.users.add-new');
    }

    // add New user
    public function addNewUser(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'username' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'gender' => 'required',
                'adress' => 'required',
                'zip' => 'required',
                'age' => 'required',
                'role' => 'required',
                'avatar' => 'required',
                'password' => 'required',
                'password_conf' => 'required',
            ],
            [
                'username.required' => 'Le champ du nom d\'utilisateur est obligatoire.',
                'first_name.required' => 'Le champ du prénom est obligatoire.',
                'last_name.required' => 'Le champ du nom de famille est obligatoire.',
                'email.required' => 'Le champ email est obligatoire.',
                'gender.required' => 'Le champ genre est obligatoire.',
                'adress.required' => 'Le champ d\'adresse est obligatoire.',
                'zip.required' => 'Le champ du code postal est obligatoire.',
                'age.required' => 'Le champ d\'âge est obligatoire.',
                'role.required' => 'Le champ de rôle est obligatoire.',
                'avatar.required' => 'Veuillez choisir un avatar',
                'password.required' => 'Le champ du mot de passe est obligatoire.',
                'password_conf.required' => 'Veuillez confirmer votre mot de passe',
            ]);
            if($request->password === $request->password_conf){
                $password = password_hash($request->password, PASSWORD_DEFAULT);
            }else {
                $array = array('error' => 'Le mot de passe ne correspond pas');
                return view('admin.users.add-new',$array);
            }
            $data = [
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'adress' =>$request->adress,
                'zip' => $request->zip,
                'age' => $request->age,
                'role' => $request->role,
                'avatar' => $request->avatar,
                'password' => $password,
                'state' => 1,
                'created_at' => now()
            ];
            $user = DB::table('users')->insert([$data]);
            $array = array('success' => 'Utilisateur ajouté avec succès');
            return view('admin.users.add-new',$array);
        }
    }

    // user login
    public function userlogin(Request $request){
        $username = $request->username;
        $password = $request->password;
        $user = (DB::table('users')->where('username',$username)->first());
        if (!is_null($user) && password_verify($password, $user->password)) {
            $request->session()->put('user_id',$user->id);

            redirect('/admin')->send();
        } else {
           redirect('/login?error=0')->send();
        }

    }

    // logOut user
    public function logOut(Request $request){
        $request->session()->forget('user_id');
        if(!$request->session()->has('user_id'))
        {
            return redirect('/login')->send();
        }
    }
    // get Media file
    private function getMediaFile($id){
        $thumbnail = DB::table('medias')->where('id',$id)->first();
        return $thumbnail;
    }

    // get auth page
    public function getAuthPage(){
        return view('admin.auth.login');
    }
}

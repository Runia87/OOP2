<?php
class User{
    private $db,$data,$session_name,$isLoggedIn,$cookieName;
    public function __construct($user=null){
$this->db=Database::getInstance();
$this->cookieName = Config::get('cookie.cookie_name');
$this->session_name=Config::get('session.user_session');
if(!$user){
    if(Session::exists($this->session_name)){
        $user=Session::get($this->session_name);
        if($this->find($user)){
            $this->isLoggedIn=true;
        }}}
        else{
            $this->find($user);
        }
    }  

    
    public function create($fields=[]){
        $this->db->insert('users',$fields);
    }


    public function exists(){
        return (!empty($this->data()[0]))?true:false;
    }

public function login($email=null,$password=null,$remember=false){
   // $user=$this->find($email);
if(!$email&&!$password&&$this->exists()){
//if(!$email&&!$password){
    //var_dump($this->session_name);
      //var_dump($this->data());
        //var_dump("URAAA");
   // var_dump($_SESSION['user']);
   Session::put($this->session_name,$this->data()[0]->id);
}else{
   // $user=$this->find($email);
   //$user=$this->db->get('users',['email','=',$email])->first();
  
   $user=$this->find($email);
  // $this->cookieName = Config::get('cookie.cookie_name');
   if($user){
    if(password_verify($password,$this->data()[0]->password)){
        
        Session::put(Config::get('session.user_session'),$this->data()[0]->id);
        //var_dump($this->session_name);
        //var_dump("ID=".$this->data()[0]->id);
        //var_dump("URAAA");
        if($remember){
            $hash=hash('sha256',uniqid());
            $hashCheck=$this->db->get('user_cookies',['user_id','=',$this->data()[0]->id]);
            if(!$hashCheck->count()){
                $this->db->insert('user_cookies',['user_id'=>$this->data()[0]->id,'hash'=>$hash]);
            }
            else{
                $hash=$hashCheck->first()[0]->hash;
            }
            //Cookie::put($this->cookieName,$hash,Config::get('cookie.cookie_expiry'));
            Cookie::put($this->cookieName,$hash,Config::get('cookie.cookie_expiry'));
        }
        return true;
    }
}
}
return false;
} 

public function find($value=null){
    if(is_numeric($value)){
        $this->data=$this->db->get('users',['id','=',$value])->first();
    }
    else{
        $this->data=$this->db->get('users',['email','=',$value])->first();  
    }
   
    if($this->data){
    return true;
}
}

public function data(){
    return $this->data;
}

public function isLoggedIn(){
    return $this->isLoggedIn;
}

public function logout(){
    $this->db->delete('user_cookies',['user_id','=',$this->data()[0]->id]);
    Cookie::delete($this->cookieName);
    return Session::delete($this->session_name);
}

public function hasPermissions($key=null){
    $group=$this->db->get('user_groups',['id','=',$this->data()[0]->group_id]);
    if($group->count()){
        $permissions=$group->first()[0]->permissions;
        $permissions=json_decode($permissions,true);
        if($permissions!=null && $permissions[$key]){
            return true;
        }
    }
return false;
}

public function update($fields=[], $id=null){
if(!$id&&$this->isLoggedIn()){
    $id=$this->data()[0]->id;
}
$this->db->update('users',$id,$fields);

}

}

?>
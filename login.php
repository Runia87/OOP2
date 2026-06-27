<?php
require_once 'init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))){
    $validate = new Validate();
    $validate->check($_POST,['email'=>['required'=>true,'email'=>true],
    'password'=>['required'=>true]]);
    //'my_file'=>['file'=>true]
    if($validate->passed()){

        //echo 'OK';
      $user = new User;
      $remember=(Input::get('remember'))==='on'?true:false;
      $login=$user->login(Input::get('email'), Input::get('password'),$remember);



      //var_dump(Input::get('password'));
      if($login){
        Redirect::to('index.php');
    }
        else{
            echo 'Login failed';
        }
      
       // header('Location:/test.php');
 
    }else{
        foreach($validate->errors() as $error){
            echo $error. "<br>";
        
    }
    }
}}



?>

<form action="" method="POST">
     <!--?php echo Session::flash('success');?-->

<div class="field">
<label for="">
Email
</label>
<input type="text" name ="email" value="<?php echo Input::get('email') ?>">
</div>

<div class="field">
<label for="">
Password
</label>
<input type="text" name ="password">
</div>

<input type="hidden" name ="token" value="<?php echo Token::generate();?>">
<!-- <input type="hidden" name ="token" value="<!-?php echo Token::generate();?>"> -->
<!-- <input type="file" name ="my_file"> -->

<div class="field">
<label for="remember">
Remember me
</label>
<input type="checkbox" name ="remember" id="remember">
</div>

<div class="field">
<button type="submit">Submit</button>
</div>
</form>
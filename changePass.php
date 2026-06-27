<?php

require_once 'init.php';
$user= new User();
$validate=new Validate();

if(Input::exists()){
    If(Token::check(Input::get('token'))){
        if(password_verify(Input::get('current_password'),$user->data()[0]->password)){
        $validate->check($_POST,[
            'new_password'=>['required'=>true,'min'=>4],
            'new_password_again'=>['required'=>true,'min'=>4, 'matches'=>'new_password']]);
        If($validate->passed()){
//if(password_verify(Input::get('current_password'),$user->data()[0]->password)){
    $user->update(['password'=>password_hash(Input::get('new_password'),PASSWORD_DEFAULT)]);
    Session::flash('success','Password has been updated!'. "<br>");
    Redirect::to('index.php');
        }}
        else{
            echo 'Invalid current password';
        }
        }
    }

?>


<form action="" method="post">
<div class="field">
<label for="current_password">
Current Password
</label>
<input type="text" name ="current_password" id ="current_password">
</div>

<div class="field">
<label for="new_password">
New Password
</label>
<input type="text" name ="new_password" id ="new_password">
</div>


<div class="field">
<label for="new_password_again">
New Password again
</label>
<input type="text" name ="new_password_again" id ="new_password_again">
</div>


<div class="field">
<button type="submit">Submit</button>
</div>
<input type="hidden" name ="token" value="<?php echo Token::generate();?>">
</form>
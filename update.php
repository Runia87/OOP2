<?php
require_once 'init.php';
$user= new User();
$validate=new Validate();

if(Input::exists()){
    If(Token::check(Input::get('token'))){
        $validate->check($_POST,['username'=>['required'=>true,'min'=>2]]);
        If($validate->passed()){
            $user->update(['username'=>Input::get('username')]);
            Session::flash('success','Username has been updated!'. "<br>");
            Redirect::to('index.php');
        }else{
            foreach($validate->errors() as $error)
            echo $error.'<br>';
        }
        }
    }
   // var_dump($_POST['token']);
?>
<form action="" method="post">
<div class="field">
<label for="username">
Username
</label>
<input type="text" name ="username" id ="username" value="<?php echo $user->data()[0]->username;?>">
</div>
<div class="field">
<button type="submit">Submit</button>
</div>
<input type="hidden" name ="token" value="<?php echo Token::generate();?>">
</form>
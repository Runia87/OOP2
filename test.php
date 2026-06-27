<?php
require_once 'init.php';
$user= new User();
$validate=new Validate();
$validate->check($_POST,['username'=>['required'=>true,'min'=>2]]);
if(Input::exists()){
    If(Token::check(Input::get('token'))){
        If($validate->passed()){
            $user->update(['username'=>Input::get('username')]);
            Redirect::to('update.php');
        }else{
            foreach($validate->errors() as $error)
            echo $error.'<br>';
        }
        }
    }
    var_dump($_POST['token']);
?>
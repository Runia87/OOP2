<?php

require_once 'init.php';

//var_dump(Session::get('user'));
//var_dump(Session::get(Config::get('session.user_session')));
echo Session::flash('success');
$user = new User;
//$anotherUser=new User(7);
//echo $user->data()->username;
//echo $anotherUser->data()->username;
if($user->isLoggedIn()){
    echo "Hi, <a href='#'>{$user->data()[0]->username}</a>";
    echo "<p><a href ='logout.php'>Logout</a></p>";
    echo "<p><a href ='update.php'>Update profile</a></p>";
    echo "<p><a href ='changePass.php'>Change password</a></p>";
    if($user->hasPermissions('admin')){
        echo "You are admin!";
    }
}else{
    echo "<a href='login.php'>Login</a> or <a href = 'register.php'>Register</a>";
}
?>
<!-- // session_start();

// require_once 'Database.php';
// require_once 'Config.php';
// require_once 'Validate.php';
// require_once 'Input.php';
// require_once 'Token.php';
// require_once 'Session.php';
// require_once 'User.php';
// require_once 'Redirect.php';
// $GLOBALS['config']=['mysql'=>['host'=>'MySQL-8.0','username'=>'root','password'=>'','dbname'=>'OOP'],'session'=>['token_name'=>'token']];

//$users=Database::getInstance()->query('SELECT * FROM users');
//var_dump($users->results());
//$users=Database::getInstance()->query('SELECT * FROM users WHERE username IN (?,?)',['Ainur','Nukos']);

//$users=Database::getInstance()->get('users',['username','=','Nukos']);
//Database::getInstance()->delete('users',['username','=','Ainur']);

// foreach ($users as $user) {
//     echo $user->name;
// }
////////////
// $users=Database::getInstance()->query('SELECT * FROM users');

// var_dump($users->count()); die;

// if($users->error()){
//     echo 'we have an error';
// }
// else{
//     foreach ($users->results() as $user) {
//         echo $user->username . '<br>';
//     }
 
// }


// Database::getInstance()->insert('users',
// ['username'=>'Ainur', 'password'=>'secret']
// );

// $id=5;
// Database::getInstance()->update('users',$id,
// ['username'=>'Ainur5', 'password'=>'secret5']
// );

//echo $users->results()[0]->username;
//echo $users->first()->username;

//Redirect::to('test.php');
// Redirect::to(404);

// if(Input::exists()){
//     if(Token::check(Input::get('token'))){
//     $validate = new Validate();
//     $validation=$validate->check($_POST,['username'=>['required'=>true,'min'=>2,
//     'max'=>15,'unique'=>'users'],
//     'password'=>['required'=>true,'min'=>3],'password_again'=>['reuired'=>true,
//     'matches'=>'password']]);
//     //'my_file'=>['file'=>true]
//     if($validation->passed()){
//         $user=new User;
//         $user->create(['username'=>Input::get('username'),'password'=>password_hash(Input::get('password'),PASSWORD_DEFAULT)]);
//         Session::flash('success','register success');
//        // header('Location:/test.php');
 
//     }else{
//         foreach($validation->errors() as $error){
//             echo $error. "<br>";
        
//     }
//     }
// }} -->



<!-- // <form action="" method="POST">
//     <!-?php echo Session::flash('success');?>
// <div class="field">
// <label for="">
// Username
// </label>
// <input type="text" name ="username" value="<!-?php echo Input::get('username') ?>">
// </div>

// <div class="field">
// <label for="">
// Password
// </label>
// <input type="text" name ="password">
// </div>

// <div class="field">
// <label for="">
// Password Again
// </label>
// <input type="text" name ="password_again">
// </div>
// <input type="hidden" name ="token" value="
<!-?php echo Token::generate();?>">
// <!- <input type="file" name ="my_file"> -->

<!--div class="field">
// <button type="submit">Submit</button>
// </!--div>
// </form> -->
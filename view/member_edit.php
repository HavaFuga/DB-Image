<?php
/**
 * Member Edit Profile
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 25.04.2018
 * Time: 21:24
 */

$servername = "localhost";
$username = "root";
$password = "gibbiX12345";
$dbname = "imagedb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}


/*$memberRepository = new MemberRepository();
$memberRepository->doEdit();

$uid = "<input type='hidden' name='kid' value='{$user->uid}' />\n";
    $email = $user->email;
    $name = $user->name;
    $password = $user->password;
    $action = "doEdit";

$uid = "";
$email = "";
$name = "";
$password = "";
$action = "doCreate";*/




//Form
$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/login/doEdit");
$button = new ButtonBuilder();
echo $form->input()->label('Nickname')->name('name')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('Password')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('Password again')->name('password2')->type('password')->lblClass($lblClass)->eltClass($eltClass);
echo '<input type="checkbox" name="admin" value="admin"> Admin<br>';
echo $button->start($lblClass, $eltClass);
echo $button->label('Register')->name('send')->type('submit')->class('btn-success');
echo $button->end();
echo $form->end();
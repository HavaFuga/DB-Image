<?php
  /**
   * Registratons-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
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
/*if (!empty($user)) {
    $uid = "<input type='hidden' name='kid' value='{$user->uid}' />\n";
    $email = $user->email;
    $name = $user->name;
    $password = $user->password;
    $action = "doEdit";
} else {*/
    $uid = "";
    $email = "";
    $name = "";
    $password = "";
    $action = "doCreate";


//Message/Alert
if (isset($_SESSION['error-reg'])){
    echo '<div class="alert alert-danger">'.$_SESSION['error-reg'].'</div>';
}elseif (isset($_SESSION['valid'])){
    echo '<div class="alert alert-success">'.$_SESSION['valid'].'</div>';
}

//Form
$lblClass = "col-md-2";
$eltClass = "col-md-4";
$btnClass = "btn btn-success";
$form = new Form($GLOBALS['appurl']."/login/$action");
$button = new ButtonBuilder();
echo $form->input()->label('Nickname')->name('name')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('Password')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
echo $form->input()->label('Password again')->name('password2')->type('password')->lblClass($lblClass)->eltClass($eltClass);
echo $button->start($lblClass, $eltClass);
echo $button->label('Register')->name('send')->type('submit')->class('btn-success');
echo $button->end();

echo $form->end();


?>

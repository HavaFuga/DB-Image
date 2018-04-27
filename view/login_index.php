<?php
  /**
   * Login-Formular
   * Das Formular wird mithilfe des Formulargenerators erstellt.
   */
//Connetction to DB
$servername = "localhost";
$username = "root";
$password = "gibbiX12345";
$dbname = "imagedb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, name, email, password FROM user");
    $stmt->execute();

    // set the resulting array to associative
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;

//Prüft, meldet den Benutzer an
        $email = "";
        $password = "";
        $action = "doLogin";

//Message/Alert
if (isset($_SESSION['error-log'])){
    echo '<div class="alert alert-danger">'.$_SESSION['error-log'].'</div>';
}elseif (isset($_SESSION['valid-reg'])){
    echo '<div class="alert alert-success">'.$_SESSION['valid-reg'].'</div>';
}

//Form
  $lblClass = "col-md-2";
  $eltClass = "col-md-4";
  $btnClass = "btn btn-success";
  $form = new Form($GLOBALS['appurl']."/login/$action");
  $button = new ButtonBuilder();
  echo $form->input()->label('E-Mail')->name('email')->type('text')->lblClass($lblClass)->eltClass($eltClass);
  echo $form->input()->label('Passwort')->name('password')->type('password')->lblClass($lblClass)->eltClass($eltClass);
  echo $button->start($lblClass, $eltClass);
  echo $button->label('Login')->name('send')->type('submit')->class('btn-success');
  echo $button->end();
  echo $form->end();
?>



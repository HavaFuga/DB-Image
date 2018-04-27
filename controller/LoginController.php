<?php
require_once '../repository/LoginRepository.php';
/**
 * Controller für das Login und die Registration, siehe Dokumentation im DefaultController.
 */
  class LoginController
  {
    /**
     * Default-Seite für das Login: Zeigt das Login-Formular an
	 * Dispatcher: /login
     */
    public function index()
    {
      $loginRepository = new LoginRepository();
      $view = new View('login_index');
      $view->title = 'Image-DB';
      $view->heading = 'Login';
      $view->display();
    }
    /**
     * Zeigt das Registrations-Formular an
	 * Dispatcher: /login/registration
     */
    public function registration()
    {
      $view = new View('login_registration');
      $view->title = 'Image-DB';
      $view->heading = 'Registration';
      $view->display();
    }
      /**
       * Speichert einen neuen Kontakt in die DB und ruft die Indexseite auf
       */
      public function doCreate()
      {
          if ($_POST['send']) {
              session_unset();
              session_destroy();
              session_start();
              $name = $_POST['name'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $password2 = $_POST['password2'];
              $loginRepository = new LoginRepository();

              if ($password != $password2 || $email == ''){
                  $_SESSION['error-reg'] = 'Invalid Input. Try again';
                  header('Location: ' . $GLOBALS['appurl'] . '/login/registration');
              }elseif ($loginRepository->getEmail($email)){
                  $_SESSION['error-reg'] = 'Sorry, E-Mail already exists.';
                  header('Location: ' . $GLOBALS['appurl'] . '/login/registration');
              }
              else {
                  $loginRepository = new LoginRepository();
                  $loginRepository->create($name, $email, $password);
                  $_SESSION['valid-reg']='Registration successfully';
                  header('Location: ' . $GLOBALS['appurl'] . '/login');
              }
          }
      }

      public function doLogin(){
          if ($_POST['send']) {
              session_unset();
              $email = $_POST['email'];
              $password = $_POST['password'];
              $loginRepository = new LoginRepository();
              if (!$loginRepository->login($email, $password)){
                  session_start();
                  $_SESSION['error-log']='Invalid Input Login';
                  header('Location: ' . $GLOBALS['appurl'] . '/login');
              }else{
                  $userId = $loginRepository->getUid($email, $password);
                  session_start();
                  $_SESSION['member'] = $userId;
                  $GLOBALS['appurl'] = '/m151/bilderdb_vorlage_bbcmvc/member';
                  header('Location: ' . $GLOBALS['appurl'] . '/');
              }
          }
      }

      function getUserIdFromDb($email, $password) {
          $db = "imagedb";
          $email = strtolower($email);
          $result = $db->query("SELECT uid FROM user WHERE lower(email)='".$email."' AND password='".md5($password)."'");
          if ($user = $result->fetchArray()) return $user[0];
          else return 0;
      }

      function getUsers() {
          $alle = [];
          $db = "imagedb";
          $users = $db->query("SELECT uid, name, email, password FROM user ORDER BY uid");
          while ($user = $users->fetchArray()) {
              $alle[] = $user;
          }
          return $alle;
      }


}
?>
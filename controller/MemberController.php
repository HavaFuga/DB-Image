<?php
require_once '../repository/MemberRepository.php';

/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 24.04.2018
 * Time: 22:36
 */

class MemberController
{
    public function index()
    {
        $memberRepository = new MemberRepository();
        $view = new View('member_index');
        $view->title = 'Image-DB';
        $view->heading = 'Member';
        $view->display();
    }

    public function edit()
    {
        $view = new View('member_edit');
        $view->title = 'Image-DB';
        $view->heading = 'Edit your Profile';
        $view->display();
    }

    /**
     * Speichert die Änderungen eines Kontakts in die DB und ruft die Indexseite auf
     */
    public function doEdit()
    {
        if ($_POST['send']) {
            if ($_POST['password']!=$_POST['password2']){
                return false;
                header('Location: ' . $GLOBALS['appurl'] . '/login/registration');
                echo "<div class='error-message col-md-6 offset-md-3'>";
                echo "<p class='alert alert-danger'>Passwort stimmt nicht überein</p>";
                echo "</div>";
            }else{
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $loginRepository = new LoginRepository();
                $loginRepository->create($name, $email, $password);
                // Anfrage an die URI /entry weiterleiten (HTTP 302)
                header('Location: '.$GLOBALS['appurl'].'/login');
            }
        }

    }

    public function doLogout(){
        $_SESSION['member'] = false;
        $_SESSION['error-log'] = '';
        $_SESSION['error-reg'] = '';
        session_unset();
        session_destroy();
        $GLOBALS['appurl'] = '/m151/bilderdb_vorlage_bbcmvc/public';
        header('Location: ' . $GLOBALS['appurl'] . '/');
    }
}
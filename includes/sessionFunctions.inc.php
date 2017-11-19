<?php
    
    //Start Session
    function setSession($uID){
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['userID'] = $uID;
    }
    //Closes the session
    function closeSession(){
        session_destroy();
    }


//login php
// session_start():e
//     if (isset($POST['uname'])) {
//         if (validateUser($_POST['uname'], $_POST['pwrd'])) {
//             $_SESSION['user'] = $_POST['uname'];
//             echo HomeScreen();
//         } else {
//             echo LoginFormErrorPage();
//         }
//     }

?>

<?php
	require_once('../core/init.php');

    if(postInput('email') == '' || postInput('password') == ''){
        header("location: http://localhost/sublime/");
    }else{

        $data= [
            'mail' => postInput('email'),
            'password' => postInput('password')
        ];
        $value = $db->fetchALL_condition_and_assoc('user', 'mail', $data['mail'], 'password', md5($data['password']));
        if($value['status'] == 0){
            $_SESSION['error'] = '<script type="text/javascript">alert("Your account is on the restricted list. Please contact the manager");</script>';
            header("location: http://localhost/sublime/");
        }else{
            if($value){
                //_debug($value);
                $_SESSION['login']['name_user'] = $value['name'];
                $_SESSION['login']['name_id'] = $value['id'];
                $_SESSION['login']['mail'] = $value['mail'];
                $_SESSION['login']['status'] = $value['status'];
                $_SESSION['login']['level'] = $value['level'];
                if($_SESSION['login']['level'] == 1){
                    $_SESSION['error'] = '<script type="text/javascript">alert("Login successful");</script>';
                    header("location: http://localhost/sublime/");
                }else{
                    $_SESSION['error'] = '<script type="text/javascript">alert("Login adminstrator page successful");</script>';
                    header("location: http://localhost/sublime/admin/");
                }
            }else{
                $_SESSION['error'] = '<script type="text/javascript">alert("Account does not exist");</script>';
                header("location: http://localhost/sublime/");
            }
        }
    }
?>
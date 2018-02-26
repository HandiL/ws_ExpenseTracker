<?php

include_once '../entity/User.php';
include_once '../dao/UserDaoImpl.php';
include_once '../utility/DBUtil.php';
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (isset($email) && isset($password) && !empty($email) && !empty($password)) {
    $userDao = new UserDaoImpl();
    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    $userDao->setData($user);
    $result = $userDao->login();
    if (isset($result) && isset($result->email)) {
        $data = array('status' => 1, 'msg' => 'Login success', 'user' => $result);
    } else {
        $data = array('status' => 0, 'msg' => 'Invalid email or password', 'user' => NULL);
    }
} else {
    $data=array('status'=>0,'msg'=>'Please fill email and passowrd');
}
header('Content-type:application/json');
echo json_encode($data);

?>
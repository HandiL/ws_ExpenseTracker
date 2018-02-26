<?php
include_once '../entity/User.php';
include_once '../dao/UserDaoImpl.php';
include_once '../utility/DBUtil.php';
$namaUser = filter_input(INPUT_POST, 'namaUser');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if (isset($email) && isset($password) && isset($namaUser) && !empty($email) && !empty($password) && !empty($namaUser)) {
    $userDao = new UserDaoImpl();
    $user = new User();
    $user->setNamaUser($namaUser);
    $user->setEmail($email);
    $user->setPassword($password);
    $userDao->setData($user);
    $result = $userDao->addUser();
    $data = array();
    $data['status']=1;
    $data['msg']='Data Berhasil Ditambahkan';
}
else
{
    $data = array();
    $data['status']=2;
    $data['msg']='Ada Data yang Kosong';
}
header('Content-type:application/json');
echo json_encode($data);
?>

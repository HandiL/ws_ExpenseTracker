<?php
/**
 * Description of User
 *
 * @author Handi
 */
class User implements JsonSerializable {
    private $idUser;
    private $namaUser;
    private $password;
    private $email;
    public function getIdUser() {
        return $this->idUser;
    }

    public function getNamaUser() {
        return $this->namaUser;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function setNamaUser($namaUser) {
        $this->namaUser = $namaUser;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

        
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

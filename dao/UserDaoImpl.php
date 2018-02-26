<?php

class UserDaoImpl {
    /**
     * 
     * @var User $data
     * 
     */
    private $data;
    public function setData(User $data) {
        $this->data = $data;
    }

    public function login() {
        if(isset($this->data)) 
        {
            $query = "SELECT * FROM user WHERE email = ? AND password = MD5(?) LIMIT 1";    
            $link = DBUtil::createPDOConnection();
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $this->data->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(2, $this->data->getPassword(), PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $result = $stmt->fetch();
            DBUtil::closePDOConnection($link);
            $this->data = NULL;
        }
        return $result;
    }
    public function addUser() {
        $query = "INSERT INTO user(namaUser,email,password) VALUES (?,?,MD5(?))";
        $link = DBUtil::createPDOConnection();
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $this->data->getNamaUser(), PDO::PARAM_STR);
        $stmt->bindValue(2, $this->data->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(3, $this->data->getPassword(), PDO::PARAM_STR);
        $link ->beginTransaction();
        if($stmt->execute())
        {
            $link->commit();
        }
        else
        {
            $link->rollBack();
        }
        $this->data = NULL;
        DBUtil::closePDOConnection($link);
    }
}

?>

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IncomeDaoImpl
 *
 * @author Handi
 */
class IncomeDaoImpl {
    
    /**
     *
     * @var Income $data 
     */
    private $data;
    public function setData(Income $data) {
        $this->data = $data;
    }
    
    public function showAll(){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM Income";
        $result=$link->prepare($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Income');
        $result->execute();
        DBUtil::closePDOConnection($link);
        return $result;
    }
    
    public function addIncome(Income $income){
        if(isset($this->data)&& !empty($this->data)) 
        {
            $link= DBUtil::createPDOConnection();
            $query="INSERT INTO Income(jumlah,waktu,User,CategoryIncome) VALUES (?,?,?,?)";
            $stmt=$link->prepare($query);
            $stmt->bindValue(1, $income->getJumlah(), PDO::PARAM_INT);
            $stmt->bindValue(2, $income->getWaktu(), PDO::PARAM_STR);
            $stmt->bindValue(3, $income->getUser(), PDO::PARAM_STR);
            $stmt->bindValue(4, $income->getCategoryIncome(), PDO::PARAM_STR);
            $result = $stmt->execute();
            DBUtil::closePDOConnection($link);
            return $result;
        }
        return NULL;
    }
    
    public function getIncomeFromDb($id){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM Income WHERE idIncome=? LIMIT 1";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result=$stmt->fetch();
        DBUtil::closePDOConnection($link);
        return $result;
    }
   
    
    public function updateIncome(Income $income){
        $link= DBUtil::createPDOConnection();
        $query="UPDATE Income SET jumlah=?,waktu=?,CategoryIncome=? WHERE idIncome=?";
        $stmt=$link->prepare($query);
        $stmt->bindValue(1, $income->getJumlah(), PDO::PARAM_Int);
        $stmt->bindValue(2, $income->getWaktu(), PDO::PARAM_STR);
        $stmt->bindValue(3, $income->getCategoryIncome(),PDO::PARAM_STR);
        $stmt->bindValue(4, $income->getIdIncome(), PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
        } else {
            $link->rollBack();
        }
        DBUtil::closePDOConnection($link);
    }
    
    public function deleteIncome(Income $income){
        $link= DBUtil::createPDOConnection();
        $query="DELETE FROM Income WHERE idIncome=?";
        $stmt=$link->prepare($query);
        $stmt->bindValue(1, $income->getIdIncome(), PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
        } else {
            $link->rollBack();
        }
        DBUtil::closePDOConnection($link);
    }

}

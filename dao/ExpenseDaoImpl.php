<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExpenseDaoImpl
 *
 * @author Handi
 */
class ExpenseDaoImpl {
    /**
     *
     * @var Expense $data 
     */
    private $data;
    public function setData(Expense $data) {
        $this->data = $data;
    }
    
    public function showAll(){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM Expense";
        $result=$link->prepare($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Expense');
        $result->execute();
        DBUtil::closePDOConnection($link);
        return $result;
    }
    
    public function addExpense(Expense $expense){
        if(isset($this->data)&& !empty($this->data)) 
        {
            $link= DBUtil::createPDOConnection();
            $query="INSERT INTO Expense(jumlah,waktu,User,CategoryExpense) VALUES (?,?,?,?)";
            $stmt=$link->prepare($query);
            $stmt->bindValue(1, $expense->getJumlah(), PDO::PARAM_INT);
            $stmt->bindValue(2, $expense->getWaktu(), PDO::PARAM_STR);
            $stmt->bindValue(3, $expense->getUser(), PDO::PARAM_STR);
            $stmt->bindValue(4, $expense->getCategoryIncome(), PDO::PARAM_STR);
            $result = $stmt->execute();
            DBUtil::closePDOConnection($link);
            return $result;
        }
        return NULL;
    }
    
    public function getExpenseFromDb($id){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM Expense WHERE idExpense=? LIMIT 1";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result=$stmt->fetch();
        DBUtil::closePDOConnection($link);
        return $result;
    }
    
    
    
    public function updateExpense(Expense $expense){
        $link= DBUtil::createPDOConnection();
        $query="UPDATE Expense SET jumlah=?,waktu=?,CategoryExpense=? WHERE idExpense=?";
        $stmt=$link->prepare($query);
        $stmt->bindValue(1, $expense->getJumlah(), PDO::PARAM_INT);
        $stmt->bindValue(2, $expense->getWaktu(), PDO::PARAM_STR);
        $stmt->bindValue(3, $expense->getCategoryExpense(),PDO::PARAM_STR);
        $stmt->bindValue(4, $expense->getIdExpense(), PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
        } else {
            $link->rollBack();
        }
        DBUtil::closePDOConnection($link);
    }
    
    public function deleteExpense(Expense $expense){
        $link= DBUtil::createPDOConnection();
        $query="DELETE FROM Expense WHERE idExpense=?";
        $stmt=$link->prepare($query);
        $stmt->bindValue(1, $expense->getIdExpense(), PDO::PARAM_INT);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
        } else {
            $link->rollBack();
        }
        DBUtil::closePDOConnection($link);
    }

}

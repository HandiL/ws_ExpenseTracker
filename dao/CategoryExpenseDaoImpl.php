<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryExpenseDaoImpl
 *
 * @author Handi
 */
class CategoryExpenseDaoImpl {
    /**
     *
     * @var CategoryExpense $data 
     */
    private $data;
    public function setData(CategoryExpense $data) {
        $this->data = $data;
    }

    public function showAll(){
        $query="SELECT * FROM CategoryExpense";
        $link= DBUtil::createPDOConnection();
        $result=$link->prepare($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'CategoryExpense');
        $result->execute();
        DBUtil::closePDOConnection($link);
        return $result;
    }
    
    public function addCategoryExpense(CategoryExpense $cat) {
        if(isset($this->data)&& !empty($this->data)) 
        {
            $query = "INSERT INTO CategoryExpense(idCategory,namaCategory) VALUES (?,?)";
            $link = DBUtil::createPDOConnection();
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $cat->getIdCategory(), PDO::PARAM_INT);
            $stmt->bindValue(2, $cat->getNamaCategory(), PDO::PARAM_STR);
            $result = $stmt->execute();
            DBUtil::closePDOConnection($link);
            return $result;
        }
        return NULL;
    }
    
    public function deleteCategoryExpense(CategoryExpense $cat) {
        $link = DBUtil::createPDOConnection();
        $query = "DELETE FROM CategoryExpense WHERE idCategory = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $cat->getIdCategory(), PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        DBUtil::closePDOConnection($link);
    }
    
    public function getCategoryExpenseFromDb($id){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM CategoryExpense WHERE idCategory=? LIMIT 1";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result=$stmt->fetch();
        DBUtil::closePDOConnection($link);
        return $result;
    }
 
    
}

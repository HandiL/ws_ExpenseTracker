<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryIncomeDaoImpl
 *
 * @author Handi
 */
class CategoryIncomeDaoImpl {
    /**
     *
     * @var CategoryIncome $data 
     */
    private $data;
    public function setData(CategoryIncome $data) {
        $this->data = $data;
    }
    
    public function showAll(){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM CategoryIncome";
        $stmt=$link->prepare($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'CategoryIncome');
        DBUtil::closePDOConnection($link);
        return $result;
    }    
    public function addCategoryIncome(CategoryIncome $cat) {
        if(isset($this->data)&& !empty($this->data)) 
        {
            $link = DBUtil::createPDOConnection();
            $query = "INSERT INTO CategoryIncome(idCategory,namaCategory) VALUES (?,?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $cat->getIdCategory(), PDO::PARAM_INT);
            $stmt->bindValue(2, $cat->getNamaCategory(), PDO::PARAM_STR);
            $result = $stmt->execute();
            DBUtil::closePDOConnection($link);
            return $result;
        }
        return NULL;
    }
    
    public function deleteCategoryIncome(CategoryIncome $cat) {
        $link = DBUtil::createPDOConnection();
        $query = "DELETE FROM CategoryIncome WHERE idCategory = ?";
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
    
    
    public function getCategoryIncomeFromDb($id){
        $link= DBUtil::createPDOConnection();
        $query="SELECT * FROM CategoryIncome WHERE idCategory=? LIMIT 1";
        $stmt=$link->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $result=$stmt->fetch();
        DBUtil::closePDOConnection($link);
        return $result;
    }

    
    
    
}

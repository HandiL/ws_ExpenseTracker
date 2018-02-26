<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryExpense
 *
 * @author Handi
 */
class CategoryExpense implements JsonSerializable{
    private $idCategory;
    private $namaCategory;
    public function getIdCategory() {
        return $this->idCategory;
    }

    public function getNamaCategory() {
        return $this->namaCategory;
    }

    public function setIdCategory($idCategory) {
        $this->idCategory = $idCategory;
    }

    public function setNamaCategory($namaCategory) {
        $this->namaCategory = $namaCategory;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

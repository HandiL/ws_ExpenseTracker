<?php
/**
 * Description of Expense
 *
 * @author Handi
 */
class Expense implements JsonSerializable{
    private $idExpense;
    private $jumlah;
    private $waktu;
    private $User;
    private $CategoryExpense;
    public function __construct() {
        $this->CategoryExpense = new CategoryExpense();
        $this->User = new User();
    }
    
    public function getIdExpense() {
        return $this->idExpense;
    }

    public function getJumlah() {
        return $this->jumlah;
    }

    public function getWaktu() {
        return $this->waktu;
    }

    public function getUser() {
        return $this->User;
    }

    public function getCategoryExpense() {
        return $this->CategoryExpense;
    }

    public function setIdExpense($idExpense) {
        $this->idExpense = $idExpense;
    }

    public function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    public function setWaktu($waktu) {
        $this->waktu = $waktu;
    }

    public function setUser($User) {
        $this->User = $User;
    }

    public function setCategoryExpense($CategoryExpense) {
        $this->CategoryExpense = $CategoryExpense;
    }

    public function jsonSerialize() {
        return get_object_vars($this);   
    }

}

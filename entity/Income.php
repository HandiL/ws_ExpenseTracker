<?php

/**
 * Description of Income
 *
 * @author Handi
 */
class Income implements JsonSerializable{
    private $idIncome;
    private $jumlah;
    private $waktu;
    private $User;
    private $CategoryIncome;
    public function __construct() {
        $this->CategoryIncome = new CategoryIncome();
        $this->User = new User();
    }

    public function getIdIncome() {
        return $this->idIncome;
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

    public function getCategoryIncome() {
        return $this->CategoryIncome;
    }

    public function setIdIncome($idIncome) {
        $this->idIncome = $idIncome;
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

    public function setCategoryIncome($CategoryIncome) {
        $this->CategoryIncome = $CategoryIncome;
    }

    public function jsonSerialize() {
        return get_object_vars($this);   
    }

}

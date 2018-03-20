<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 1/17/2018
 * Time: 3:31 PM
 */

class Pertanyaan
{
    private $idPertanyaan;
    private $survey;
    private $nomorPertanyaan;
    private $pertanyaan;
    private $penjelasan;
    private $tipeSoal;
    private $jumlahPilihan;
    private $jumlahBaris;
    private $jumlahKolom;

    /**
     * @return mixed
     */
    public function getIdPertanyaan()
    {
        return $this->idPertanyaan;
    }

    /**
     * @param mixed $idPertanyaan
     */
    public function setIdPertanyaan($idPertanyaan): void
    {
        $this->idPertanyaan = $idPertanyaan;
    }

    /**
     * @return mixed
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @param mixed $survey
     */
    public function setSurvey($survey): void
    {
        $this->survey = $survey;
    }

    /**
     * @return mixed
     */
    public function getNomorPertanyaan()
    {
        return $this->nomorPertanyaan;
    }

    /**
     * @param mixed $nomorPertanyaan
     */
    public function setNomorPertanyaan($nomorPertanyaan): void
    {
        $this->nomorPertanyaan = $nomorPertanyaan;
    }

    /**
     * @return mixed
     */
    public function getPertanyaan()
    {
        return $this->pertanyaan;
    }

    /**
     * @param mixed $pertanyaan
     */
    public function setPertanyaan($pertanyaan): void
    {
        $this->pertanyaan = $pertanyaan;
    }

    /**
     * @return mixed
     */
    public function getPenjelasan()
    {
        return $this->penjelasan;
    }

    /**
     * @param mixed $penjelasan
     */
    public function setPenjelasan($penjelasan): void
    {
        $this->penjelasan = $penjelasan;
    }

    /**
     * @return mixed
     */
    public function getTipeSoal()
    {
        return $this->tipeSoal;
    }

    /**
     * @param mixed $tipeSoal
     */
    public function setTipeSoal($tipeSoal): void
    {
        $this->tipeSoal = $tipeSoal;
    }

    /**
     * @return mixed
     */
    public function getJumlahPilihan()
    {
        return $this->jumlahPilihan;
    }

    /**
     * @param mixed $jumlahPilihan
     */
    public function setJumlahPilihan($jumlahPilihan): void
    {
        $this->jumlahPilihan = $jumlahPilihan;
    }

    /**
     * @return mixed
     */
    public function getJumlahBaris()
    {
        return $this->jumlahBaris;
    }

    /**
     * @param mixed $jumlahBaris
     */
    public function setJumlahBaris($jumlahBaris): void
    {
        $this->jumlahBaris = $jumlahBaris;
    }

    /**
     * @return mixed
     */
    public function getJumlahKolom()
    {
        return $this->jumlahKolom;
    }

    /**
     * @param mixed $jumlahKolom
     */
    public function setJumlahKolom($jumlahKolom): void
    {
        $this->jumlahKolom = $jumlahKolom;
    }


}
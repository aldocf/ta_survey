<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 6:49 PM
 */

class Kolom
{
    private $idKolom;
    private $pertanyaan;
    private $isiKolom;

    /**
     * @return mixed
     */
    public function getIdKolom()
    {
        return $this->idKolom;
    }

    /**
     * @param mixed $idKolom
     */
    public function setIdKolom($idKolom): void
    {
        $this->idKolom = $idKolom;
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
    public function getIsiKolom()
    {
        return $this->isiKolom;
    }

    /**
     * @param mixed $isiKolom
     */
    public function setIsiKolom($isiKolom): void
    {
        $this->isiKolom = $isiKolom;
    }




}
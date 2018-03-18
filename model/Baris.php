<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 6:48 PM
 */

class Baris
{
    private $idBaris;
    private $pertanyaan;
    private $isiBaris;

    /**
     * @return mixed
     */
    public function getIdBaris()
    {
        return $this->idBaris;
    }

    /**
     * @param mixed $idBaris
     */
    public function setIdBaris($idBaris): void
    {
        $this->idBaris = $idBaris;
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
    public function getIsiBaris()
    {
        return $this->isiBaris;
    }

    /**
     * @param mixed $isiBaris
     */
    public function setIsiBaris($isiBaris): void
    {
        $this->isiBaris = $isiBaris;
    }


}
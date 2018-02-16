<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 1/17/2018
 * Time: 3:32 PM
 */

class Pilihan
{
    private $idPilihan;
    private $pertanyaan;
    private $pilihan;

    /**
     * @return mixed
     */
    public function getIdPilihan()
    {
        return $this->idPilihan;
    }

    /**
     * @param mixed $idPilihan
     */
    public function setIdPilihan($idPilihan): void
    {
        $this->idPilihan = $idPilihan;
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
    public function getPilihan()
    {
        return $this->pilihan;
    }

    /**
     * @param mixed $pilihan
     */
    public function setPilihan($pilihan): void
    {
        $this->pilihan = $pilihan;
    }


}
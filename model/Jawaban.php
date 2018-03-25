<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/25/2018
 * Time: 2:14 PM
 */

class Jawaban
{
    private $responden;
    private $pertanyaan;
    private $isiJawaban;

    /**
     * @return mixed
     */
    public function getResponden()
    {
        return $this->responden;
    }

    /**
     * @param mixed $responden
     */
    public function setResponden($responden): void
    {
        $this->responden = $responden;
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
    public function getIsiJawaban()
    {
        return $this->isiJawaban;
    }

    /**
     * @param mixed $isiJawaban
     */
    public function setIsiJawaban($isiJawaban): void
    {
        $this->isiJawaban = $isiJawaban;
    }


}
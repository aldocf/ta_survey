<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 1/17/2018
 * Time: 3:30 PM
 */

class Survey
{
    private $idSurvey;
    private $namaSurvey;
    private $deskripsiSurvey;

    /**
     * @return mixed
     */
    public function getIdSurvey()
    {
        return $this->idSurvey;
    }

    /**
     * @param mixed $idSurvey
     */
    public function setIdSurvey($idSurvey): void
    {
        $this->idSurvey = $idSurvey;
    }

    /**
     * @return mixed
     */
    public function getNamaSurvey()
    {
        return $this->namaSurvey;
    }

    /**
     * @param mixed $namaSurvey
     */
    public function setNamaSurvey($namaSurvey): void
    {
        $this->namaSurvey = $namaSurvey;
    }

    /**
     * @return mixed
     */
    public function getDeskripsiSurvey()
    {
        return $this->deskripsiSurvey;
    }

    /**
     * @param mixed $deskripsiSurvey
     */
    public function setDeskripsiSurvey($deskripsiSurvey): void
    {
        $this->deskripsiSurvey = $deskripsiSurvey;
    }


}
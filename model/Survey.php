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
    private $targetResponden;
    private $periodeSurvey;
    private $periodeSurveyAkhir;
    private $isJawab;

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

    /**
     * @return mixed
     */
    public function getTargetResponden()
    {
        return $this->targetResponden;
    }

    /**
     * @param mixed $targetResponden
     */
    public function setTargetResponden($targetResponden): void
    {
        $this->targetResponden = $targetResponden;
    }

    /**
     * @return mixed
     */
    public function getPeriodeSurvey()
    {
        return $this->periodeSurvey;
    }

    /**
     * @param mixed $periodeSurvey
     */
    public function setPeriodeSurvey($periodeSurvey): void
    {
        $this->periodeSurvey = $periodeSurvey;
    }

    /**
     * @return mixed
     */
    public function getPeriodeSurveyAkhir()
    {
        return $this->periodeSurveyAkhir;
    }

    /**
     * @param mixed $periodeSurveyAkhir
     */
    public function setPeriodeSurveyAkhir($periodeSurveyAkhir): void
    {
        $this->periodeSurveyAkhir = $periodeSurveyAkhir;
    }

    /**
     * @return mixed
     */
    public function getisJawab()
    {
        return $this->isJawab;
    }

    /**
     * @param mixed $isJawab
     */
    public function setIsJawab($isJawab): void
    {
        $this->isJawab = $isJawab;
    }


}
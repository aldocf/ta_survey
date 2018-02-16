<?php
/**
 * Created by PhpStorm.
 * User: ACF
 * Date: 16/02/2018
 * Time: 10:36
 */
class Responden
{
    private $id_responden;
    private $jabatan;
    private $nama_perusahaan;
    private $id_user;

    /**
     * @return mixed
     */
    public function getIdResponden()
    {
        return $this->id_responden;
    }

    /**
     * @param mixed $id_responden
     */
    public function setIdResponden($id_responden)
    {
        $this->id_responden = $id_responden;
    }

    /**
     * @return mixed
     */
    public function getJabatan()
    {
        return $this->jabatan;
    }

    /**
     * @param mixed $jabatan
     */
    public function setJabatan($jabatan)
    {
        $this->jabatan = $jabatan;
    }

    /**
     * @return mixed
     */
    public function getNamaPerusahaan()
    {
        return $this->nama_perusahaan;
    }

    /**
     * @param mixed $nama_perusahaan
     */
    public function setNamaPerusahaan($nama_perusahaan)
    {
        $this->nama_perusahaan = $nama_perusahaan;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

}

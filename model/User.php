<?php

class User
{
    private $idUser;
    private $nama;
    private $nomorTelepon;
    private $email;
    private $password;
    private $verivikasiKode;
    private $role;
    private $status;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getNomorTelepon()
    {
        return $this->nomorTelepon;
    }

    /**
     * @param mixed $nomorTelepon
     */
    public function setNomorTelepon($nomorTelepon)
    {
        $this->nomorTelepon = $nomorTelepon;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getVerivikasiKode()
    {
        return $this->verivikasiKode;
    }

    /**
     * @param mixed $verivikasiKode
     */
    public function setVerivikasiKode($verivikasiKode)
    {
        $this->verivikasiKode = $verivikasiKode;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}
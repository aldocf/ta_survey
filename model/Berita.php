<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 2/16/2018
 * Time: 4:09 PM
 */

class Berita
{
    private $idBerita;
    private $kategori;
    private $user;
    private $judul;
    private $deskripsi;
    private $cover;
    private $created;

    /**
     * @return mixed
     */
    public function getIdBerita()
    {
        return $this->idBerita;
    }

    /**
     * @param mixed $idBerita
     */
    public function setIdBerita($idBerita)
    {
        $this->idBerita = $idBerita;
    }

    /**
     * @return mixed
     */
    public function getKategori()
    {
        return $this->kategori;
    }

    /**
     * @param mixed $kategori
     */
    public function setKategori($kategori)
    {
        $this->kategori = $kategori;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getJudul()
    {
        return $this->judul;
    }

    /**
     * @param mixed $judul
     */
    public function setJudul($judul)
    {
        $this->judul = $judul;
    }

    /**
     * @return mixed
     */
    public function getDeskripsi()
    {
        return $this->deskripsi;
    }

    /**
     * @param mixed $deskripsi
     */
    public function setDeskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


}
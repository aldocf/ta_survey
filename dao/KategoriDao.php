<?php

class KategoriDao
{

    public function getAllKategori()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM kategori";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $kategori = new Kategori();
                $kategori->setIdKategori($row['id_kategori']);
                $kategori->setNamaKategori($row['nama_kategori']);
                $data->append($kategori);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function insertkategori(Kategori $data)
    {
        $result = FALSE;
        $nama = $data->getNamaKategori();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO kategori(nama) VALUES(?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $nama);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getKategori($id)
    {
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM kategori WHERE id_kategori=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            $row = $stmt->fetch();
            $kayegori = new Kategori();
            $kayegori->setIdKategori($row['id_kategori']);
            $kayegori->setNamaKategori($row['nama_kategori']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $kayegori;
    }

}

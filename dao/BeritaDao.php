<?php

class BeritaDao
{

    public function getAllBerita()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM berita JOIN kategori ON kategori.id_kategori = berita.id_kategori JOIN user ON user.id_user = berita.id_user";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $berita = new Berita();
                $berita->setIdBerita($row['id_berita']);
                $berita->setKategori($row['nama_kategori']);
                $berita->setUser($row['nama']);
                $berita->setCover($row['cover']);
                $berita->setJudul($row['judul']);
                $berita->setDeskripsi($row['deskripsi']);
                $berita->setCreated($row['created']);
                $data->append($berita);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function insertBerita(Berita $data)
    {
        $result = FALSE;
        $kategori = $data->getKategori();
        $user = $data->getUser();
        $judul = $data->getJudul();
        $deskripsi = $data->getDeskripsi();
        $cover = $data->getCover();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO berita(id_kategori, id_user, judul, deskripsi, cover) VALUES(?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $kategori);
            $stmt->bindParam(2, $user);
            $stmt->bindParam(3, $judul);
            $stmt->bindParam(4, $deskripsi);
            $stmt->bindParam(5, $cover);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getBerita($id)
    {
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM berita JOIN kategori ON kategori.id_kategori = berita.id_kategori JOIN user ON user.id_user = berita.id_user WHERE id_berita=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            $row = $stmt->fetch();
            $berita = new Berita();
            $berita->setIdBerita($row['id_berita']);
            $berita->setKategori($row['id_kategori']);
            $berita->setUser($row['nama']);
            $berita->setCover($row['cover']);
            $berita->setJudul($row['judul']);
            $berita->setDeskripsi($row['deskripsi']);
            $berita->setCreated($row['created']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $berita;
    }

    public function updateBerita(Berita $data)
    {
        $result = FALSE;
        $id = $data->getIdBerita();
        $kategori = $data->getKategori();
        $user = $data->getUser();
        $judul = $data->getJudul();
        $deskripsi = $data->getDeskripsi();
        $cover = $data->getCover();

        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "UPDATE berita SET id_kategori=?, id_user=?, judul=?, deskripsi=?, cover=? WHERE id_berita=? ";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $kategori);
            $stmt->bindParam(2, $user);
            $stmt->bindParam(3, $judul);
            $stmt->bindParam(4, $deskripsi);
            $stmt->bindParam(5, $cover);
            $stmt->bindParam(6, $id);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            $conn->rollBack();
            echo $e->getMessage();
            die();
        }
        return $result;
    }


}

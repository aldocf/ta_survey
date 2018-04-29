<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class JawabanDao
{
    public function insertJawaban(Jawaban $data)
    {
        $result = FALSE;
        $responden = $data->getResponden();
        $pertanyaan = $data->getPertanyaan();
        $isi = $data->getIsiJawaban();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO jawaban(id_responden, id_pertanyaan, isi_jawaban) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $responden);
            $stmt->bindParam(2, $pertanyaan);
            $stmt->bindParam(3, $isi);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function insertJawabanMatrix(Jawaban $data)
    {
        $result = FALSE;
        $responden = $data->getResponden();
        $pertanyaan = $data->getPertanyaan();
        $isi = $data->getIsiJawaban();
        $baris = $data->getIdBaris();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO jawaban(id_responden, id_pertanyaan, isi_jawaban, id_baris) VALUES(?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $responden);
            $stmt->bindParam(2, $pertanyaan);
            $stmt->bindParam(3, $isi);
            $stmt->bindParam(4, $baris);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getJawaban($id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM jawaban JOIN responden ON responden.id_responden = jawaban.id_responden JOIN user ON user.id_user = responden.id_user WHERE jawaban.id_pertanyaan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $user = new User();
                $user->setNama($row['nama']);
                $responden = new Responden();
                $responden->setIdUser($user);

                $jawaban = new Jawaban();
                $jawaban->setIsiJawaban($row['isi_jawaban']);
                $jawaban->setResponden($responden);

                $data->append($jawaban);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }



}
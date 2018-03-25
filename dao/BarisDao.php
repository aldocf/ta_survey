<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class BarisDao
{
    public function insertBaris(Baris $data)
    {
        $result = FALSE;
        $pertanyaan = $data->getPertanyaan();
        $isi = $data->getIsiBaris();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO baris(id_pertanyaan, isi_baris) VALUES(?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $pertanyaan);
            $stmt->bindParam(2, $isi);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getSurveyBaris($id)
    {
        $data = new ArrayObject();
        $baris = new Baris();
        $data->append($baris);
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM baris WHERE id_pertanyaan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $baris = new Baris();
                $baris->setIdBaris($row['id_baris']);
                $baris->setPertanyaan($row['id_pertanyaan']);
                $baris->setIsiBaris($row['isi_baris']);
                $data->append($baris);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

}
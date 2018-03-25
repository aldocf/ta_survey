<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class KolomDao
{
    public function insertKolom(Kolom $data)
    {
        $result = FALSE;
        $pertanyaan = $data->getPertanyaan();
        $isi = $data->getIsiKolom();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO kolom(id_pertanyaan, isi_kolom) VALUES(?,?)";
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

    public function getSurveyKolom($id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM kolom WHERE id_pertanyaan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $kolom = new Kolom();
                $kolom->setIdKolom($row['id_kolom']);
                $kolom->setPertanyaan($row['id_pertanyaan']);
                $kolom->setIsiKolom($row['isi_kolom']);
                $data->append($kolom);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }
}
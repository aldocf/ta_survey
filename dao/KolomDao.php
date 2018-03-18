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
}
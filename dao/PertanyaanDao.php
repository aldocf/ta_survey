<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class PertanyaanDao
{
    public function insertPertanyaanSingle(Pertanyaan $data)
    {
        $result = FALSE;
        $survey = $data->getSurvey();
        $pertanyaan = $data->getPertanyaan();
        $penjelasan = $data->getPenjelasan();
        $tipeSoal = $data->getTipeSoal();
        $nomor = $data->getNomorPertanyaan();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO pertanyaan(id_survey, nomor_pertanyaan, pertanyaan, penjelasan, tipe_soal) VALUES(?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $survey);
            $stmt->bindParam(2, $nomor);
            $stmt->bindParam(3, $pertanyaan);
            $stmt->bindParam(4, $penjelasan);
            $stmt->bindParam(5, $tipeSoal);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function insertPertanyaanPilihan(Pertanyaan $data)
    {
        $result = FALSE;
        $survey = $data->getSurvey();
        $pertanyaan = $data->getPertanyaan();
        $penjelasan = $data->getPenjelasan();
        $tipeSoal = $data->getTipeSoal();
        $nomor = $data->getNomorPertanyaan();
        $pilihan = $data->getJumlahPilihan();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO pertanyaan(id_survey, nomor_pertanyaan, pertanyaan, penjelasan, tipe_soal, jumlah_pilihan) VALUES(?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $survey);
            $stmt->bindParam(2, $nomor);
            $stmt->bindParam(3, $pertanyaan);
            $stmt->bindParam(4, $penjelasan);
            $stmt->bindParam(5, $tipeSoal);
            $stmt->bindParam(6, $pilihan);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function insertPertanyaanMatrix(Pertanyaan $data)
    {
        $result = FALSE;
        $survey = $data->getSurvey();
        $pertanyaan = $data->getPertanyaan();
        $penjelasan = $data->getPenjelasan();
        $tipeSoal = $data->getTipeSoal();
        $nomor = $data->getNomorPertanyaan();
        $baris = $data->getJumlahBaris();
        $kolom = $data->getJumlahKolom();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO pertanyaan(id_survey, nomor_pertanyaan, pertanyaan, penjelasan, tipe_soal, jumlah_baris, jumlah_kolom) VALUES(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $survey);
            $stmt->bindParam(2, $nomor);
            $stmt->bindParam(3, $pertanyaan);
            $stmt->bindParam(4, $penjelasan);
            $stmt->bindParam(5, $tipeSoal);
            $stmt->bindParam(6, $baris);
            $stmt->bindParam(7, $kolom);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getLastIdPertanyaan(Pertanyaan $data)
    {
        $survey = $data->getSurvey();
        $pertanyaan = $data->getPertanyaan();
        $penjelasan = $data->getPenjelasan();
        $tipeSoal = $data->getTipeSoal();
        $nomor = $data->getNomorPertanyaan();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM pertanyaan WHERE id_survey = ? AND nomor_pertanyaan = ? AND pertanyaan = ? AND penjelasan = ? AND tipe_soal = ? ORDER BY id_pertanyaan DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $survey);
            $stmt->bindParam(2, $nomor);
            $stmt->bindParam(3, $pertanyaan);
            $stmt->bindParam(4, $penjelasan);
            $stmt->bindParam(5, $tipeSoal);

            $stmt->execute();
            $row = $stmt->fetch();
            $pertanyaan = new Pertanyaan();
            $pertanyaan->setIdPertanyaan($row['id_pertanyaan']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $pertanyaan;
    }
}
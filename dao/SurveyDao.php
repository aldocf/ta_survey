<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class SurveyDao
{
    public function insertSurvey(Survey $data)
    {
        $result = FALSE;
        $namaSurvey = $data->getNamaSurvey();
        $deskripsi = $data->getDeskripsiSurvey();
        $target = $data->getTargetResponden();
        $awal = $data->getPeriodeSurvey();
        $akhir = $data->getPeriodeSurveyAkhir();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO survey(nama_survey, deskripsi_survey, target_responden, periode_survey, periode_survey_akhir) VALUES(?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $namaSurvey);
            $stmt->bindParam(2, $deskripsi);
            $stmt->bindParam(3, $target);
            $stmt->bindParam(4, $awal);
            $stmt->bindParam(5, $akhir);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getLastIdSurvey(Survey $data)
    {
        $namaSurvey = $data->getNamaSurvey();
        $deskripsi = $data->getDeskripsiSurvey();
        $target = $data->getTargetResponden();
        $awal = $data->getPeriodeSurvey();
        $akhir = $data->getPeriodeSurveyAkhir();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM survey WHERE nama_survey = ? AND deskripsi_survey = ? AND target_responden = ? AND periode_survey = ? AND periode_survey_akhir = ? ORDER BY id_survey DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $namaSurvey);
            $stmt->bindParam(2, $deskripsi);
            $stmt->bindParam(3, $target);
            $stmt->bindParam(4, $awal);
            $stmt->bindParam(5, $akhir);

            $stmt->execute();
            $row = $stmt->fetch();
            $survey = new Survey();
            $survey->setIdSurvey($row['id_survey']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $survey;
    }

    public function getAllSurvey()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM survey";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllSurveyForRespondenAnswered($jabatan, $id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT survey.* FROM jawaban JOIN pertanyaan on pertanyaan.id_pertanyaan = jawaban.id_pertanyaan join survey on survey.id_survey = pertanyaan.id_survey WHERE jawaban.id_responden = ? AND (target_responden = ? OR target_responden = 'Semua Responden') GROUP BY survey.id_survey";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $jabatan);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
//                $survey->setIsJawab($row['jawaban']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllSurveyForResponden($jabatan, $id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT survey.* FROM survey JOIN pertanyaan on pertanyaan.id_survey = survey.id_survey WHERE (target_responden = ? OR target_responden = 'Semua Responden') AND survey.id_survey NOT IN (SELECT survey.id_survey FROM jawaban JOIN pertanyaan on pertanyaan.id_pertanyaan = jawaban.id_pertanyaan join survey on survey.id_survey = pertanyaan.id_survey WHERE jawaban.id_responden = ? AND (target_responden = ? OR target_responden = 'Semua Responden') GROUP BY survey.id_survey) GROUP BY survey.id_survey";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $jabatan);
            $stmt->bindParam(2, $id);
            $stmt->bindParam(3, $jabatan);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $survey->setIsJawab(0);
                $data->append($survey);
            }

            $sql = "SELECT survey.* FROM jawaban JOIN pertanyaan on pertanyaan.id_pertanyaan = jawaban.id_pertanyaan join survey on survey.id_survey = pertanyaan.id_survey WHERE jawaban.id_responden = ? AND (target_responden = ? OR target_responden = 'Semua Responden') GROUP BY survey.id_survey";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $jabatan);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $survey->setIsJawab(1);
                $data->append($survey);
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllCountRespondenSurvey()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT survey.*, IFNULL(COUNT(DISTINCT(responden.id_responden)),0) AS jumlah FROM survey LEFT JOIN pertanyaan ON pertanyaan.id_survey = survey.id_survey LEFT JOIN jawaban ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan LEFT JOIN responden ON responden.id_responden = jawaban.id_responden GROUP by survey.id_survey";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['jumlah']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getSurvey($id)
    {
        $survey = null;
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM survey WHERE id_survey = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch();
            $survey = new Survey();
            $survey->setIdSurvey($row['id_survey']);
            $survey->setNamaSurvey($row['nama_survey']);
            $survey->setDeskripsiSurvey($row['deskripsi_survey']);
            $survey->setTargetResponden($row['target_responden']);
            $survey->setPeriodeSurvey($row['periode_survey']);
            $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $survey;
    }

    public function getSurveyAllPertanyaan($id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM survey JOIN pertanyaan ON pertanyaan.id_survey = survey.id_survey WHERE survey.id_survey = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);

                $pertanyaan = new Pertanyaan();
                $pertanyaan->setIdPertanyaan($row['id_pertanyaan']);
                $pertanyaan->setSurvey($survey);
                $pertanyaan->setNomorPertanyaan($row['nomor_pertanyaan']);
                $pertanyaan->setPertanyaan($row['pertanyaan']);
                $pertanyaan->setPenjelasan($row['penjelasan']);
                $pertanyaan->setTipeSoal($row['tipe_soal']);
                $pertanyaan->setJumlahPilihan($row['jumlah_pilihan']);
                $pertanyaan->setJumlahBaris($row['jumlah_baris']);
                $pertanyaan->setJumlahKolom($row['jumlah_kolom']);
                $data->append($pertanyaan);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllSurveyFilterByStatus($id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            if ($id == 0) {
                $sql = "SELECT *, CURRENT_DATE() FROM survey WHERE survey.periode_survey > CURRENT_DATE()";
            } else if ($id == 1) {
                $sql = "SELECT *, CURRENT_DATE() FROM survey WHERE CURRENT_DATE() BETWEEN survey.periode_survey AND survey.periode_survey_akhir";
            } else {
                $sql = "SELECT *, CURRENT_DATE() FROM survey WHERE survey.periode_survey_akhir > CURRENT_DATE()";
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllSurveyFilterByPeriode($awal, $akhir)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT *, CURRENT_DATE() FROM survey WHERE survey.periode_survey >= ? AND survey.periode_survey_akhir <= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $awal);
            $stmt->bindParam(2, $akhir);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllSurveyFilterByJumlahResponden($jumlah)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT survey.*, IFNULL(COUNT(DISTINCT(responden.id_responden)),0) AS jumlah FROM survey LEFT JOIN pertanyaan ON pertanyaan.id_survey = survey.id_survey LEFT JOIN jawaban ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan LEFT JOIN responden ON responden.id_responden = jawaban.id_responden GROUP by survey.id_survey HAVING IFNULL(COUNT(DISTINCT(responden.id_responden)),0) >= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $jumlah);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $survey = new Survey();
                $survey->setIdSurvey($row['id_survey']);
                $survey->setNamaSurvey($row['nama_survey']);
                $survey->setDeskripsiSurvey($row['deskripsi_survey']);
                $survey->setTargetResponden($row['target_responden']);
                $survey->setPeriodeSurvey($row['periode_survey']);
                $survey->setPeriodeSurveyAkhir($row['periode_survey_akhir']);
                $survey->setIsJawab($row['jumlah']);
                $data->append($survey);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }
}
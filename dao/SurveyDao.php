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
}
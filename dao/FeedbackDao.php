<?php

class FeedbackDao
{

    public function getAllFeedback()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM feedback JOIN user ON user.id_user = feedback.id_user ORDER BY created DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $feedback = new Feedback();
                $feedback->setIdFeedback($row['id_feedback']);
                $feedback->setFeedback($row['feedback']);
                $feedback->setCreated($row['created']);

                $user = new User();
                $user->setIdUser($row['id_user']);
                $user->setNama($row['nama']);
                $user->setNomorTelepon($row['nomor_telepon']);
                $user->setEmail($row['email']);

                $feedback->setUser($user);

                $data->append($feedback);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function insertFeedback(Feedback $data)
    {
        $result = FALSE;
        $user = $data->getUser();
        $feedback = $data->getFeedback();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO feedback(id_user, feedback) VALUES(?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $user);
            $stmt->bindParam(2, $feedback);
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

<?php
/**
 * Created by PhpStorm.
 * User: ACF
* Date: 2/11/2018
* Time: 8:21 PM
*/

class RespondenDao
{
    public function insert_responden(Responden $responden) {
        $result = false;
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction(); //untuk proses Insert, Update, Delete

            $jabatan = $responden->getJabatan();
            $nama_perusahaan = $responden->getNamaPerusahaan();
            $id_user = $responden->getIdUser();

            $query = "INSERT INTO responden (jabatan,nama_perusahaan,id_user)
                  VALUES (?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $jabatan);
            $stmt->bindParam(2, $nama_perusahaan);
            $stmt->bindParam(3, $id_user);
            $result = $stmt->execute();

            $conn->commit(); //untuk proses Insert, Update, Delete
        } catch (PDOException $e) {
            $conn->rollBack(); // untuk proses Insert, Update, Delete
            echo $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function getResponden($id)
    {
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM responden WHERE id_user=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            $row = $stmt->fetch();
            $responden = new Responden();
            $responden->setIdResponden($row['id_responden']);
            $responden->setJabatan($row['jabatan']);
            $responden->setNamaPerusahaan($row['nama_perusahaan']);
            $responden->setIdUser($row['id_user']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $responden;
    }

    public function delete_responden($id) {
        $result = FALSE;
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $query = "DELETE FROM responden where id_user = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $result;
    }
}
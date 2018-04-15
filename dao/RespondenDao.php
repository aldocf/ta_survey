<?php
/**
 * Created by PhpStorm.
 * User: ACF
 * Date: 2/11/2018
 * Time: 8:21 PM
 */

class RespondenDao
{
    public function insert_responden(Responden $responden)
    {
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

    public function delete_responden($id)
    {
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

    public function checkResponden($id)
    {
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM responden WHERE id_user=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            $row = $stmt->rowCount();

            if ($row > 0) {
                $result = TRUE;
            } else {
                $result = FALSE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $result;
    }

    public function updateResponden(Responden $data)
    {
        $result = FALSE;
        $id = $data->getIdUser();
        $jabatan = $data->getJabatan();
        $namaPerusahaan = $data->getNamaPerusahaan();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "UPDATE responden SET jabatan=?, nama_perusahaan=? WHERE id_user=?";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $jabatan);
            $stmt->bindParam(2, $namaPerusahaan);
            $stmt->bindParam(3, $id);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getAllResponden()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM responden JOIN user ON responden.id_user = user.id_user";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $user = new User();
                $user->setIdUser($row['id_user']);
                $user->setNama($row['nama']);
                $user->setNomorTelepon($row['nomor_telepon']);
                $user->setEmail($row['email']);

                $responden = new Responden();
                $responden->setIdResponden($row['id_responden']);
                $responden->setJabatan($row['jabatan']);
                $responden->setNamaPerusahaan($row['nama_perusahaan']);
                $responden->setIdUser($user);

                $data->append($responden);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function getAllRespondenJabatanFilter()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM responden JOIN user ON responden.id_user = user.id_user GROUP BY responden.jabatan";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $user = new User();
                $user->setIdUser($row['id_user']);
                $user->setNama($row['nama']);
                $user->setNomorTelepon($row['nomor_telepon']);
                $user->setEmail($row['email']);

                $responden = new Responden();
                $responden->setIdResponden($row['id_responden']);
                $responden->setJabatan($row['jabatan']);
                $responden->setNamaPerusahaan($row['nama_perusahaan']);
                $responden->setIdUser($user);

                $data->append($responden);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }
}
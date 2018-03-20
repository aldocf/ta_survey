<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 3/18/2018
 * Time: 3:24 PM
 */

class PilihanDao
{
    public function insertPilihan(Pilihan $data)
    {
        $result = FALSE;
        $pertanyaan = $data->getPertanyaan();
        $pilihan = $data->getPilihan();
        $lainnya = $data->getisLainnya();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO pilihan(id_pertanyaan, pilihan, is_lainnya) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $pertanyaan);
            $stmt->bindParam(2, $pilihan);
            $stmt->bindParam(3, $lainnya);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getPilihanPertanyaan($id)
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM pilihan WHERE id_pertanyaan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $pilihan = new Pilihan();
                $pilihan->setIdPilihan($row['id_pilihan']);
                $pilihan->setPertanyaan($row['id_pertanyaan']);
                $pilihan->setPilihan($row['pilihan']);
                $pilihan->setIsLainnya($row['is_lainnya']);
                $data->append($pilihan);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }
}
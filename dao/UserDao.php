<?php

class UserDao
{

    public function login(User $data)
    {
        $login_result = FALSE;

        $email = $data->getEmail();
        $password = $data->getPassword();
        $status = 1;

        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE email=? AND password = MD5(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $password);
//            $stmt->bindParam(3, $status);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {//ada datanya
                while ($row = $stmt->fetch()) {
                    $_SESSION['is_logged_admin'] = TRUE;
                    $_SESSION['id_user'] = $row['id_user'];
                    $_SESSION['nama_user'] = $row['nama'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['role'] = $row['role'];
                    $login_result = TRUE;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $login_result;
    }

    public function getAllAdmin()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE role = 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $user = new User();
                $user->setIdUser($row['id_user']);
                $user->setNama($row['nama']);
                $user->setNomorTelepon($row['nomor_telepon']);
                $user->setEmail($row['email']);
                $data->append($user);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $data;
    }

    public function checkEmail($email)
    {
        $result = TRUE;
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {//ada datanya
                $result = FALSE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }


    public function insertAdmin(User $data)
    {
        $result = FALSE;
        $nama = $data->getNama();
        $email = $data->getEmail();
        $telepon = $data->getNomorTelepon();
        $password = $data->getPassword();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO user(nama, nomor_telepon, email, password, role, status) VALUES(?,?,?,MD5(?),1,1)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $telepon);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getUser($id)
    {
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE id_user=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);

            $stmt->execute();
            $row = $stmt->fetch();
            $user = new User();
            $user->setIdUser($row['id_user']);
            $user->setNama($row['nama']);
            $user->setNomorTelepon($row['nomor_telepon']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $conn = null;
        return $user;
    }

}

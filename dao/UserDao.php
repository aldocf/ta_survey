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
            $sql = "SELECT * FROM user WHERE email=? AND password = MD5(?) AND status = 1";
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

    public function register(User $data)
    {
        $result = FALSE;
        $nama = $data->getNama();
        $email = $data->getEmail();
        $telepon = $data->getNomorTelepon();
        $password = $data->getPassword();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO user(nama, nomor_telepon, email, password, role, status) VALUES(?,?,?,MD5(?),0,0)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $telepon);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);
            $stmt->execute();
            require 'sendMail.php';
            if (sendEmail($email, $nama)) {
                $conn->commit();
                $result = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function activation($email)
    {
        $result = false;
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "UPDATE user SET status = 1 WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {//ada datanya
                $result = TRUE;
                $conn->commit();
            }
        } catch (PDOException $e) {
            $result = false;
            $conn->rollBack();
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function updateMember(User $data)
    {
        $result = FALSE;
        $id = $data->getIdUser();
        $nama = $data->getNama();
        $email = $data->getEmail();
        $telepon = $data->getNomorTelepon();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "UPDATE user SET nama=?, nomor_telepon=?, email=? WHERE id_user=?";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $telepon);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $id);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function checkPassword($id, $password)
    {
        $result = TRUE;
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE password=MD5(?) AND id_user=?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $password);
            $stmt->bindParam(2, $id);
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

    public function updatePassword($id, $password)
    {
        $result = FALSE;
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "UPDATE user SET password=MD5(?) WHERE id_user=?";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $password);
            $stmt->bindParam(2, $id);
            $stmt->execute();
            $conn->commit();
            $result = TRUE;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }

    public function getAllMember()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user LEFT JOIN responden ON responden.id_user = user.id_user WHERE user.role = 0";
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

    public function getUserResponden(User $data)
    {
        $nama = $data->getNama();
        $email = $data->getEmail();
        $telepon = $data->getNomorTelepon();
        $password = $data->getPassword();

        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user WHERE nama=? AND nomor_telepon=? AND email=? AND password=MD5(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $nama);
            $stmt->bindParam(2, $telepon);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $password);

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

    public function insertMember(User $data)
    {
        $result = FALSE;
        $nama = $data->getNama();
        $email = $data->getEmail();
        $telepon = $data->getNomorTelepon();
        $password = $data->getPassword();
        try {
            $conn = Koneksi::get_koneksi();
            $conn->beginTransaction();
            $sql = "INSERT INTO user(nama, nomor_telepon, email, password, role, status) VALUES(?,?,?,MD5(?),0,1)";
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

    public function getAllMemberDiDaftarkan()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user LEFT JOIN responden ON responden.id_user = user.id_user WHERE user.role = 0 AND responden.id_responden IS NOT NULL";
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

    public function getAllMemberTidakDiDaftarkan()
    {
        $data = new ArrayObject();
        try {
            $conn = Koneksi::get_koneksi();
            $sql = "SELECT * FROM user LEFT JOIN responden ON responden.id_user = user.id_user WHERE user.role = 0 AND responden.id_responden IS NULL";
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

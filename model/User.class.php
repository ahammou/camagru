<?php

class User extends Manager {

	public function add($p) {
		$sql = 'INSERT INTO `camagru`.`users` (`fname`, `lname`, `email`, `login`, `pass`) '.
			'VALUES (?, ?, ?, ?, ?)';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$p['pass'] = password_hash($p['pass'], PASSWORD_DEFAULT);
		$stmt->execute([$p['fname'], $p['lname'], $p['email'], $p['login'], $p['pass']]);

		$conn = NULL;
	}

	function emailExists($email) {
		$sql = 'SELECT count(`email`) FROM `camagru`.`users` WHERE `email`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$email]);
		$total = $stmt->fetchColumn();
	
		$conn = NULL;
		if ($total == 1)
			return TRUE;
		return FALSE;
	}

	function usernameExists($login) {
		$sql = 'SELECT count(`login`) FROM `camagru`.`users` WHERE `login`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$login]);
		$total = $stmt->fetchColumn();
	
		$conn = NULL;
		if ($total == 1)
			return TRUE;
		return FALSE;
	}

	public function rm($id) {
		$sql = 'DELETE FROM `camagru`.`users` WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id]);

		$conn = NULL;
	}

	/****************************** SETTERS ******************************/

	public function editFirstName($id, $fname) {
		$sql = 'UPDATE `camagru`.`users` SET `fname`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$fname, $id]);

		$conn = NULL;
	}

	public function editLastName($id, $lname) {
		$sql = 'UPDATE `camagru`.`users` SET `lname`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$lname, $id]);

		$conn = NULL;
	}

	public function editEmail($id, $email) {
		$sql = 'UPDATE `camagru`.`users` SET `email`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$email, $id]);

		$conn = NULL;
	}

	public function editUsername($id, $login) {
		$post = new Post;
		$like = new Like;
		$cmt = new Comment;

		$sql = 'UPDATE `camagru`.`users` SET `login`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
		$stmt->execute([$login, $id]);
		$this->enableFKchecks($conn);
		$conn = NULL;

		$post->editUser($_SESSION['login'], $login);
		$like->editUser($_SESSION['login'], $login);
		$cmt->editUser($_SESSION['login'], $login);
	}

	public function editPassword($id, $pass) {
		$sql = 'UPDATE `camagru`.`users` SET `pass`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$stmt->execute([$pass, $id]);

		$conn = NULL;
	}
	
	public function editNotifications($id, $notif) {
		$sql = 'UPDATE `camagru`.`users` SET `e_notif`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$notif, $id]);

		$conn = NULL;
	}

	public function activate($p) {
		$sql = 'UPDATE `camagru`.`users` SET `active`=? WHERE `email`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$p['active'], $p['email']]);

		$conn = NULL;
	}
	
	public function editAdmin($id, $adm) {
		$sql = 'UPDATE `camagru`.`users` SET `admin`=? WHERE `id_user`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$adm, $id]);

		$conn = NULL;
	}

	/****************************** GETTERS ******************************/

	public function getUsers() {
		$sql = 'SELECT * FROM `camagru`.`users`';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();

		$conn = NULL;
        return $res;
	}

	public function getById($id) {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `id_user`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

	public function getByFirstname($fname) {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `fname`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([$fname]);
        $res = $stmt->fetchAll();

		$conn = NULL;
        return $res;
	}

	public function getByLastname($lname) {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `lname`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([$lname]);
        $res = $stmt->fetchAll();

		$conn = NULL;
        return $res;
	}

	public function getByUsername($login) {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `login`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([$login]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
	}

	public function getByEmail($email) {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `email`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
	}

	public function getAdmins() {
		$sql = 'SELECT * FROM `camagru`.`users` WHERE `admin`=?';
        $conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
        $stmt->execute([1]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
	}
}
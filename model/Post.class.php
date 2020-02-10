<?php

class Post extends Manager {

    public function addPost($p) {
        $sql = 'INSERT INTO `camagru`.`posts` (`user`, `photo`, `thumb`) '.
            'VALUES (?, ?, ?)';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$p['user'], $p['photo'], $p['thumb']]);
        $this->enableFKchecks($conn);

		$conn = NULL;
    }

    public function rmPost($id) {
        $like = new Like;
        $cmt = new Comment;

		$sql = 'DELETE FROM `camagru`.`posts` WHERE id_post=?';
		$conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $this->enableFKchecks($conn);
        
        $conn = NULL;
        $like->rmLikes($id);
		$cmt->rmComments($id);
    }

    /****************************** GETTERS ******************************/

    public function getTotalPosts() {
        $sql = 'SELECT COUNT(`id_post`) FROM `camagru`.`posts`';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $conn = NULL;
        return $total;
    }

    public function getPost($id) {
        $sql = 'SELECT * FROM `camagru`.`posts` WHERE `id_post`=?';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function getUserFirstPosts($user) {
        $sql = 'SELECT * FROM `camagru`.`posts` WHERE `user`=? '.
            'ORDER BY `creation_date` DESC LIMIT 5';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function getUserPagePosts($user, $offset, $recordsPerPage) {
        $sql = 'SELECT * FROM `camagru`.`posts` WHERE `user`=? '.
            'ORDER BY `creation_date` DESC LIMIT ?, ?';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $user, PDO::PARAM_STR);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->bindValue(3, $recordsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function getFirstPosts() {
        $sql = 'SELECT * FROM `camagru`.`posts` ORDER BY `creation_date` DESC '.
            'LIMIT 5';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function getPagePosts($offset, $recordsPerPage) {
        $sql = 'SELECT * FROM `camagru`.`posts` ORDER BY `creation_date` DESC '.
            'LIMIT ?, ?';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $recordsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function getAllPosts() {
        $sql = 'SELECT * FROM `camagru`.`posts` ORDER BY `creation_date` DESC';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    /****************************** SETTERS ******************************/

	public function editUser($old, $new) {
		$sql = 'UPDATE `camagru`.`posts` SET `user`=? WHERE `user`=?';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
		$stmt->execute([$new, $old]);
        $this->enableFKchecks($conn);

		$conn = NULL;
	}
}
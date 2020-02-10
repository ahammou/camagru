<?php

class Comment extends Manager {

    public function addComment($p) {
        $sql = 'INSERT INTO `camagru`.`comments` (`id_post`, `user`, `comment`) '.
            'VALUES (?, ?, ?)';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$p['id_post'], $p['user'], $p['comment']]);
        $this->enableFKchecks($conn);

		$conn = NULL;
    }

    public function getTotalComments($id) {
        $sql = 'SELECT COUNT(`id_comment`) FROM `camagru`.`comments` '.
            'WHERE `id_post`=?';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $total = $stmt->fetchColumn();

        $conn = NULL;
        return $total;
    }

    public function getComments($id) {
        $sql = 'SELECT `user`, `comment`, `creation_date` FROM `camagru`.`comments` '.
            'WHERE `id_post`=?';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function rmComments($id) {        
        $sql = 'DELETE FROM `camagru`.`comments` WHERE `id_post`=?';
		$conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id]);
        $this->enableFKchecks($conn);
        
        $conn = NULL;
    }

    /****************************** SETTERS ******************************/

	public function editUser($old, $new) {
		$sql = 'UPDATE `camagru`.`comments` SET `user`=? WHERE `user`=?';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
		$stmt->execute([$new, $old]);
        $this->enableFKchecks($conn);

		$conn = NULL;
	}
}
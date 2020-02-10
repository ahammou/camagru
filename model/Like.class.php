<?php

class Like extends Manager {

    public function addLike($p) {
        $sql = 'INSERT INTO `camagru`.`likes` (`id_post`, `user`) VALUES (?, ?)';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$p['id_post'], $p['user']]);
        $this->enableFKchecks($conn);

		$conn = NULL;
    }

    public function getTotalLikes($id) {
        $sql = 'SELECT COUNT(`id_like`) FROM `camagru`.`likes` WHERE `id_post`=?';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $total = $stmt->fetchColumn();

        $conn = NULL;
        return $total;
    }

    public function didUserLiked($id, $user) {
        $sql = 'SELECT COUNT(`id_like`) FROM `camagru`.`likes` '.
            'WHERE `id_post`=? AND `user`=?';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $user]);
        $total = $stmt->fetchColumn();

        $conn = NULL;
        return $total;
    }

    public function getLikesUsers($id) {
        $sql = 'SELECT `user` FROM `camagru`.`likes` WHERE `id_post`=?';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function rmLike($id, $user) {
        $sql = 'DELETE FROM `camagru`.`likes` WHERE `id_post`=? AND `user`=?';
		$conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
        $stmt->execute([$id, $user]);
        $this->enableFKchecks($conn);
        
        $conn = NULL;
    }

    public function rmLikes($id) {
        $sql = 'DELETE FROM `camagru`.`likes` WHERE `id_post`=?';
		$conn = $this->connectDB();
        $this->disableFKchecks($conn);
		$stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $this->enableFKchecks($conn);
        
        $conn = NULL;
    }

    /****************************** SETTERS ******************************/

    public function editUser($old, $new) {
        $sql = 'UPDATE `camagru`.`likes` SET `user`=? WHERE `user`=?';
        $conn = $this->connectDB();
        $this->disableFKchecks($conn);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$new, $old]);
        $this->enableFKchecks($conn);

        $conn = NULL;
    }
}
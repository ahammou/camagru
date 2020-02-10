<?php

class Frame extends Manager {

    public function addFrame($p) {
        $sql = 'INSERT INTO `camagru`.`frames` (`frame`, `fr_path`) VALUES (?, ?)';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute([$p['frame'], $p['fr_path']]);

        $conn = NULL;
    }

    public function getTotalFrames() {
        $sql = 'SELECT COUNT(`id_frame`) FROM `camagru`.`frames`';
		$conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $conn = NULL;
        return $total;
    }

    public function getAllFrames() {
        $sql = 'SELECT `frame`, `fr_path` FROM `camagru`.`frames`';
        $conn = $this->connectDB();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$conn = NULL;
        return $res;
    }

    public function rmFrame($id) {
        $sql = 'DELETE FROM `camagru`.`frames` WHERE `id_frame`=?';
		$conn = $this->connectDB();
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id]);

		$conn = NULL;
    }
}
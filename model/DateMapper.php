<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class DateMapper
*
* Database interface for Date entities
*
* @author lipido <lipido@gmail.com>
*/
class DateMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves an array of Date into the database
	*
	* @param Date[] $dates The dates to be saved
	* @param int $idpoll The id of the poll which dates belong
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($dates, $idpoll) {
    $dates_list = explode(".", $dates);
    $this->db->beginTransaction();
    $stmt = $this->db->prepare("INSERT INTO dates (date, hini, hend, id_poll) values (?,?,?,?)");
    for ( $i = 0, $l = count($dates_list); $i < $l-1; $i++ ) {
      $v_date = explode("/", $dates_list[$i]);
      $stmt->execute(array($v_date[0], $v_date[1], $v_date[2], $idpoll));
    }
    $this->db->commit();
	}


	public function removeDates($dates) {
    $dates_list = explode(",", $dates);
    $this->db->beginTransaction();
    $stmt = $this->db->prepare("DELETE FROM dates WHERE id = ?");
    for ( $i = 0, $l = count($dates_list); $i < $l; $i++ ) {
      $stmt->execute(array($dates_list[$i]));
    }
    $this->db->commit();
	}

  /**
	* Loads a Poll from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findByPoll($pollId){
		$stmt = $this->db->prepare("SELECT * FROM dates WHERE id_poll=? ORDER BY date, hini, hend ");
		$stmt->execute(array($pollId));
		$poll_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($poll_dates != null) {
			$dates = array();
      foreach ($poll_dates as $date) {
				array_push($dates, new Date(
  			$date["id"],
  			$date["date"],
  			$date["hini"],
        $date["hend"],
        $date["votes"],
        $date["id_poll"]));
  		}
			return $dates;
		} else {
			return [];
		}
	}

	/**
	* Loads a Poll from the database given its id
	*
	* Note: Comments are not added to the Post
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Post is not found
	*/
	public function findUsersDates($pollId){
		$stmt = $this->db->prepare("SELECT d.id_user, d.id_dates, u.name FROM users_dates d JOIN users_polls p ON d.id_user=p.id_user JOIN users u ON u.id=d.id_user AND p.id_poll=?");
		$stmt->execute(array($pollId));
		$poll_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($poll_dates != null) {
			$dates = array();
			foreach ($poll_dates as $date) {
				if(array_key_exists($date["id_dates"], $dates)){
					$dates[$date["id_dates"]][$date["id_user"]] = $date["name"];
				}else{
					$dates[$date["id_dates"]] = array($date["id_user"] => $date["name"]);
				}

			}
			return $dates;
		} else {
			return [];
		}
	}

	public function updateVotes($dates, $idUser, $idpoll){
		$dates_list = explode(",", $dates);
    $this->db->beginTransaction();
		$delete = $this->db->prepare("DELETE from users_dates WHERE id_user=?");
		$delete->execute(array($idUser));
		$stmt = $this->db->prepare("INSERT INTO users_dates (id_user, id_dates) values (?,?)");
    for ( $i = 0, $l = count($dates_list); $i < $l; $i++ ) {
			if($dates_list[$i] != ''){
				$stmt->execute(array($idUser,$dates_list[$i]));
			}
    }
		if($this->db->commit()){
			$this->countVotes($idpoll);
		}
	}

	public function updateMostVoteDay($idpoll){
		$this->countVotes($idpoll);
	}

	private function countVotes($idpoll){
		$stmt = $this->db->prepare("SELECT d.id FROM users_dates ud JOIN dates d ON d.id=ud.id_dates AND d.id_poll=?");
		$stmt->execute(array($idpoll));
		$votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stmt = $this->db->prepare("SELECT id, votes FROM dates WHERE id_poll=?");
		$stmt->execute(array($idpoll));
		$days = $stmt->fetchAll(PDO::FETCH_ASSOC);


		if($votes != null) {
			$day_votes = array();
      foreach ($days as $day) {
				$day_votes[$day["id"]] = $day["votes"];
				$count_votes = 0;
				foreach ($votes as $vote) {
					if($day["id"] == $vote["id"]){
						$count_votes++;
					}
				}
				if($day["votes"] > $count_votes){
					$day_votes[$day["id"]]--;

				}else if($day["votes"] < $count_votes){
					$day_votes[$day["id"]]++;
				}
			}

		}
		$this->db->beginTransaction();
		$update = $this->db->prepare("UPDATE dates SET votes = ? WHERE id = ?");
    foreach ($day_votes as $key => $value) {
				$update->execute(array($value,$key));
    }
		if($this->db->commit()){
			$this->changePollMostVotedDay($idpoll);
		}

	}

	private function changePollMostVotedDay($idpoll){
		$stmt = $this->db->prepare("SELECT date, hini, hend FROM dates WHERE id_poll=? ORDER BY votes DESC, date, hini, hend");
		$stmt->execute(array($idpoll));
		$days = $stmt->fetch(PDO::FETCH_ASSOC);
		$hours = substr($days["hini"],0,-3)." ".substr($days["hend"],0,-3);
		$update = $this->db->prepare("UPDATE polls SET date = ?, hours= ? WHERE id = ?");
		$update->execute(array($days["date"], $hours, $idpoll));
	}

	public function addDates($dates, $idpoll) {
    $dates_list = explode(".", $dates);
    $this->db->beginTransaction();
    $stmt = $this->db->prepare("INSERT INTO dates (date, hini, hend, id_poll) values (?,?,?,?)");
    for ( $i = 0, $l = count($dates_list); $i < $l; $i++ ) {
      $v_date = explode("/", $dates_list[$i]);
      $stmt->execute(array($v_date[0], $v_date[1], $v_date[2], $idpoll));
    }
    $this->db->commit();
	}

}

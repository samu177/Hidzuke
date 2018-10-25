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
		$stmt = $this->db->prepare("SELECT * FROM dates WHERE id_poll=?");
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

	public function updateVotes($dates, $idUser){
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
    $this->db->commit();
	}

}

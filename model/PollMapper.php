<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class PollMapper
*
* Database interface for Poll entities
*
* @author lipido <lipido@gmail.com>
*/
class PollMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a Poll into the database
	*
	* @param Poll $poll The poll to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($poll,$userId) {
		$stmt = $this->db->prepare("INSERT INTO polls (title, description, link, id_user) values (?,?,?,?)");
		$result = $stmt->execute(array($poll->getTitle(), $poll->getDescription(), $poll->getLink(), $userId));
		if($result){
			$stmt = $this->db->prepare("SELECT id FROM polls WHERE link = ?");
			$stmt->execute(array($poll->getLink()));
			$pollId = $stmt->fetch(PDO::FETCH_ASSOC);

			if($pollId != null) {
				$stmt = $this->db->prepare("INSERT INTO users_polls (id_user, id_poll) values (?,?)");
				$result = $stmt->execute(array($userId,$pollId['id']));
				return $pollId['id'];
			} else {
				return -1;
			}
		}
		return -1;
	}

  /**
	* Delete a Poll into the database
	*
	* @param Poll $poll The poll to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
  public function delete(Poll $poll){
    $stmt = $this->db->prepare("DELETE from poll WHERE id=?");
		$stmt->execute(array($poll->getId()));
  }

  /**
	* Update a Poll into the database
	*
	* @param Poll $poll The poll to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
  public function update(Poll $poll){
    $stmt = $this->db->prepare("UPDATE poll set title=?, description=? where id=?");
    $stmt->execute(array($poll->getTitle(), $poll->getDescription(), $poll->getId()));
  }

  /**
	* Loads a Poll from the database given its id
	*
	* Note: Comments are not added to the Poll
	*
	* @throws PDOException if a database error occurs
	* @return Post The Post instances (without comments). NULL
	* if the Poll is not found
	*/
	public function findById($pollid){
		$stmt = $this->db->prepare("SELECT * FROM polls WHERE id=?");
		$stmt->execute(array($pollid));
		$poll = $stmt->fetch(PDO::FETCH_ASSOC);

		if($poll != null) {
			return new Poll(
			$poll["id"],
			$poll["title"],
			$poll["description"],
      $poll["link"],
      $poll["id_user"],
			$poll["date"],
			$poll["hours"]);
		} else {
			return NULL;
		}
	}


	/**
	* Checks if a given link is already in the database
	*
	* @param string $link the link to check
	* @return boolean true if the link exists, false otherwise
	*/
	public function pollLinkExists($link) {
		$stmt = $this->db->prepare("SELECT count(title) FROM polls where link=?");
		$stmt->execute(array($link));

		if ($stmt->fetchColumn() > 0) {
			return true;
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
	public function findByUser($userid){
		$stmt = $this->db->prepare("SELECT p.id, p.title, p.description, p.link, p.id_user, p.date FROM polls p JOIN users_polls up ON up.id_user=? and p.id=up.id_poll");
		$stmt->execute(array($userid));
		$polls_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($polls_db != null) {
      $polls = array();
			$polls_owner = array();
      foreach ($polls_db as $poll) {
				if($userid == $poll["id_user"]){
					array_push($polls_owner, new Poll(
	  			$poll["id"],
	  			$poll["title"],
	  			$poll["description"],
	        $poll["link"],
	        $poll["id_user"],
					$poll["date"]));
				}else{
					array_push($polls, new Poll(
	  			$poll["id"],
	  			$poll["title"],
	  			$poll["description"],
	        $poll["link"],
	        $poll["id_user"],
					$poll["date"]));
				}
  		}
			return array_merge($polls_owner , $polls);
		} else {
			return [];
		}
	}
}

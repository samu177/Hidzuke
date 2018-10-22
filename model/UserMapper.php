<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class UserMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO users (name, pwd, mail) values (?,?,?)");
		$stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getMail()));
	}

	/**
	* Checks if a given mail is already in the database
	*
	* @param string $mail the mail to check
	* @return boolean true if the mail exists, false otherwise
	*/
	public function usermailExists($mail) {
		$stmt = $this->db->prepare("SELECT count(name) FROM users where mail=?");
		$stmt->execute(array($mail));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of mail/password exists in the database
	*
	* @param string $mail the mail
	* @param string $passwd the password
	* @return boolean true the mail/password exists, false otherwise.
	*/
	public function isValidUser($mail, $passwd) {
		$stmt = $this->db->prepare("SELECT count(name) FROM users where mail=? and pwd=?");
		$stmt->execute(array($mail, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}

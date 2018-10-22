<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class User {

	/**
	* The id of the user
	* @var int
	*/
	private $id;

	/**
	* The user name of the user
	* @var string
	*/
	private $username;

	/**
	* The password of the user
	* @var string
	*/
	private $passwd;

  /**
	* The mail of the user
	* @var string
	*/
	private $mail;


	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($id=NULL, $username=NULL, $passwd=NULL, $mail=NULL) {
		$this->id = $id;
		$this->username = $username;
		$this->passwd = $passwd;
    $this->mail = $mail;
	}
	/**
	* Gets the id of this user
	*
	* @return int The id of this user
	*/
	public function getId() {
		return $this->id;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getUsername() {
		return $this->username;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getPasswd() {
		return $this->passwd;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setPassword($passwd) {
		$this->passwd = $passwd;
	}

  /**
	* Gets the mail of this user
	*
	* @return string The mail of this user
	*/
	public function getMail() {
		return $this->mail;
	}
	/**
	* Sets the mail of this user
	*
	* @param string $mail The mail of this user
	* @return void
	*/
	public function setMail($mail) {
		$this->mail = $mail;
	}

	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = "Username must be at least 5 characters length";
		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
    if (strlen($this->mail) < 5) {
			$errors["mail"] = "Mail must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}

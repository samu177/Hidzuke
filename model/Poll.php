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
class Poll {

  /**
  * The id of the poll
  * @var int
  */
  private $id;

	/**
	* The title of the poll
	* @var string
	*/
	private $title;

	/**
	* The description of the poll
	* @var string
	*/
	private $description;

  /**
	* The link of the poll
	* @var string
	*/
	private $link;

  /**
  * The id_user of the poll
  * @var int
  */
  private $id_user;

	/**
	* The constructor
	*
	* @param string $title The title of the poll
	* @param string $description The description of the poll
	*/
	public function __construct($id=NULL, $title=NULL, $description=NULL, $link=NULL, $id_user=NULL) {
    $this->id = $id;
    $this->title = $title;
		$this->description = $description;
    $this->link = $link;
    $this->id_user = $id_user;
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
	* Gets the title of this user
	*
	* @return string The title of this user
	*/
	public function getTitle() {
		return $this->title;
	}

	/**
	* Sets the title of this user
	*
	* @param string $title The title of this user
	* @return void
	*/
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	* Gets the description of this user
	*
	* @return string The description of this user
	*/
	public function getDescription() {
		return $this->description;
	}
	/**
	* Sets the description of this user
	*
	* @param string $description The description of this user
	* @return void
	*/
	public function setDescription($description) {
		$this->description = $description;
	}

  /**
	* Gets the link of this user
	*
	* @return string The link of this user
	*/
	public function getLink() {
		return $this->link;
	}
	/**
	* Sets the link of this user
	*
	* @param string $link The link of this user
	* @return void
	*/
	public function setLink($link) {
		$this->link = $link;
	}

  /**
  * Gets the id_user of this user
  *
  * @return int The id_user of this user
  */
  public function getId_user() {
    return $this->id_user;
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
			$errors["title"] = "Title must be at least 5 characters length";
		}
		if (strlen($this->passwd) < 5) {
			$errors["description"] = "Description must be at least 5 characters length";
		}
    if (strlen($this->link) < 5) {
			$errors["link"] = "Link must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "poll is not valid");
		}
	}
}

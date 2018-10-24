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
  * The most voted day of the poll
  * @var date
  */
  private $date;

  /**
  * The most voted hour of the poll
  * @var string
  */
  private $hours;

	/**
	* The constructor
	*
	* @param string $title The title of the poll
	* @param string $description The description of the poll
	*/
	public function __construct($id=NULL, $title=NULL, $description=NULL, $link=NULL, $id_user=NULL, $date=NULL, $hours=NULL) {
    $this->id = $id;
    $this->title = $title;
		$this->description = $description;
    $this->link = $link;
    $this->id_user = $id_user;
    $this->date = ($date != NULL ? new DateTime($date) : NULL);
    $this->hours = $hours;
	}
  /**
	* Gets the id of this poll
	*
	* @return int The id of this poll
	*/
	public function getId() {
		return $this->id;
	}

	/**
	* Gets the title of this poll
	*
	* @return string The title of this poll
	*/
	public function getTitle() {
		return $this->title;
	}

	/**
	* Sets the title of this poll
	*
	* @param string $title The title of this poll
	* @return void
	*/
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	* Gets the description of this poll
	*
	* @return string The description of this poll
	*/
	public function getDescription() {
		return $this->description;
	}
	/**
	* Sets the description of this poll
	*
	* @param string $description The description of this poll
	* @return void
	*/
	public function setDescription($description) {
		$this->description = $description;
	}

  /**
	* Gets the link of this poll
	*
	* @return string The link of this poll
	*/
	public function getLink() {
		return $this->link;
	}
	/**
	* Sets the link of this poll
	*
	* @param string $link The link of this poll
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
  * Gets the most voted day of this poll
  *
  * @return date The most voted day of this poll
  */
  public function getDate() {
    return $this->date;
  }
  /**
  * Sets the most voted day of this poll
  *
  * @param date $link The most voted day of this poll
  * @return void
  */
  public function setDate($date) {
    $this->date = ($date != NULL ? new DateTime($date) : NULL);
  }

  /**
  * Gets the hours of this poll
  *
  * @return string The hours of this poll
  */
  public function getHours() {
    return $this->hours;
  }
  /**
  * Sets the hours of this poll
  *
  * @param string $link The hours of this poll
  * @return void
  */
  public function setHours($hours) {
    $this->hours = $hours;
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
		if (strlen($this->title) < 5) {
			$errors["title"] = "Title must be at least 5 characters length";
		}
		if (strlen($this->description) < 5) {
			$errors["description"] = "Description must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "poll is not valid");
		}
	}
}

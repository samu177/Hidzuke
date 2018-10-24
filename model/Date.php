<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class Date
*
* Represents a Date in the poll
*
* @author lipido <lipido@gmail.com>
*/
class Date {

	/**
	* The id of the date
	* @var int
	*/
	private $id;

	/**
	* The day of the date
	* @var date
	*/
	private $day;

	/**
	* The init hour of the date
	* @var time
	*/
	private $hini;

  /**
	* The end hour of the date
	* @var time
	*/
	private $hend;

  /**
	* The number of votes of the date
	* @var int
	*/
	private $votes;

  /**
  * The id of the poll
  * @var int
  */
  private $id_poll;


	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($id=NULL, $day=NULL, $hini=NULL, $hend=NULL, $votes=NULL, $id_poll=NULL) {
		$this->id = $id;
		$this->day = ($day != NULL ? new DateTime($day) : NULL);
		$this->hini = $hini;
    $this->hend = $hend;
    $this->votes = $votes;
    $this->id_poll = $id_poll;
	}
	/**
	* Gets the id of this date
	*
	* @return int The id of this date
	*/
	public function getId() {
		return $this->id;
	}

	/**
	* Gets the day of this date
	*
	* @return date The day of this date
	*/
	public function getDay() {
		return $this->day;
	}

	/**
	* Sets the day of this date
	*
	* @param date $day The day of this date
	* @return void
	*/
	public function setDay($day) {
		$this->day = ($day != NULL ? new DateTime($day) : NULL);
	}

	/**
	* Gets the init hour of this date
	*
	* @return time The init hour of this date
	*/
	public function getHini() {
		return $this->hini;
	}
	/**
	* Sets the init hour of this date
	*
	* @param time $hini The init hour of this date
	* @return void
	*/
	public function setHini($hini) {
		$this->hini = $hini;
	}

  /**
	* Gets the end hour of this date
	*
	* @return time The end hour of this date
	*/
	public function getHend() {
		return $this->hend;
	}
	/**
	* Sets the end hour of this date
	*
	* @param time $hini The end hour of this date
	* @return void
	*/
	public function setHend($hend) {
		$this->end = $hend;
	}

  /**
	* Gets the number of votes of the date
	*
	* @return int The number of votes of the date
	*/
	public function getVotes() {
		return $this->votes;
	}
	/**
	* Sets the number of votes of the date
	*
	* @param int $votes The number of votes of the date
	* @return void
	*/
	public function setVotes($votes) {
		$this->votes = $votes;
	}

  /**
	* Gets the idpoll of this date
	*
	* @return int The idpoll of this date
	*/
	public function geIdPoll() {
		return $this->id_poll;
	}
}

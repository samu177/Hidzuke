<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../model/Poll.php");
require_once(__DIR__."/../model/PollMapper.php");

require_once(__DIR__."/../model/Date.php");
require_once(__DIR__."/../model/DateMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class PollController
*
* Controller to poll
*
* @author lipido <lipido@gmail.com>
*/
class PollController extends BaseController {

	/**
	* Reference to the pollMapper to interact
	* with the database
	*
	* @var pollMapper
	*/
	private $pollMapper;
	private $dateMapper;

	public function __construct() {
		parent::__construct();

		$this->pollMapper = new PollMapper();
		$this->dateMapper = new DateMapper();

		if(!isset($_SESSION['currentuser'])){
			$this->view->redirect("users", "login");
		}
	}

  /**
	* Action to list posts
	*
	* Loads all the posts from the database.
	* No HTTP parameters are needed.
	*
	* The views are:
	* <ul>
	* <li>posts/index (via include)</li>
	* </ul>
	*/
	public function index() {

    if (!isset($_GET["id"])) {
			throw new Exception("id is mandatory");
		}

		$postid = $_GET["id"];

		// obtain the data from the database
		$poll = $this->pollMapper->findById($postid);
    $dates = $this->dateMapper->findByPoll($postid);

		// put the array containing Post object to the view
		$this->view->setVariable("poll", $poll);
    $this->view->setVariable("dates", $dates);

		// render the view (/view/posts/index.php)
		$this->view->render("polls", "index");
	}

	private function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function add() {
		$poll = new Poll();
		if (isset($_POST["title"])){ // reaching via HTTP Post...
			// populate the Poll object with data form the form
			$poll->setTitle($_POST["title"]);
			$poll->setDescription($_POST["description"]);

			$length = 10;
			$link = $this->generateRandomString($length);
			while($this->pollMapper->pollLinkExists($link)){
				$link = generateRandomString(++$length);
			}
			$poll->setLink($link);
			try{
				$poll->checkIsValidForRegister(); // if it fails, ValidationException

				$idpoll = $this->pollMapper->save($poll,$_SESSION["currentuser"]);

			if ($idpoll != -1){
					// save the Poll object into the database
					print_r($_POST["dates"]);
					$this->dateMapper->save($_POST["dates"],$idpoll);

					// POST-REDIRECT-GET
					// Everything OK, we will redirect the poll to the list of posts
					// We want to see a message after redirection, so we establish
					// a "flash" message (which is simply a Session variable) to be
					// get in the view after redirection.
					//$this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");

					// perform the redirection. More or less:
					// header("Location: index.php?controller=users&action=login")
					// die();
					$this->view->redirect("main", "index");
				}
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
	}
}

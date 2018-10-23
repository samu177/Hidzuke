<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../model/Poll.php");
require_once(__DIR__."/../model/PollMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
* Class MainController
*
* Controller to main, add poll
*
* @author lipido <lipido@gmail.com>
*/
class MainController extends BaseController {

	/**
	* Reference to the UserMapper to interact
	* with the database
	*
	* @var UserMapper
	*/
	private $userMapper;
	private $pollMapper;

	public function __construct() {
		parent::__construct();

		$this->pollMapper = new PollMapper();

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

		// obtain the data from the database
		$polls = $this->pollMapper->findByUser($_SESSION["currentuser"]);

		// put the array containing Post object to the view
		$this->view->setVariable("polls", $polls);

		// render the view (/view/posts/index.php)
		$this->view->render("main", "index");
	}

	public function add() {
		if (isset($_POST["title"])){ // reaching via HTTP Post...
			print_r($_POST["dates"]);
		}
	}



}

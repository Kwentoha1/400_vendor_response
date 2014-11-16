<?php
class User{

	private static $userId;
	private static $ceo;
	private static $contact;
	private static $email;
	private static $companyName;
	private static $phoneNum;
	private static $responses; 


	/* Queries database for the logged in vendors information
	   and displays that information to the user on their homepage.
	   These fields will also be used to (partially) automatically 
	   fill out any RFPs the vendor wants to respond to
	*/

	public function __construct($uId){
		//connect to mongo
		$db = Database::getDB(); 
		//Access user collection
		$user_collection = $db->users;


		//Parameters for find -- Get only the userdoc for this user
		$arguments = array("userId"=>$uId);
		//This is get 1 user document
		$user_cursor = $user_collection->find($arguments);

		//Make sure there is exactly one response
		if( $user_cursor->count() == 0 ){
			echo "There is no user with that ID in the database";
		}elseif( $user_cursor->count() > 1 ){
			echo "More than 1 user in database... please fix";
		}elseif( $user_cursor->count() == 1){

			$user = $user_cursor->getNext();

			self::$userId = $user["userId"];
			self::$ceo = $user["ceo"];
			self::$contact = $user["contact"]; 
			self::$email = $user["email"]; 
			self::$companyName = $user["companyName"];
			self::$phoneNum = $user["phonenum"];
		}
	}


	/* getRFPresponses takes the vendors id as an arugment
	   it gets a connection to the database
	   connects to the response collection and finds all response documents associated with vendor
	   It then get the associated rfp number of each of those responses and creates and array.
	   Using the array of rfp ids, it goes into the rfp collection of the database and 
	   gets each of those rfps to display to the vendor on the vendors home page.
	*/
	public static function getRFPresponses($userId){
		$db = Database::getDB(); 
		//Access responses collection
		$response_collection = $db->responses;

		//Find all responses in the database for this vendor
		$vendorId = array("userId"=>$userId); //To convert to acceptable query format
		$response_cursor = $response_collection->find($vendorId);

		//Place all of the RFP ids this vendor responded to in an array
		$rfpIds = []; 
		foreach($response_cursor as $response){
			array_push($rfpIds, $response["associatedRFP"]);
		}

		$rfp_collection = $db->rfps;

		$vendorResponses = [];
		foreach($rfpIds as $id){
			$searchParam = array("rfpNum"=>$id);
			$rfp_cursor = $rfp_collection->find($searchParam);
			array_push($vendorResponses, $rfp_cursor->getNext());
		}

		return $vendorResponses;
	}


	/*getResponseTable($responses) is used in conjunction with getRFPresponses($vendorId). 
	It takes, as an argument, all of the RFPs a Vendor has responded to and creates a table 
	based on those values.
	It is included in the user_db.php file to keep the html pages less cluttered
	*/
	public static function getResponseTable($rfps){

		$responseTable = '<table class="table">' . "\n";
		for($i=0; $i < count($rfps); $i++){
			$responseTable .= "\t\t\t<tr>" . 
			                          "<td>" . $rfps[$i]["rfpNum"] . "</td>" .
			                           "<td>" . $rfps[$i]["title"] . "</td>" .
			                          	 "<td>" . $rfps[$i]["purpose"] . "</td>" .
			                          	  "<td>" . $rfps[$i]["podiumType"] . "</td>" .
			                          	   "<td>" . $rfps[$i]["projection"] . "</td>" .
			                          	    "<td>" . $rfps[$i]["seats"] . "</td>" .
			                          	     "<td>" . $rfps[$i]["budget"] . "</td></tr>\n";
		}
		$responseTable .= "\t\t</table>";

		return $responseTable;
	}



	/* Getter methods */
	public static function getUserId(){
		return self::$userId;
	}
	public static function getUserCEO(){
		return self::$ceo;
	}
	public static function getCompanyName(){
		return self::$companyName;
	}
	public static function getUserContact(){
		return self::$contact;
	}
	public static function getUserEmail(){
		return self::$email;
	}
	public static function getPhoneNumber(){
		return self::$phoneNum;
	}
}
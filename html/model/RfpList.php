<?php
	class RfpList{
		private static $rfps; 

		public function __construct(){

			//Connect to database and get a cursor pointing to first doc
			$db = Database::getDB();
   	 		$rfp_collection = $db->rfps;
    		$rfp_cursor = $rfp_collection->find(); 
    		
    		//Store each document in the $rfps array and return to calling function
    		$rfps = [];

    		foreach($rfp_cursor as $rfp){
    		  array_push($rfps, $rfp); 
    		}

    		self::$rfps = $rfps;


		}


	/*getResponseTable($responses) is used in conjunction with getRFPresponses($vendorId). 
	It takes, as an argument, all of the RFPs a Vendor has responded to and creates a table 
	based on those values.
	It is included in the user_db.php file to keep the html pages less cluttered
	*/
	public static function getRfpTable(){

		
		echo count(self::$rfps);

		$responseTable = '<table class="table">' . "\n";
		for($i=0; $i < count(self::$rfps); $i++){
			$responseTable .= "\t\t\t<tr>" . 
			                          "<td>" . self::$rfps[$i]["rfpNum"] . "</td>" .
			                           "<td>" . self::$rfps[$i]["title"] . "</td>" .
			                          	 "<td>" . self::$rfps[$i]["purpose"] . "</td>" .
			                          	  "<td>" . self::$rfps[$i]["podiumType"] . "</td>" .
			                          	   "<td>" . self::$rfps[$i]["projection"] . "</td>" .
			                          	    "<td>" . self::$rfps[$i]["seats"] . "</td>" .
			                          	     "<td>" . self::$rfps[$i]["budget"] . "</td>" . 
			                          	      '<td> <form class="respond" action="." method="GET">' .
			                          	               '<input type="hidden" name="action" value="respondToRequest">' .
			                          	               '<input type="hidden" name="rfp" value="' . self::$rfps[$i]["rfpNum"] . '">' .
			                          	               '<input class="btn btn-default" type="submit" value="Respond">' .
			                          	        '</form></td>' . "</tr>\n";


			                          	     
		}
		$responseTable .= "\t\t</table>";

		return $responseTable;
	}

		/* getActiveRfps() queries the database for all rfp documents. 
		It returns an array which holds each document
		*/
		public static function getActiveRfps(){
    		return self::$rfps;
		}

	}
?>
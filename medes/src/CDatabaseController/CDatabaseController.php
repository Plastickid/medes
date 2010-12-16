<?php
// ===========================================================================================
//
// File: CDatabaseController.php
//
// Description: Interface to store data in a database.
//
// Author: Mikael Roos
//
// History:
// 2010-12-14: Created
//

class CDatabaseController implements ISingleton {

	// ------------------------------------------------------------------------------------
	//
	// Internal variables
	//
  protected static $instance = null;
	protected static $db;
	
	
	// ------------------------------------------------------------------------------------
	//
	// Constructor
	//
	public function __construct() {
    $pp = CPrinceOfPersia::GetInstance(); 
    self::$db = new PDO("sqlite:{$pp->installPath}/medes/data/CDatabaseController.db");
    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}
	
	
	// ------------------------------------------------------------------------------------
	//
	// Destructor
	//
	public function __destruct() {;}
	

	// ------------------------------------------------------------------------------------
	//
	// Singleton, get the instance through this method. 
	//
  public static function GetInstance(){
    if(self::$instance == null)
      self::$instance = new CDatabaseController();
    return self::$instance;
  }


	// ------------------------------------------------------------------------------------
	//
  // Execute pre-defined (or own-defined) select-query with arguments and return the
  // resultset.
	//
  public function ExecuteSelectQueryAndFetchAll($aQuery, $aParams=array()){
    $stmt = self::$db->prepare($aQuery);
    
    if(isset($_GET['debug'])) {
    	echo $stmt->debugDumpParams();
    }
    
    $stmt->execute($aParams);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


	// ------------------------------------------------------------------------------------
	//
  // Execute pre-defined (or own-defined) select-query with arguments, ignore the
  // resultset (if any).
	//
  public function ExecuteQuery($aQuery, $aParams=array()) {
		echo "<p>", $aQuery;
    $stmt = self::$db->prepare($aQuery);

    if(isset($_GET['debug'])) {
    	echo $stmt->debugDumpParams();
    }
    
    $stmt->execute($aParams);
  }

}

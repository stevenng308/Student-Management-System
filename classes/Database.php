<?php
//Class handling Database connection and querying it
//Author: Steven Ng forked from Yaw Agyepong
class Database
{
	private $dbHOST = "localhost";
    private $dbUSER = "root";
    private $dbPASS = "";//"cselab29";
    private $dbNAME = "sms";
    private $db_connection;
	
	public function __construct() {
		$this->db_connection = mysql_connect($this->dbHOST, $this->dbUSER, $this->dbPASS) or die(mysql_error());
        mysql_select_db($this->dbNAME) or die("Database connection error. Please check if the database is operational or if your connection is faulty.");
	}	
	
	public function __destruct() {
		mysql_close($this->db_connection);
    }
	
	public function insert($data)
	{
		// Search for user by firstname, lastname, & password to ensure no previous match before insertion
		$query_initial = mysql_query("SELECT * FROM member WHERE email = '". mysql_real_escape_string($data['email']) ."';");
		$result = mysql_fetch_array($query_initial);
		if(empty($result)){
			$password = $data['password'];
			$hash = hash('sha256', $password);
			function createSalt()
			{
				$text = md5(uniqid(rand(), true));
				return substr($text, 0, 3);
			}
			$salt = createSalt();
			//while (true)
			//echo $salt;
			$password = hash('sha256', $salt . $hash);
			$query = "INSERT INTO member (firstname, lastname, password, email, salt) VALUES ('". mysql_real_escape_string($data['firstname']) ."', '". mysql_real_escape_string($data['lastname']) ."', '". $password ."', '". mysql_real_escape_string($data['email']) ."', '". $salt ."');";
			
			mysql_query($query);
			//while (true)
			//echo $salt;
		}
	}
	
	public function runQuery($query)
	{
		$queryResult = mysql_query($query);
		if ($queryResult)
		{
			return $queryResult;
		}
		else
		{
			echo "<p>", mysql_error($this->db_connection), "</p>";
            return false;
		}
	}
	
	public function twitterLogin($data, $token)
	{	
		// Let's find the user by its ID
		$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $data->id);
		$result = mysql_fetch_array($query);

		// If not, let's add it to the database
		if(empty($result)){
		//echo 'hello1';
			$query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret) VALUES ('twitter', {$data->id}, '{$data->screen_name}', '{$token['oauth_token']}', '{$token['oauth_token_secret']}')");
			$query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());
			$result = mysql_fetch_array($query);
		} else {
		//echo 'hello2';
			// Update the tokens
			$query = mysql_query("UPDATE users SET oauth_token = '{$token['oauth_token']}', oauth_secret = '{$token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$data->id}");
		}

		session_regenerate_id();
		$_SESSION['sess_user_id'] = $result['id'];
		$_SESSION['sess_username'] = $result['username'];
		$_SESSION['oauth_uid'] = $result['oauth_uid'];
		$_SESSION['oauth_provider'] = $result['oauth_provider'];
		$_SESSION['oauth_token'] = $result['oauth_token'];
		$_SESSION['oauth_secret'] = $result['oauth_secret'];
		session_write_close();
		
		//echo $_SESSION['sess_user_id'];
		header('Location: ../index.php');
	}
}
?>
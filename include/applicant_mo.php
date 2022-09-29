<?php
require_once(LIB_PATH . DS . 'database_mo.php');
class Applicants_mo
{
	protected static  $tblname = "mo_user";

	function dbfields()
	{
		global $mydb_mo;
		return $mydb_mo->getfieldsononetable(self::$tblname);
	}
	function listofapplicant()
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM " . self::$tblname);
		$cur = $mydb_mo->loadResultList();
		return $cur;
	}
	function find_applicant($id = "", $name = "")
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM " . self::$tblname . " 
			WHERE APPLICANTID = {$id} OR Lastname = '{$name}'");
		$cur = $mydb_mo->executeQuery();
		$row_count = $mydb_mo->num_rows($cur);
		return $row_count;
	}

	function find_all_applicant($lname = "", $Firstname = "", $mname = "")
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM " . self::$tblname . " 
			WHERE LNAME = '{$lname}' AND FNAME= '{$Firstname}' AND MNAME='{$mname}'");
		$cur = $mydb_mo->executeQuery();
		$row_count = $mydb_mo->num_rows($cur);
		return $row_count;
	}


	function single_applicant($id = "")
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM " . self::$tblname . " 
				WHERE id= '{$id}' LIMIT 1");
		$cur = $mydb_mo->loadSingleResult();
		return $cur;
	}





	function select_applicant($id = "")
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM " . self::$tblname . " 
				Where APPLICANTID= '{$id}' LIMIT 1");
		$cur = $mydb_mo->loadSingleResult();
		return $cur;
	}



	// VERIFICAR LOGIN
	function applicantAuthentication($U_USERNAME, $h_pass)
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM `tblapplicants` WHERE `USERNAME`='" . $U_USERNAME . "' AND `PASS`='" . $h_pass . "'");
		$cur = $mydb_mo->executeQuery();
		if ($cur == false) {
			die($mydb_mo->error_msg);
		}
		$row_count = $mydb_mo->num_rows($cur); //get the number of count
		if ($row_count == 1) {
			$emp_found = $mydb_mo->loadSingleResult();
			$_SESSION['APPLICANTID']   		= $emp_found->APPLICANTID;
			$_SESSION['USERNAME'] 			= $emp_found->USERNAME;
			return true;
		} else {
			return false;
		}
	}


	// VERIFICAR LOGIN MOODLE
	function applicantAuthentication_mo($u_username, $u_pass)
	{
		global $mydb_mo;
		$mydb_mo->setQuery("SELECT * FROM mo_user WHERE username='" . $u_username . "'");
		$cur = $mydb_mo->executeQuery();
		if ($cur == false) {
			die($mydb_mo->error_msg);
		}
		$row_count = $mydb_mo->num_rows($cur); //get the number of count
		if ($row_count == 1) {
			$user_found = $mydb_mo->loadSingleResult();
			$userEncryptedPassword = $user_found->password;
			if (password_verify($u_pass, $userEncryptedPassword)) {
				$_SESSION['APPLICANTID']   		= $user_found->id;
				$_SESSION['USERNAME'] 			= $user_found->username;
				return true;
			}
		} else {
			return false;
		}
	}


	// GET PROFILE PICTURE OF MOODLE
	function getProfilePictureMoodle($userid)
	{
		global $mydb_mo;
		$sql = "SELECT mc.id, mu.picture FROM mo_user mu";
		$sql .= " INNER JOIN mo_context mc ON mu.id=mc.instanceid";
		$sql .= " WHERE mu.id ='" . $userid . "'";
		$mydb_mo->setQuery($sql);
		$cur = $mydb_mo->loadSingleResult();
		return $cur;
	}













	/*---Instantiation of Object dynamically---*/
	static function instantiate($record)
	{
		$object = new self;

		foreach ($record as $attribute => $value) {
			if ($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}


	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute)
	{
		// We don't care about the value, we just want to know if the key exists
		// Will return true or false
		return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes()
	{
		// return an array of attribute names and their values
		global $mydb_mo;
		$attributes = array();
		foreach ($this->dbfields() as $field) {
			if (property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}

	protected function sanitized_attributes()
	{
		global $mydb_mo;
		$clean_attributes = array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach ($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $mydb_mo->escape_value($value);
		}
		return $clean_attributes;
	}


	/*--Create,Update and Delete methods--*/
	public function save()
	{
		// A new record won't have an id yet.
		return isset($this->id) ? $this->update() : $this->create();
	}

	public function create()
	{
		global $mydb_mo;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO " . self::$tblname . " (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		echo $mydb_mo->setQuery($sql);

		if ($mydb_mo->executeQuery()) {
			$this->id = $mydb_mo->insert_id();
			return true;
		} else {
			return false;
		}
	}

	public function update($id = '')
	{
		global $mydb_mo;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE " . self::$tblname . " SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID='" . $id . "'";
		$mydb_mo->setQuery($sql);
		if (!$mydb_mo->executeQuery()) return false;
	}

	public function APLupdate($id = 0)
	{
		global $mydb_mo;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE " . self::$tblname . " SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID=" . $id;
		$mydb_mo->setQuery($sql);
		if (!$mydb_mo->executeQuery()) return false;
	}

	public function delete($id = '')
	{
		global $mydb_mo;
		$sql = "DELETE FROM " . self::$tblname;
		$sql .= " WHERE APPLICANTID='" . $id . "'";
		$sql .= " LIMIT 1 ";
		$mydb_mo->setQuery($sql);

		if (!$mydb_mo->executeQuery()) return false;
	}

	public function deleteJobRegistrations($id = '')
	{
		global $mydb_mo;
		$sql = "DELETE FROM tbljobregistration";
		$sql .= " WHERE APPLICANTID='" . $id . "'";
		// $sql .= " LIMIT 1 ";
		$mydb_mo->setQuery($sql);

		if (!$mydb_mo->executeQuery()) return false;
	}

	public function deleteFeedbacks($id = '')
	{
		global $mydb_mo;
		$sql = "DELETE FROM tblfeedback";
		$sql .= " WHERE APPLICANTID='" . $id . "'";
		// $sql .= " LIMIT 1 ";
		$mydb_mo->setQuery($sql);

		if (!$mydb_mo->executeQuery()) return false;
	}

	public function deleteAttachedFiles($id = '')
	{
		global $mydb_mo;
		$sql = "DELETE FROM tblattachmentfile";
		$sql .= " WHERE APPLICANTID='" . $id . "'";
		// $sql .= " LIMIT 1 ";
		$mydb_mo->setQuery($sql);

		if (!$mydb_mo->executeQuery()) return false;
	}
}

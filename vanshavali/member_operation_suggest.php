<?php

/**
 * This class is used to add suggestion of member modification
 *
 * @author piyush
 */
abstract class member_operation_suggest {

    /**
     * This function is used to add suggestion about addition of a child.
     * Returns true on successfull operation else returns false
     * @global \db $db The instance of the \db class
     * @global \user $user Instanec of the \user class
     * @param string $name The name of the member to be added
     * @param integer $gender The gender of the member
     * @param type $id The ID of the member whose child addition suggestion is being added
     * @return boolean
     */
    function add_son_suggest($name, $gender, $id) {
        global $db, $user;

        //fill array with data
        $finalarray = array('name' => $name, 'gender' => $gender, 'id' => $id);

        //Put it in database

        if ($db->query("insert into suggested_info (typesuggest,suggested_value,suggested_by,ts) values('child', '" .
                        json_encode($finalarray) . "'," . $user->user['id'] . "," . time() . ")"))
        {
            //Put the approval suggestion of user that has created the suggestion
            return ($db->query("insert into suggest_approved (suggest_id,user_id,action) values(".mysql_insert_id().",
                ".$user->user['id'].",1)"));
        }
        else
        {
            return false;
        }
        
    }

    /**
     * This function is used to remove a suggestion. Returns true on successful
     * removal else returns false
     * @global \db $db Instance of the db class
     * @global \user $user Instance of the user class
     * @param Integer $id The ID of the suggestion
     * @return boolean
     */
    function remove_suggest($id) {
        global $db, $user;

        if ($db->query("insert into suggested_info (typesuggest,suggested_value,suggested_by,ts) values
            ('remove', '$id'," . $user->user['id'] . "," . time() . ")"))
        {
            return ($db->query("insert into suggest_approved (suggest_id,user_id,action) values(".mysql_insert_id().",
                ".$user->user['id'].",1)"));
        }
        else
        {
            return false;
        }
        
    }

    /**
     * This function is used to add suggestion regarding modification of user 
     * detail modification. Returns false on error.
     * @global \db $db Instance of the db class
     * @global \user $user Instance of the user class
     * @param type $name The new name of the member
     * @param type $gender The new gender of the member
     * @param type $relationship The new relationship status of the member
     * @param type $dob The new DOB Timestamp
     * @param type $alive The new alive ID
     * @param type $id The ID of the member to be edited
     * @return boolean
     */
    function edit_suggest($name, $gender, $relationship, $dob, $alive, $id) {
        global $db, $user;

        preg_match("/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4,4})/", $dob, $matches);
        $dob = mktime(0, 0, 0, $matches[2], $matches[1], $matches[3]);

        $finalarray = array('name' => $name,
            'gender' => $gender,
            'relationship' => $relationship,
            'dob' => $dob,
            'alive' => $alive,
            'id' => $id);

        if ($db->query("insert into suggested_info (typesuggest,suggested_value,suggested_by,ts) values
            ('edit', '" . json_encode($finalarray) . "'," . $user->user['id'] . "," . time() . ")"))
        {
            return ($db->query("insert into suggest_approved (suggest_id,user_id,action) values(".mysql_insert_id().",
                ".$user->user['id'].",1)"));
        }
        else
        {
            return false;
        }
    }
    
    /**
     * This function is used to add new wife suggestion. Returns false on error
     * @global \db $db Instance of db class
     * @global \user $user Instance of the user class
     * @param type $name The name of the new wife
     * @param type $id The ID of the member whose wife is to be added
     * @return boolean
     */
    function addwife_suggest($name,$id)
    {
        global $db, $user;

        //fill array with data
        $finalarray = array('name' => $name, 'id' => $id);

        //Put it in database

        if ($db->query("insert into suggested_info (typesuggest,suggested_value,suggested_by,ts) values('wife', '" .
                        json_encode($finalarray) . "'," . $user->user['id'] . "," . time() . ")"))
        {
            //Put the approval suggestion of user that has created the suggestion
            return ($db->query("insert into suggest_approved (suggest_id,user_id,action) values(".mysql_insert_id().",
                ".$user->user['id'].",1)"));
        }
        else
        {
            return false;
        }
        
    }
    
    
    /**
     * This function is used to add a husband suggestion. Return false on error.
     * @global \db $db Instance of the db classs
     * @global \user $user Instance of the user class
     * @param type $name The name of the new husband
     * @param type $id ID of the member whose husband is to be added
     * @return boolean
     */
    function addhusband_suggest($name,$id)
    {
        global $db, $user;

        //fill array with data
        $finalarray = array('name' => $name, 'id' => $id);

        //Put it in database

        if ($db->query("insert into suggested_info (typesuggest,suggested_value,suggested_by,ts) values('Husband', '" .
                        json_encode($finalarray) . "'," . $user->user['id'] . "," . time() . ")"))
        {
            //Put the approval suggestion of user that has created the suggestion
            return ($db->query("insert into suggest_approved (suggest_id,user_id,action) values(".mysql_insert_id().",
                ".$user->user['id'].",1)"));
        }
        else
        {
            return false;
        }
        
    }

}

?>

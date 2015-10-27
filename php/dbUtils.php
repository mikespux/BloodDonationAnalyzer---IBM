<?php
require_once 'Config/dbConfig.php';
/**
 * Created by PhpStorm.
 * User: peter wasonga
 * Date: 10/12/2015
 * Time: 2:05 PM
 */
class dbUtils
{
    private $conn;

    /**
     * dbUtils constructor.
     * @param $conn
     */
    public function __construct()
    {
        $this->conn = new mysqli(dbConfig::$DBHOST,dbConfig::$DBUSER,dbConfig::$DBPASS,dbConfig::$DBNAME);
        if ($this->conn->connect_error) {
            trigger_error('Connection Failed: ' . $this->conn->connect_error, E_USER_ERROR);
        }
    }

    public function getAgeGroup($month,$region)
    {
        if($month == "*" && $region != "*"){
            echo $month . $region;
            $query = "select count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 0 and 10, 1, null)) as zero_10,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 10 and 20, 1, null)) as ten_20,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 20 and 30, 1, null)) as twnty_30,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 30 and 40, 1, null)) as thrty_40,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 40 and 50, 1, null)) as fourty_50,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 50 and 60, 1, null)) as fifty_60,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 60 and 70, 1, null)) as sixty_70
                      from requests r JOIN locations l on r.requestID = l.requestID
                      left join profiles p on p.profileID = r.profileID WHERE l.town = ".$region;
        }elseif($region == "*" && $month != "*"){
            $query = "select count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 0 and 10, 1, null)) as zero_10,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 10 and 20, 1, null)) as ten_20,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 20 and 30, 1, null)) as twnty_30,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 30 and 40, 1, null)) as thrty_40,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 40 and 50, 1, null)) as fourty_50,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 50 and 60, 1, null)) as fifty_60,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 60 and 70, 1, null)) as sixty_70
                      from requests r JOIN locations l on r.requestID = l.requestID
                      left join profiles p on p.profileID = r.profileID WHERE MONTH(p.dateCreated) = ".$month;
        }elseif($month === "*" and $region === "*"){
            $query = "select count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 0 and 10, 1, null)) as zero_10,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 10 and 20, 1, null)) as ten_20,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 20 and 30, 1, null)) as twnty_30,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 30 and 40, 1, null)) as thrty_40,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 40 and 50, 1, null)) as fourty_50,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 50 and 60, 1, null)) as fifty_60,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 60 and 70, 1, null)) as sixty_70
                      from profiles p;";
        }else{
            $query = "select count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 0 and 10, 1, null)) as zero_10,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 10 and 20, 1, null)) as ten_20,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 20 and 30, 1, null)) as twnty_30,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 30 and 40, 1, null)) as thrty_40,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 40 and 50, 1, null)) as fourty_50,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 50 and 60, 1, null)) as fifty_60,
                      count(if ((YEAR(curDate()) - YEAR(p.dateOfBirth)) between 60 and 70, 1, null)) as sixty_70
                      from requests r JOIN locations l on r.requestID = l.requestID
                      left join profiles p on p.profileID = r.profileID WHERE l.town = ".$region ." AND
                      MONTH(p.dateCreated) = ".$month;
        }

        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;

    }

    public function getGender($month,$region)
    {
        if($month == "*" && $region != "*"){
            $query = "select count(if (p.gender = 'M', 1, null)) as 'Male',
                      count(if (p.gender = 'F', 1, null)) as 'Female'
                      from requests r JOIN locations l on r.requestID = l.requestID
                      left join profiles p on p.profileID = r.profileID WHERE l.town = ".$region;
        }elseif($region == "*" && $month != "*"){
            $query = "select count(if (p.gender = 'M', 1, null)) as 'Male',
                      count(if (p.gender = 'F', 1, null)) as 'Female'
                      from profiles p WHERE MONTH(p.dateCreated) = ".$month;
        }elseif($month == "*" && $region == "*"){
            $query = "select count(if (p.gender = 'M', 1, null)) as 'Male',
                      count(if (p.gender = 'F', 1, null)) as 'Female'
                      from profiles p;";
        }else{
            $query = "select count(if (p.gender = 'M', 1, null)) as 'Male',
                      count(if (p.gender = 'F', 1, null)) as 'Female'
                      from requests r JOIN locations l on r.requestID = l.requestID
                      left join profiles p on p.profileID = r.profileID WHERE l.town = ".$region ." AND
                      MONTH(p.dateCreated) = ".$month;
        }

        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;

    }

    public function getBloodGroup($bloodGroup)
    {
        if($bloodGroup == "APlus")
        {
            $query = "select count(*) as 'bloodCount' from requests r join profiles p on r.profileID = p.profileID where p.bloodGroup = 'A+'";
        }else{
            $query = "select count(*) as 'bloodCount' from requests r join profiles p on r.profileID = p.profileID where p.bloodGroup = ".$bloodGroup;
        }

        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;
    }

    public function getRegions($month)
    {
        if($month == "*"){
            $query = "select count(if (l.town = 'kisumu', 1, null)) as 'Kisumu',count(if (l.town = 'nairobi', 1, null))
                      as 'Nairobi',  count(if (l.town = 'mombasa', 1, null))
                      as 'Mombasa' from locations l;";
        }else{
            $query = "select count(if (l.town = 'kisumu', 1, null)) as 'Kisumu',count(if (l.town = 'nairobi', 1, null))
                      as 'Nairobi', count(if (l.town = 'mombasa', 1, null))
                      as 'Mombasa' from locations l WHERE MONTH(l.dateModified) = ".$month;
        }
        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;

    }

    public function getTotalRequest()
    {
        $query = "select count(*) as total from requests;";
        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;
    }

    public function getTotalMale()
    {
        $query = " select count(*) as total from requests r join profiles p on r.profileID = p.profileID
                    where gender = 'm' ;";
        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;
    }

    public function getTotalFemale()
    {
        $query = " select count(*) as total from requests r join profiles p on r.profileID = p.profileID
                    where gender = 'f' ;";

        $response = $this->handleResults($query);

        if($response != null)
            return $response;
        else
            return false;
    }

    private function handleResults($query)
    {
        $result = $this->conn->query($query);

        if($result === false){
            trigger_error("Error: ".$this->conn->error,E_USER_ERROR);
        }else{
            $count = $result->field_count;
            $headers = array();
            for ($i = 0; $i < $count; $i++) {
                $headers[] = $result->fetch_field_direct($i)->name;
            }
        }
        if ($result) {
            $allRecords = $result->fetch_all(MYSQLI_ASSOC);

            //Clean up
            $result->free();

            $this->conn->close();

            return $allRecords;
        }
    }
}
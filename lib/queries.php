<?php

function remove_pass(&$e)
{
    unset($e['user_password']);
}

function get_users()
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM user");
    $query->execute();
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    array_walk($res, 'remove_pass');
    return $res;
}

function get_user_by_id($id)
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM user WHERE user_id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);
    unset($res['user_password']);
    return $res;
}

function new_user($params)
{
    $query = MySQL::getInstance()->prepare("INSERT INTO user " .
        "(user_email, user_password, user_name, user_description, user_role) " .
        "VALUES (:user_email, :user_password, :user_name, :user_description, :user_role)");
    $query->bindValue(':user_email', $params['user_email'], PDO::PARAM_STR);
    $query->bindValue(':user_password', $params['user_password'], PDO::PARAM_STR);
    $query->bindValue(':user_name', $params['user_name'], PDO::PARAM_STR);
    $query->bindValue(':user_description', $params['user_description'], PDO::PARAM_STR);
    $query->bindValue(':user_role', $params['user_role'], PDO::PARAM_STR);
    $query->execute();
    return get_user_by_id(MySQL::getInstance()->lastInsertId());
}

function get_agency()
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM agency");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function get_agency_by_abbreviation($abbr)
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM agency WHERE agency_abbreviation=:abbr");
    $query->bindValue(':abbr', $abbr, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function new_agency($params)
{
    $query = MySQL::getInstance()->prepare("INSERT INTO agency (agency_name, agency_abbreviation) VALUES (:name, :abbr)");
    $query->bindValue(':name', $params['agency_name'], PDO::PARAM_STR);
    $query->bindValue(':abbr', $params['agency_abbreviation'], PDO::PARAM_STR);
    $query->execute();
    return get_agency();
}

function update_user($id, $params)
{
    $old = get_user_by_id($id);
    $params = array_merge($old, $params);
    $query = MySQL::getInstance()->prepare("UPDATE user SET user_email = :user_email," .
        "user_password = :user_password , user_name = :user_name, " .
        "user_description = :user_description, user_role = :user_role WHERE user_id = :id");
    $query->bindValue(':user_email', $params['user_email'], PDO::PARAM_STR);
    $query->bindValue(':user_password', $params['user_password'], PDO::PARAM_STR);
    $query->bindValue(':user_name', $params['user_name'], PDO::PARAM_STR);
    $query->bindValue(':user_description', $params['user_description'], PDO::PARAM_STR);
    $query->bindValue(':user_role', $params['user_role'], PDO::PARAM_STR);
    $query->bindValue(':user_id', $id, PDO::PARAM_STR);
    return get_user_by_id($id);
}

function get_incident_by_id($id)
{
    $query = MySQL::getInstance()->prepare("SELECT incident.*, agency_name FROM incident LEFT JOIN agency ON incident.agency = agency.agency_abbreviation WHERE incident_id=:incident_id");
    $query->bindValue(':incident_id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function get_recent_incidents()
{
    $query = MySQL::getInstance()->prepare("SELECT incident_type, COUNT(*) FROM ".
        "incident LEFT JOIN agency ON incident.agency = agency.agency_abbreviation".
        " WHERE ".
        " (incident.incident_timestamp BETWEEN NOW() - INTERVAL 30 MINUTE AND NOW()) AND".
        " incident.incident_status = 'APPROVED' GROUP BY incident_type");

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function update_incident($id, $params)
{
    $old = get_incident_by_id($id);
    if (is_array($params) && is_array($old)) $params = array_merge($old, $params);
    if (!$params) $params=$old;
    $query = MySQL::getInstance()->prepare("UPDATE incident SET incident_timestamp = :incident_timestamp, incident_type = :type, incident_address = :address, incident_longitude = :longitude, incident_latitude = :latitude, incident_contactName = :contactName, incident_contactNo = :contactNo, incident_description = :description, incident_status = :incident_status, agency = :agency, operator = :operator WHERE incident_id = :id");
    $query->bindValue(':incident_timestamp', empty($params['incident_timestamp']) ? null : $params['incident_timestamp'], PDO::PARAM_STR);
    $query->bindValue(':type', $params['incident_type'], PDO::PARAM_STR);
    $query->bindValue(':address', $params['incident_address'], PDO::PARAM_STR);
    $query->bindValue(':longitude', $params['incident_longitude'], PDO::PARAM_STR);
    $query->bindValue(':latitude', $params['incident_latitude'], PDO::PARAM_STR);
    $query->bindValue(':contactName', $params['incident_contactName'], PDO::PARAM_STR);
    $query->bindValue(':contactNo', $params['incident_contactNo'], PDO::PARAM_STR);
    $query->bindValue(':description', $params['incident_description'], PDO::PARAM_STR);
    $query->bindValue(':incident_status', strtoupper($params['incident_status']), PDO::PARAM_STR);
    $query->bindValue(':agency', empty($params['agency']) ? null : $params['agency'], PDO::PARAM_STR);
    $query->bindValue(':operator', $params['operator'], PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $query->execute();
    } catch (PDOException $e) {
        $res['query'] = $query->queryString;
        $res['error'] = $e->getMessage();
        $res['params'] = $params;
        return $res;
    }
    return get_incident_by_id($id);
}

function incident_assign_agency($id, $agency_abbreviation)
{
    $query = MySQL::getInstance()->prepare("UPDATE incident SET agency= :agency WHERE incident_id = :id");
    $query->bindValue(':agency', $agency_abbreviation, PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return get_incident_by_id($id);

}


function get_incidents()
{
    $query = MySQL::getInstance()->prepare("SELECT incident.*, agency_name FROM incident LEFT JOIN agency ON incident.agency = agency.agency_abbreviation ORDER BY incident_timestamp DESC");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_incidents_by_status($status)
{
    $query = MySQL::getInstance()->prepare("SELECT incident.*, agency_name FROM incident LEFT JOIN agency ON incident.agency = agency.agency_abbreviation WHERE incident_status=:status ORDER BY incident_timestamp DESC");
    $query->bindValue(':status', strtoupper($status), PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_incidents_by_agency($status)
{
    $query = MySQL::getInstance()->prepare("SELECT incident.*, agency_name FROM incident LEFT JOIN agency ON incident.agency = agency.agency_abbreviation WHERE incident.agency=:agency ORDER BY incident_timestamp DESC");
    $query->bindValue(':agency', strtoupper($status), PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function create_incident($params)
{
    $query = MySQL::getInstance()->prepare("INSERT INTO incident " .
        "(incident_timestamp , incident_type , incident_address , incident_longitude ," .
        "incident_latitude , incident_contactName , incident_contactNo , incident_description ," .
        "incident_status , agency , operator)" .
        " VALUES (:incident_timestamp , :incident_type , :incident_address , :incident_longitude ," .
        ":incident_latitude , :incident_contactName , :incident_contactNo , :incident_description ," .
        ":incident_status , :agency , :operator)");
    $query->bindValue(':incident_timestamp', empty($params['incident_timestamp']) ? null : $params['incident_timestamp'], PDO::PARAM_STR);
    $query->bindValue(':incident_type', $params['incident_type'], PDO::PARAM_STR);
    $query->bindValue(':incident_address', $params['incident_address'], PDO::PARAM_STR);
    $query->bindValue(':incident_longitude', $params['incident_longitude'], PDO::PARAM_STR);
    $query->bindValue(':incident_latitude', $params['incident_latitude'], PDO::PARAM_STR);
    $query->bindValue(':incident_contactName', $params['incident_contactName'], PDO::PARAM_STR);
    $query->bindValue(':incident_contactNo', $params['incident_contactNo'], PDO::PARAM_STR);
    $query->bindValue(':incident_description', $params['incident_description'], PDO::PARAM_STR);
    $query->bindValue(':incident_status', strtoupper($params['incident_status']), PDO::PARAM_STR);
    $query->bindValue(':agency', empty($params['agency']) ? null : $params['agency'], PDO::PARAM_STR);
    $query->bindValue(':operator', $params['operator'], PDO::PARAM_STR);
    $query->execute();
    return get_incident_by_id(MySQL::getInstance()->lastInsertId());
}

function delete_incident($id)
{
    $query = MySQL::getInstance()->prepare("DELETE FROM incident WHERE incident_id=:$id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return array("success" => ($query->rowCount() > 0), "row_count" => $query->rowCount());
}

function get_feedbacks()
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM feedback ORDER BY feedback_timestamp DESC");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function create_feedback($params)
{
    $query = MySQL::getInstance()->prepare("INSERT INTO feedback (incident_id, feedback_agency, feedback_description, feedback_timestamp) VALUES (:incident_id, :feedback_agency, :feedback_description, :feedback_timestamp)");
    $query->bindValue(':incident_id', $params['incident_id'], PDO::PARAM_STR);
    $query->bindValue(':feedback_agency', $params['feedback_agency'], PDO::PARAM_STR);
    $query->bindValue(':feedback_description', $params['feedback_description'], PDO::PARAM_STR);
    $query->bindValue(':feedback_timestamp', empty($params['feedback_timestamp']) ? null : $params['feedback_timestamp'], PDO::PARAM_STR);
    $query->execute();
    return get_feedback_by_id(MySQL::getInstance()->lastInsertId());
}

function get_feedback_by_id($id)
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM feedback WHERE feedback_id=:id ORDER BY feedback_timestamp DESC");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function get_feedback_by_incident($id)
{
    $query = MySQL::getInstance()->prepare("SELECT feedback.* FROM feedback INNER JOIN incident ON feedback.incident_id = incident.incident_id WHERE feedback.incident_id=:incident_id  ORDER BY feedback_timestamp DESC");
    $query->bindValue(':incident_id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function update_feedback($id, $params)
{
    $old = get_feedback_by_id($id);
    if (is_array($params) && is_array($old)) $params = array_merge($old, $params);
    if (!$params) $params=$old;
    $query = MySQL::getInstance()->prepare("UPDATE feedback SET incident_id = :incident_id, feedback_agency = :feedback_agency , feedback_description = :feedback_description, feedback_status = :feedback_status, feedback_timestamp = :feedback_timestamp WHERE feedback_id = :feedback_id");
    $query->bindValue(':incident_id', $params['incident_id'], PDO::PARAM_STR);
    $query->bindValue(':feedback_agency', $params['feedback_agency'], PDO::PARAM_STR);
    $query->bindValue(':feedback_description', $params['feedback_description'], PDO::PARAM_STR);
    $query->bindValue(':feedback_status', empty($params['feedback_status']) ? null : $params['feedback_status'], PDO::PARAM_STR);
    $query->bindValue(':feedback_timestamp', empty($params['feedback_timestamp']) ? null : $params['feedback_timestamp'], PDO::PARAM_STR);
    $query->bindValue(':feedback_id', $id, PDO::PARAM_INT);
    $query->execute();
    return get_feedback_by_id($id);
}


function update_feedback_status($id)
{
    $query = MySQL::getInstance()->prepare("UPDATE feedback SET feedback_status = :feedback_status WHERE feedback_id = :feedback_id");
    $query->bindValue(':feedback_id', $id, PDO::PARAM_STR);
    $query->bindValue(':feedback_status', 'COMPLETED', PDO::PARAM_STR);
    $query->execute();
    return get_feedback_by_id($id);
}


function get_logs()
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM log ORDER BY timestamp DESC");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function create_log($params)
{
    $query = MySQL::getInstance()->prepare("INSERT INTO log " .
        "(user_id, timestamp, message) " .
        "VALUES (:user_id, :timestamp, :message)");
    $query->bindValue(':user_id', $params['user_id'], PDO::PARAM_STR);
    $query->bindValue(':timestamp', empty($params['timestamp']) ? null : $params['timestamp'], PDO::PARAM_STR);
    $query->bindValue(':message', $params['message'], PDO::PARAM_STR);
    $query->execute();
    return get_log_by_id(MySQL::getInstance()->lastInsertId());
}

function get_log_by_id($id)
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM log WHERE id=:id ORDER BY timestamp DESC");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function update_log($id, $params)
{
    $old = get_log_by_id($id);
    if (is_array($params) && is_array($old)) $params = array_merge($old, $params);
    if (!$params) $params=$old;
    $query = MySQL::getInstance()->prepare("UPDATE log SET user_id = :user_id," .
        "timestamp = :timestamp , message = :message WHERE id = :id");
    $query->bindValue(':user_id', $params['user_id'], PDO::PARAM_STR);
    $query->bindValue(':timestamp', empty($params['timestamp']) ? null : $params['timestamp'], PDO::PARAM_STR);
    $query->bindValue(':message', $params['message'], PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return get_log_by_id($id);
}

function verify_email_password($email, $password)
{
    $query = MySQL::getInstance()->prepare("SELECT * FROM user WHERE user_email=:email AND user_password=:password");
    $query->bindValue(':email', $email);
    $query->bindValue(':password', $password);
    $query->execute();
    $user_info = $query->fetch();
    if (!$user_info) return array("error" => "email or password incorrect");
    else return get_user_by_id($user_info['user_id']);
}



function numbers_of_user_agency($agency_id)
{
    $query = MySQL::getInstance()->prepare("SELECT DISTINCT user.user_number FROM user WHERE agency=:agency");
    $query->bindValue(':agency', $agency_id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_COLUMN);
}

function numbers_of_user_role($role)
{
    $query = MySQL::getInstance()->prepare("SELECT DISTINCT user.user_number FROM user WHERE user_role=:role");
    $query->bindValue(':role', $role);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_COLUMN);
}
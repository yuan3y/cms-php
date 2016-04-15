<?php

class IncidentHandler
{
    function get($id)
    {
        $this->get_xhr($id);
    }

    function get_xhr($id)
    {
        $incident = get_incident_by_id($id);
        _response($incident);
    }

    function put($id)
    {
        $this->put_xhr($id);
    }

    function put_xhr($id)
    {
        $incident_old=get_incident_by_id($id);
        $params = _parsePut();
        $incident=update_incident($id, $params);
        _response($incident);
        if (!empty($incident['agency']) && $incident_old['incident_status']=='INITIATED') {
            $agency_id = $incident['agency'];
            $message = "" . $incident['incident_type'] . " happened at " . $incident['incident_address'] . "\n" . "Details: " . $_SERVER['SERVER_NAME'] . "/incident/" . $id;
            $numbers = array_merge(numbers_of_user_agency($agency_id), numbers_of_user_role('operator'));
            SMS::batch_send($numbers, $message);
        }
    }

    function post($id)
    {
        $this->post_xhr($id);
    }

    function post_xhr($id)
    {
        $params = _set_default();
        _response(update_incident($id, $params));
    }

    function delete($id)
    {
        $this->delete_xhr($id);
    }

    function delete_xhr($id)
    {
        $result = delete_incident($id);
        _response($result);
    }
}
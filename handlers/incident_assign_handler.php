<?php

class IncidentAssignHandler
{
    function put($id, $agency_id)
    {
        $this->put_xhr($id, $agency_id);
    }

    function put_xhr($id, $agency_id)
    {
        $params = _parsePut();
        _response(incident_assign_agency($id, $agency_id));
    }

    function post($id, $agency_id)
    {
        $this->post_xhr($id, $agency_id);
    }

    function post_xhr($id, $agency_id)
    {
        $params = _set_default();
        _response(incident_assign_agency($id, $agency_id));
    }
}
<?php

class IncidentsByStatusHandler
{
    function get($status)
    {
        $this->get_xhr($status);
    }

    function get_xhr($status)
    {
        $incidents = get_incidents_by_status($status);
        _response($incidents);
    }
}


class IncidentsByAgencyHandler
{
    function get($status)
    {
        $this->get_xhr($status);
    }

    function get_xhr($status)
    {
        $incidents = get_incidents_by_agency($status);
        _response($incidents);
    }
}
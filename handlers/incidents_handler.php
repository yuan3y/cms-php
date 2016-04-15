<?php

class IncidentsHandler
{
    function get()
    {
        $this->get_xhr();
    }

    function get_xhr()
    {
        $incidents = get_incidents();
        _response($incidents);
    }

    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default();
        _response(create_incident($params));
    }
}
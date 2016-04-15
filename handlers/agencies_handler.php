<?php

class agenciesHandler
{
    function get()
    {
        $this->get_xhr();
    }

    function get_xhr()
    {
        $users = get_agency();
        _response($users);
    }

    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default();
        _response(new_agency($params));
    }
}
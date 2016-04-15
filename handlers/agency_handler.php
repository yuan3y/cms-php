<?php

class agencyHandler
{
    function get($id)
    {
        $this->get_xhr($id);
    }

    function get_xhr($id)
    {
        $users = get_agency_by_abbreviation($id);
        _response($users);
    }
}
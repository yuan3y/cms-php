<?php

class LogsHandler
{
    function get()
    {
        $this->get_xhr();
    }

    function get_xhr()
    {
        $logs = get_logs();
        _response($logs);
    }

    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default();
        _response(create_log($params));
    }
}
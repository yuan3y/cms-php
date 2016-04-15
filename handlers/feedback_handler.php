<?php

class FeedbackHandler
{
    function get($id)
    {
        $this->get_xhr($id);
    }

    function get_xhr($id)
    {
        $feedback = get_feedback_by_id($id);
        _response($feedback);
    }

    function put($id)
    {
        $this->put_xhr($id);
    }

    function put_xhr($id)
    {
        $params = _parsePut();
        _response(update_feedback($id, $params));
    }

    function post($id)
    {
        $this->post_xhr($id);
    }

    function post_xhr($id)
    {
        $params = _set_default();
        _response(update_feedback($id, $params));
    }
}
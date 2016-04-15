<?php

class FeedbacksHandler
{
    function get()
    {
        $this->get_xhr();
    }

    function get_xhr()
    {
        $feedback = get_feedbacks();
        _response($feedback);
    }

    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default();
        _response(create_feedback($params));
    }
}

class FeedbacksByIncident
{
    function get($id)
    {
        $this->get_xhr($id);
    }

    function get_xhr($id)
    {
        $feedback = get_feedback_by_incident($id);
        _response($feedback);
    }
}
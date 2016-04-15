<?php
require("lib/Parsedown.php");
require("lib/mysql.php");
require("lib/queries.php");
require("lib/toro.php");
require("lib/base.php");

foreach (glob("handlers/*_handler.php") as $filename) {
    require $filename;
}


ToroHook::add("404", function () {
    echo "Not found";
});

Toro::serve(array(
    "/hello/" => "HelloHandler",
    "/" => "HelloHandler",
    "/user/" => "UsersHandler",
    "/user/:number" => "UserHandler",
    "/incident/" => "IncidentsHandler",
    "/incident/:number" => "IncidentHandler",
    "/incident/:number/assign/:number" => "IncidentAssignHandler",
    "/feedback/" => "FeedbacksHandler",
    "/feedback/:number" => "FeedbackHandler",
    "/feedback/:number/status/" => "FeedbackStatusHandler",
    "/log/" => "LogsHandler",
    "/log/:number" => "LogHandler",
    "/media/" => "SocialMediaHandler",
    "/verify/" => "VerifyHandler",
    "/agency/" => "AgenciesHandler",
    "/agency/:alpha" => "AgencyHandler",
    "/incident/status/:alpha" => "IncidentsByStatusHandler",
    "/incident/agency/:alpha" => "IncidentsByAgencyHandler",
    "/incident/:number/feedback/" => "FeedbacksByIncident",
    "/email/" => "MailHandler",
    "/recent/" => "RecentIncidentsHandler",
    "/sms/" => "SMSHanlder",
    /* Naming Convention
     * To make our life easier, we'll use only singular terms in URL,
     * For Handlers' names, use singular or plural corresponding to the usage
     * the ending with / indicates a group
     * the ending without / indicates an individual resource
     * ':string' => '([a-zA-Z]+)',
     * ':number' => '([0-9]+)',
     * ':alpha' => '([a-zA-Z0-9-_]+)'
     * Happy coding :) */
));

The backend API for CMS system.

## Software Requirements

* php 5.4, 
* mysql 5.5,
* enable mod_rewirte in apache2.4
* Suggested testing tool: Postman in Chrome Browser.

## Requests
You will need a http header:
X-Requested-With
 having value:
XMLHttpRequest

for Post Request, you need key:value pairs in "form-data"

## Development Manual
0. Setup: find under `lib` folder, copy `mysql_template.php` to `mysql.php`, modify the database name, username and password accordingly.

1. add a handler under `/handlers/` folder

2. add queries into `/lib/queries.php`

3. add in the route in `/index.php`

4. test things you added

5. add in the `API Usage` in `README.md`

6. pull, commit, push


## API Usage

* sample responses are still to be written by the backend team, you can try directly
* PUT request always has the fields the same as its parent's POST request. 

[`GET /user/`](http://cms-torophp.rhcloud.com/user/)

Response an array of user information, without password.
```javascript
[
  {
    "user_id": "1",
    "user_name": "Operator 1",
    "user_description": "No desc",
    "user_role": "Operator"
  }
]
```

`POST /user/`
* required fields: user_email, user_password, user_name, user_description, user_role, 
* return: inserted user info 

`GET /user/$user_id`
```javascript
{
  "user_id": "2",
  "user_name": "My Email",
  "user_description": "My email is me.",
  "user_role": "operator"
}
```

`PUT /user/$user_id`

`GET /incident/`

`POST /incident/`
* required fields: incident_timestamp , incident_type , incident_address , incident_longitude 
                   incident_latitude , incident_contactName , incident_contactNo , incident_description 
                   incident_status , agency , operator

`GET /incident/$incident_id`

`PUT /incident/$incident_id`

`DELETE /incident/$incident_id`

`GET /feedback/`

`POST /feedback/`
* required fields: incident_id, feedback_agency, feedback_description, feedback_timestamp

`GET /feedback/$feedback_id`

`PUT /feedback/$feedback_id`

`POST /feedback/$feedback_id/status/`
no fields required, automatically update feedback status to "COMPLETED"

`GET /log/`

`POST /log/`
* required fields: user_id, timestamp, message

`GET /log/$log_id`

`PUT /log/$log_id`

`POST /verify/`
* required fields: user_email, user_password

failure:
```javascript
{
  "error": "email or password incorrect"
}
```

`GET /agency/`

`POST /agency/`
* required fields: agency_abbreviation (Capital letters), agency_name

`GET /agency/$agency_abbreviation`

[`GET /incident/status/$status`](http://cms-torophp.rhcloud.com/incident/status/confirmed)
retrieve the list of status based on $status={initiated, approved, rejected, closed⁠⁠⁠⁠}

[`GET /incident/agency/$agency_abbr`](http://cms-torophp.rhcloud.com/incident/agency/NEA)
get the list of incidents by agency

[`GET /incident/$id/feedback/`](http://cms-torophp.rhcloud.com/incident/1/feedback/)
get the list of feedback by incident id.
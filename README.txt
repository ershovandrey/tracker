Tasks:
TASK 1

Description
Build a service that will track the browsing history of a client's website.
The service will provide a javascript code that will be added to a client’s website in order to handle the tracking.

Tracking information:
 - visitor
 - page url that is browsed
 - visitor’s browser
 - visitor’s  ip
 - datetime

You can implement whatever unique visitor identification method you like and describe it.

The application must have at least:
 - Sites table (id, url)
 - Endpoint providing the javascript code that will be added to client's website
 - Endpoint for tracking the browsing actions


Requirements
 - Framework Laravel (preferably) or Symfony or CodeIgniter
 - Documented code
 - Installation instructions

Feel free to structure the application as you like.

Optional (really optional)
 - Use docker for easier installation
 - Add a ui to show basic analytics like actions per site / per browser etc.

TASK 2

Add an endpoint that will utilize  mailchimp API  in order to push contacts (emails) into mailchimp’s contact lists.

The endpoint  will accept POST json requests like this:
{
	"api_key": [MAILCHIMP_API_KEY],
	"list_id":[MAILCHIMP_LIST_ID],
	"email":[EMAIL_TO_BE_ADDED]
}

And return the mailchimp id of the added contact :

 {"id":"b45344ecbb444e87e9df9f48de501e8f"}

You can use the same project as task 1.

------------------------------------------------------------------------------------------------------------------------

Installation:
1. clone the repo:
$ git clone git@github.com:ershovandrey/tracker.git

2. cd to project dir and install composer dependencies:
$ cd tracker
$ composer install

3. install npm dependencies:
$ npm install

4. Fix the URL of the tracker app in /resources/js/tracker.js
Line 21, http.open('POST', 'http://tracker.loc/api/visit');
Please replace the http://tracker.loc with current URL of the app in your setup.

5. compile frontend assets
$ npm run dev

6. Create .env file from .env.example
$ cp .env.example .env

7. Generate app key
$ php artisan key:generate

8. Update .env file with correct app values and database values

9. Run the webserver/mysql

10. Run the database migration
$ php artisan migrate

11. Open the app in web browser and register a new user

12. Create new site and copy the token value

13. On client site add tracker JavaScript and start the tracking
<script src="http://[url-of-tracker-app]/js/tracker.js" ></script>
<script>
  window.onload = function() {
    __track('[put-your-token-here]');
  };
</script>

14. On tracker app go to /sites and click on Visitors link of tracked client site. You will see visits records.

15. For Task 2, please use /api/subscribe endpoint

------------------------------------------------------------------------------------------------------------------------
Additional information:

Visitors Unique identification based on the code from https://andywalpole.me/blog/140739/using-javascript-create-guid-from-users-browser-information

Client tracker JavaScript function __track also accepts second bool param - respectDoNotTrack - if set to TRUE, tracker will no track the user has declared Do Not Track (DNT) in the browser.



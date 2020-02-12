# User-group API

Designed for the NFQ interview process. This project is meant to show the core concepts of API creation.

Exception handling was inspired by [this article](https://medium.com/@ideneal/symfony-4-a-good-way-to-deal-with-exceptions-for-rest-api-afd8b615c923)

Unique validator was inspired by [this post](https://stackoverflow.com/questions/44199711/use-uniqueentity-outside-of-entity-and-without-forms)
.

## Setup

* Setup local server with mysql57
* Edit .env
* composer install
* make seed

## Usage:

#### Headers: 
* 'Accept': 'application/json'

#### Endpoints

* Index: / (Get)
* Login: /login (Post with name and password of user})
* Logout: /logout (Get)
* Add user: /api/v1/user (Post with name and password of user) 
* Get users: /api/v1/user (Get)
* Get groups: /api/v1/group (Get)
* Add group: /api/v1/group (Post with group name)
* Delete group: /api/v1/group (Delete with group name)
* Assign user to group: /api/v1/group/assign (Post with group name nad user name)
* Remove user from group: /api/v1/group/remove (Post with group name and user name)

## Testing

Run these commands 
* make migrate-test
* make test

## Possible improvements:

* Improve validation for duplicate entries. Symfony doesn't have unique entry support for non entity validation.
Could have used form validator.
* Use behat for feature tests.
* Add unit tests (possibly phpspec).
* Use tools for better API documentation (ex. Swagger).
* Cache Group list and User list, invalidate it on each update.

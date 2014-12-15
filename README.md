php-rest-client
===============

## Introduction

This is simple REST api wraper for smartsuppp writen in PHP. It has intuitive design to do create, delete, update and get operations with smartsupp resources.

* [More info about Smartsupp REST API](http://developers.smartsupp.com/rest/) This is get started doc for REST API, you should understand how it works
* [Resources REST API documentation](http://doc.smartsupp.com/) This is documnentation for resources. PHP wrapper generates all kind of rest requests by intuitive fluent style.

## Get Started

Here is an example on how to use it:

```php
$api = new Smartsupp\Rest\Api(YOUR_API_KEY);

// create account
$accountResponse = $api->accounts()
  ->create(array(
    'title' => 'My account',
	  'lang' => 'cs'
  ));

// create user in account
$userResponse = $api->accounts($accountResponse->values['id'])
  ->users()
  ->create(array(
		'fullname' => 'Test Create',
		'nickname' => 'Nick name',
		'password' => 'pass1234',
		'email' => 'john.doe.create@tester.loc',
		'lang' => 'en'
  ));

// update user in account  
$api->accounts($accountResponse->values['id']))
  ->users($userResponse->values['id']))
  ->update(array(
    'nickname' => 'John Doe'
  ));

// get user in account  
$response = $api->accounts($accountResponse->values['id']))
  ->users($userResponse->values['id']))
  ->get();
echo $response->code; // 200
echo $response->values['nickname']; // John doe

// get list of users in account
$response = $api->accounts($accountResponse->values['id']))
  ->users()
  ->send();
```

From this example, you can learn the following:

* If you want to works with resources you should pass resource ID as parameter.
* Allowed methods are: "get", "update", "create", "delete", "send"
* Every response has code and values


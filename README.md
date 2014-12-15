php-rest-client
===============

## Introduction

This is simple REST api wraper for smartsuppp writen in PHP. It has intuitive design to do create, delete, update and get operations with smartsupp resources.

* [More info about Smartsupp REST API](http://developers.smartsupp.com/rest/) This is get started doc for REST API, you should understand how it works
* [Resources REST API documentation](http://doc.smartsupp.com/) This is documnentation of the Smartsupp Resources. PHP wrapper generates all kind of REST requests by intuitive fluent style.

## Get Started

Here is an example on how to use it:

```php
$api = new Smartsupp\Rest\Api(YOUR_API_KEY);

// get accounts list
$accountListResponse = $api->accounts()
	->send();

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
$userUpdateResponse = $api->accounts($accountResponse->values['id'])
	->users($userResponse->values['id'])
	->update(array(
		'nickname' => 'John Doe'
	));

// get user in account  
$userGetResponse = $api->accounts($accountResponse->values['id'])
	->users($userResponse->values['id']))
	->get();

// get list of users in account
$usersListResponse = $api->accounts($accountResponse->values['id'])
	->users()
	->send();
```

From this example, you can learn the following:

* If you want to works with resources you should pass resource ID as parameter.
* Allowed methods are: "get", "update", "create", "delete", "send"
* Every response has code and values

To get response info you can use this properties
```php
$response = $api->accounts($accountResponse->values['id']))
	->users()
	->send();

// read http response code
echo $response->code; // 200

// read response variables
print_R($response->values); 
// array(
//	'records'=> array(
//		0 => array('id'=>123, 'nickname'=>'John Doe', 'role'=>'agent', ...), 
// 		1 => array(...), 
//		...
//	)
// );
```
* **code** Http response code
* **values** Response JSON converted to array

Into response values you can access by __get property like:
```php
$user = $api->accounts($accountId)
	->users($userId)
	->get();

echo $user->id; // show user id
echo $user->values['id']; // show user id
echo $user->getValue('id'); // show user id
```

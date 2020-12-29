# php-jwt
Generate, read and validate JWT tokens.


### Usage

First import the `JWT.php` into your PHP project.

```php
import_once 'JWT.php';
```


Generate a new token from a payload array
```php
JWT::generateToken([
   'iss' => 'localhost',
   'exp' => '12031032123'
   'name' => 'User',
   'email' => 'a@a.com'
])
```

Check if a received token is valid
```php
JWT::isTokenValid($receivedToken)
```


Retrieve the received token payload
```php
$payload = JWT::getPayload($receivedToken)
```

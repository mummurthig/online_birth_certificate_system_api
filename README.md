## Create mysql database 
#### Create tables using db.sql from config folder

## Rest API endpoint 

> https://localhost/online_birth_certificate_system/v1/admin

> https://localhost/online_birth_certificate_system/v1/users

## User API all responses

#### 1- POST - Create new user  
```javascript
 http://localhost/online_birth_certificate_system/v1/users/create_user 
 
 Content-Type: application/json
 
 {
	"name" : "mike",	
	"phone" : "9600361244",
	"email" : "userone@gmail.com", 
	"address" : "tamil nadu, india",
	"password" : "123456"
}
```
HTTP Response Code: **200**
```javascript
{
    "status": 1,
    "message": "User has been created"
}
```
HTTP Response Code: **500**
```javascript
{
   "status" => 0,
   "error" => "Failed to save user"
}
```

HTTP Response Code: **501**
```javascript
{
    "status": 0,
    "error": "All data needed"
}
```
HTTP Response Code: **503**
```javascript
{
    "status": 0,
    "error": "Access Denied"
}
```

#### 2- POST - Login user 
```javascript
 http://localhost/online_birth_certificate_system/v1/users/login 
 
 Content-Type: application/json
 
 {		
	"email" : "userone@gmail.com", 
	"password" : "123456"
}
```
HTTP Response Code: **200**
```javascript
{
    "message": "Successful login.",
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDc1MDg3MDAsImV4cCI6MTYwNzUxMjMwMCwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9vbmxpbmVfYmlydGhfY2VydGlmaWNhdGVfc3lzdGVtXC92MVwvIiwiZGF0YSI6eyJpZCI6IjIiLCJuYW1lIjoibWlrZSIsInBob25lIjoiNTY3IiwiZW1haWwiOiJ1c2VycnR3b3hzQGdtYWlsLmNvbSIsImFkZHJlc3MiOiJ0YW1pbCBuYWR1LCBpbmRpYSJ9fQ.YrFbviSDcwe2XdtM38WP2mjvZrcXxaMVsgiWQU24dfs"
}
```
HTTP Response Code: **401**
```javascript
{
    "message": "Login failed."
}
```
#### 3- POST - Validate token 
```javascript
 http://localhost/online_birth_certificate_system/v1/users/validate_token 
 
 Content-Type: application/json
 
 {		
	"email" : "userone@gmail.com", 
	"password" : "123456"
}
```
HTTP Response Code: **200**
```javascript
{
    "msg": "Access granted.",
    "data": {
        "id": "2",
        "name": "mike",        
        "phone": "2147483647",
        "email": "userones@gmail.com",
        "address": "tamil nadu, india"
    }
}
```
HTTP Response Code: **401**
```javascript
{
    "msg": "Access denied.",
    "error": "Syntax error, malformed JSON"
}
```
HTTP Response Code: **401**
```javascript
{
    "error" => "Access denied."
}
```




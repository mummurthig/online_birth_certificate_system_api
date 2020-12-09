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
    "success": "Successful login.",
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDc1MDg3MDAsImV4cCI6MTYwNzUxMjMwMCwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9vbmxpbmVfYmlydGhfY2VydGlmaWNhdGVfc3lzdGVtXC92MVwvIiwiZGF0YSI6eyJpZCI6IjIiLCJuYW1lIjoibWlrZSIsInBob25lIjoiNTY3IiwiZW1haWwiOiJ1c2VycnR3b3hzQGdtYWlsLmNvbSIsImFkZHJlc3MiOiJ0YW1pbCBuYWR1LCBpbmRpYSJ9fQ.YrFbviSDcwe2XdtM38WP2mjvZrcXxaMVsgiWQU24dfs"
}
```
HTTP Response Code: **401**
```javascript
{
    "status": 0,
    "message": "User already exists, try another email address"
}
```
HTTP Response Code: **401**
```javascript
{
    "error": "Login failed."
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
    "success": "Access granted.",
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
    "message": "Access denied.",
    "error": "Syntax error, malformed JSON"
}
```
HTTP Response Code: **401**
```javascript
{
    "error" => "Access denied."
}
```
#### 4- POST - Update user 
```javascript
 http://localhost/online_birth_certificate_system/v1/users/update_user 
 
 Content-Type: application/json
 
{
	"name" : "jaki",
	"phone" : "chan",
	"email" : "usertwo@gmail.com", 
	"address" : "tamil nadu, india",
	"password" : "123456",
	"jwt":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDc1MDg3MDAsImV4cCI6MTYwNzUxMjMwMCwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9vbmxpbmVfYmlydGhfY2VydGlmaWNhdGVfc3lzdGVtXC92MVwvIiwiZGF0YSI6eyJpZCI6IjIiLCJuYW1lIjoibWlrZSIsInBob25lIjoiNTY3IiwiZW1haWwiOiJ1c2VycnR3b3hzQGdtYWlsLmNvbSIsImFkZHJlc3MiOiJ0YW1pbCBuYWR1LCBpbmRpYSJ9fQ.YrFbviSDcwe2XdtM38WP2mjvZrcXxaMVsgiWQU24dfs"
	
}
```
HTTP Response Code: **200**
```javascript
{
    "message": "User was updated.",
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDc0OTkxMDksImV4cCI6MTYwNzUwMjcwOSwiaXNzIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9vbmxpbmVfYmlydGhfY2VydGlmaWNhdGVfc3lzdGVtXC92MVwvIiwiZGF0YSI6eyJpZCI6IjEiLCJmaXJzdG5hbWUiOiJtaWtpIiwibGFzdG5hbWUiOiJtb3NlcyIsInBob25lIjoiOTYwMDM2MTI2NiIsImVtYWlsIjoidXNlcm9uZUBnbWFpbC5jb20iLCJhZGRyZXNzIjoidGFtaWwgbmFkdSwgaW5kaWEifX0.3_5Ts-Cm6uaM2CsnAwZ6ZV-ox28UcEInusEUn5kHnKY"
}

```
HTTP Response Code: **200**
```javascript
{
    "message": "Access denied.",
    "error": "Expired token"
}
```
#### 5- POST - Add new application  
```javascript
 http://localhost/online_birth_certificate_system/v1/users/add_new_application 
 
 Content-Type: application/json
 
{
 "UserID" : "1",
 "DateofBirth" : "25/01/2000",
 "Gender" : "male",
 "FullName" : "TestUser",
 "PlaceofBirth" : "Tamil Nadu",
 "NameofFather" : "Test",
 "PermanentAdd" : "Tamil Nadu", 
 "PostalAdd" : "620404", 
 "MobileNumber" : "9600361246", 
 "Email" : "firstuser@gmail.com"
}
```
HTTP Response Code: **200**
```javascript
{
    "status": 1,
    "message": "New application has been created"
}
```
HTTP Response Code: **200**
```javascript
{
    "status": 0,
    "message": "The application already exists, try another email address"
}
```

#### 6- GET - Get my applications 
```javascript
 http://localhost/online_birth_certificate_system/v1/users/myApplications?UserID=1
```
HTTP Response Code: **200**
```javascript
{
    "records": [
        {
            "ID": "1",
            "ApplicationID": "141553674",
            "DateofBirth": "25/01/2000",
            "Gender": "Male",
            "PlaceofBirth": "Tamil Nadu",
            "NameofFather": "michal",
            "PermanentAdd": "Tamil Nadu",
            "PostalAdd": "635203",
            "MobileNumber": "8754699355",
            "Email": "jhon@gmail.com.com",
            "Remark": "no remark",
            "Status": "pending"            
        },
        {
            "ID": "2",
            "ApplicationID": "399787101",
            "DateofBirth": "25/01/2000",
            "Gender": "male",
            "PlaceofBirth": "Tamil Nadu",
            "NameofFather": "Test",
            "PermanentAdd": "Tamil Nadu",
            "PostalAdd": "620404",
            "MobileNumber": "9600361246",
            "Email": "firstuser@gmail.com",
            "Remark": "no remark",
            "Status": "pending"           
        }
    ]
}
```
HTTP Response Code: **404**
```javascript
{
  "message": "No applicationss found."
}
```
#### 7- GET - Get my pending applications 
```javascript
 http://localhost/online_birth_certificate_system/v1/users/pending_applications?UserID=1
```
HTTP Response Code: **200**
```javascript
{
    "records": [
        {
            "ID": "1",
            "ApplicationID": "141553674",
            "DateofBirth": "25/01/2000",
            "Gender": "Male",
            "PlaceofBirth": "Tamil Nadu",
            "NameofFather": "michal",
            "PermanentAdd": "Tamil Nadu",
            "PostalAdd": "635203",
            "MobileNumber": "8754699355",
            "Email": "jhon@gmail.com.com",
            "Remark": "no remark",
            "Status": "pending"            
        }       
    ]
}
```
#### 8- GET - Get my rejected applications
```javascript
 http://localhost/online_birth_certificate_system/v1/users/rejected_applications?UserID=1  
```
HTTP Response Code: **200**
```javascript
{
    "records": [
        {
            "ID": "1",
            "ApplicationID": "141553674",
            "DateofBirth": "25/01/2000",
            "Gender": "Male",
            "PlaceofBirth": "Tamil Nadu",
            "NameofFather": "michal",
            "PermanentAdd": "Tamil Nadu",
            "PostalAdd": "635203",
            "MobileNumber": "8754699355",
            "Email": "jhon@gmail.com.com",
            "Remark": "your application has been rejected",
            "Status": "regicted",
	    "UpdationDate" : "20/01/2020"
        }       
    ]
}
```




# git-repo-test
This An Test App for Cimpress 

Code developed in Laravel Framework

Steps:

clone the code

`git clone https://github.com/crajbanshi/git-repo-test.git`

install dependancies using
`composer update`

Check and edit database config in `.env` file 


Commands for get repository and store into databse for use symfony,

`php artisan createRepo`


Run Web interface

`php artisan serve`


Routes -->
get Repo list from Database

http://127.0.0.1:8000/repo

database config

dbhost= 127.0.0.1
dbname = 'gitrepo'
username = 'root'
password = ''


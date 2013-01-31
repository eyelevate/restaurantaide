
node default {

    $mysql_password = 'root'

	include apt
    include mysql
	include php
	include phpunit
	include apache

	mysqldb { "bbfl":
        user => "restaurantaide",
        password => "root",
    }
    
    mysqldb { "cake_test":
        user => "cake_test",
        password => "cake_test",
    }
}

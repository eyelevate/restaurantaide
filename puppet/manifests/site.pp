
node default {

    $mysql_password = 'root'

	include apt
    include mysql
	include php
	include phpunit
	include apache

	mysqldb { "restaurantaide":
        user => "root",
        password => "root",
    }
    
    mysqldb { "cake_test":
        user => "cake_test",
        password => "cake_test",
    }
}

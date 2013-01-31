<<<<<<< HEAD

class apache {

	package {
		"apache2": ensure => installed;
	}
	
	exec { "enable-mod-rewrite":
		unless => "/usr/bin/test -e /etc/apache2/mods-enabled/rewrite.load",
		path => ["/usr/sbin", "/usr/bin"],
		command => "a2enmod rewrite",
		require => Package["apache2"],
	}

	file { '/etc/apache2/sites-enabled/000-default':
		ensure => 'absent',
		require => Package["apache2"],
	}

	service { 'apache2':
		ensure => running,
		enable => true,
		hasstatus => true,
		hasrestart => true,
	}
	
	file { "/etc/apache2/httpd.conf":
		source => "puppet:///modules/apache/httpd.conf",
		notify => Service["apache2"],
		require => Package["apache2"],
	}
	
	file { "/etc/apache2/sites-available/restaurantaide":
		source => "puppet:///modules/apache/restaurantaide",
		notify => Service["apache2"],
		require => Package["apache2"],
	}
	
	file { '/etc/apache2/sites-enabled/restaurantaide':
		ensure => 'link',
		notify => Service["apache2"],
		target => '/etc/apache2/sites-available/restaurantaide',
		require => File["/etc/apache2/sites-available/restaurantaide"],
	}
=======

class apache {

	package {
		"apache2": ensure => installed;
	}
	
	exec { "enable-mod-rewrite":
		unless => "/usr/bin/test -e /etc/apache2/mods-enabled/rewrite.load",
		path => ["/usr/sbin", "/usr/bin"],
		command => "a2enmod rewrite",
		require => Package["apache2"],
	}

	file { '/etc/apache2/sites-enabled/000-default':
		ensure => 'absent',
		require => Package["apache2"],
	}

	service { 'apache2':
		ensure => running,
		enable => true,
		hasstatus => true,
		hasrestart => true,
	}
	
	file { "/etc/apache2/httpd.conf":
		source => "puppet:///modules/apache/httpd.conf",
		notify => Service["apache2"],
		require => Package["apache2"],
	}
	
	file { "/etc/apache2/sites-available/restaurantaide":
		source => "puppet:///modules/apache/restaurantaide",
		notify => Service["apache2"],
		require => Package["apache2"],
	}
	
	file { '/etc/apache2/sites-enabled/restaurantaide':
		ensure => 'link',
		notify => Service["apache2"],
		target => '/etc/apache2/sites-available/restaurantaide',
		require => File["/etc/apache2/sites-available/restaurantaide"],
	}
>>>>>>> 8a4d8fa00a9ec0d71716cd5d78a49e25c1e5fc3a
}
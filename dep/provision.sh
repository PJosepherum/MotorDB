#!/bin/bash

# Set up virtual machine
function setupvm {

    export DEBIAN_FRONTEND=noninteractive
    apt-get update
    service apache2 stop
    apt-get -q -y install nginx
    cp /vagrant/dep/nginx.conf /etc/nginx/nginx.conf
    apt-get -q -y install php5-fpm
    cp /vagrant/dep/php.ini /etc/php5/fpm/php.ini
    cp /vagrant/dep/php.ini /etc/php5/cli/php.ini
    cp /vagrant/dep/www.conf /etc/php5/fpm/pool.d/www.conf
    ln -s /usr/lib/php5/20100525+lfs /usr/lib/php5/modules
    chmod go+w --recursive /vagrant/phalcon/cache/volt/
    #cp /vagrant/dep/000-default /etc/apache2/sites-enabled/000-default
    mysql --user=root --password=pass < /vagrant/phalcon/schemas/dump.sql
    service nginx restart
    service php5-fpm restart

    # Mark setup complete
    touch /root/.setupvm
}

# Only setup system once
if [ ! -f "/root/.setupvm" ]; then setupvm; fi
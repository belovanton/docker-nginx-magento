#docker-nginx-magento
Docker NGINX + Magento continer
 
## About

This container is optimized for running Magento using NGINX

This container requires a seperate dedicated mysql container (mysql) to run.
You can find mysql either at docker (https://registry.hub.docker.com/_/mysql/)

## Usage by example

### The mysql container

#### Running the container

```shell
docker run --name some-mysql -e MYSQL_ROOT_PASSWORD=123 -d mysql
```

#### How it works

* -d : Run daemonized
* --name : The name of the container
* -e : Environmental parameters
	* MYSQL_ROOT_PASSWORD : When no root password of the database is set there will be one generated for you  
* mysql : The name of the repository	


### The magento container

#### Running the container

```shell
docker run -d --name project -p 80:80 -v /location/of/magentodata/at/host/:/var/www/ --link project-mysql:db gdemad/nginx-magento
```

#### How it works

* -d : Run daemonized
* -p : Map the 80 port the container to the 80 port of the host ( Not required when using a reverse proxy )
* -e : Environmental parameters
  * MAILSERVER : External smtp server (smart host, default value mailserver)
* -v : Linking a directory on your host with the magento data of the container
* --link : linking this container be.punk.www.mysql and set it up with the hostname 'db'
* gdemad/nginx-magento : The name of the repository


## Comments

In our example the magento container is linked to the mysql container under the alias db.
This means that you'll have to edit your config file in such a way that the mysql host is no longer localhost but db.


Regards,
Dmitry

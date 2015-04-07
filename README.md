#docker-nginx-magento
Docker NGINX + Magento container
 
## About

This container is optimized for running Magento using NGINX

This container requires a seperate dedicated mysql container (mysql) to run.
You can find mysql either at docker (https://registry.hub.docker.com/_/mysql/)

## Usage by example

### The mysql container

```shell
docker run --name project-mysql -e MYSQL_ROOT_PASSWORD=123 -d mysql
```

### The magento container

```shell
docker run -d --name project -p 80:80 -v ~/projects/test/:/var/www/magento --link project-mysql:db komplizierte/docker-nginx-magento
```

#### XDebug:

```shell
./scripts/xdebug-start.sh
```

```shell
./scripts/xdebug-stop.sh
```

#### Samba Docker shared plugin (for OS X or Windows):

```shell
docker run -dit -v /var/www --name data busybox
docker run --rm -v $(which docker):/docker -v /var/run/docker.sock:/docker.sock svendowideit/samba data
docker run -d --name lp -p 80:80 --volumes-from data --link mysql:db komplizierte/docker-nginx-magent
```

## Comments

In our example the magento container is linked to the mysql container under the alias db.
This means that you'll have to edit your config file in such a way that the mysql host is no longer localhost but db.


Regards,

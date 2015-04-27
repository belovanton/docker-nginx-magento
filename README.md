#docker-nginx-magento
Docker NGINX + Magento container
 
## About

This container is optimized for running Magento using NGINX

This container requires a seperate dedicated mysql container (mysql) to run.
You can find mysql either at docker (https://registry.hub.docker.com/_/mysql/)

## Usage by example

### The mysql container

```shell
docker run --name mysql -e MYSQL_ROOT_PASSWORD=123 -d mysql
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
docker run -d --name project -p 80:80 --volumes-from data --link mysql:db -w /var/www komplizierte/docker-nginx-magento
```

#### Resolve permissions in container

```
chown -R nobody:nogroup project/
```

#### SSH keys for composer

```
killall ssh-agent; eval `ssh-agent`
```

#### Mount data volume

Your data volume (/var/www) should now be accessible at \\<docker ip>\ as 'guest' user (no password)

For example, on OSX, using a typical boot2docker vm:
    goto Go|Connect to Server in Finder
    enter 'cifs://192.168.59.103'
    hit the 'Connect' button
    select the volumes you want to mount
    choose the 'Guest' radiobox and connect

Or on Linux:
    mount -t cifs //192.168.59.103/data /mnt/data -o username=guest

Or on Windows:
    Enter '\\192.168.59.103\data' into Explorer
    Log in as Guest - no password

## Comments

In our example the magento container is linked to the mysql container under the alias db.
This means that you'll have to edit your config file in such a way that the mysql host is no longer localhost but db.


Regards,

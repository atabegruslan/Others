# Architecture

https://www.opc-router.com/what-is-docker

![](/Illustrations/Virtual/docker/docker.png)

**Docker Engine** is the underlying client-server technology that builds and runs containers using Docker's components and services. 

When people refer to Docker, they mean either 
- Docker Engine
	- which comprises the Docker daemon, a REST API 
	- and the CLI that talks to the Docker daemon through the API 
- or the company Docker Inc., which offers various editions of containerization technology around Docker Engine.

Docker Engine vs. **Docker Machine**

- Docker Engine was initially developed for Linux systems, but with version updates extended to operate natively on both Windows and Apple OSes. 
- Docker Machine is a tool to install and manage Docker Engine on several virtual hosts or older versions of Apple and Windows OSes. Commands input through Docker Machine, installed on the local system, will not only create virtual hosts, but also install Docker and configure its clients.

While Docker Engine now runs natively on Windows and Apple, Docker Machine can still be used to manage virtual hosts on both OSes and Linux, or on company networks, in data centers or on cloud providers such as Amazon Web Services, Microsoft Azure and Digital Ocean.

https://www.techtarget.com/searchitoperations/definition/Docker-Engine

**containerd** is the core container runtime of the **Docker Engine**. It leverages **runc** (runtime code).

# WSL

https://github.com/atabegruslan/Others/blob/master/Virtual/wsl.md

# Install

Check Ubuntu version first: `lsb_release -a`

- https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04

- https://www.youtube.com/watch?v=f7hCzwYBIXc
	- https://docs.docker.com/compose/install

OR:
```
sudo yum -y update sudo
yum install -y docker
```

OR:
```
sudo apt-get update sudo
apt-get install docker.io
```

OR for MAC:
- https://docs.docker.com/docker-for-mac/install
	- You might need to get pass this permission problem: https://www.howtogeek.com/205393/gatekeeper-101-why-your-mac-only-allows-apple-approved-software-by-default/

Now docker commands are available to you.
```
sudo service docker start
docker info

sudo groupadd docker sudo gpasswd -a $USER docker sudo usermod -a -G docker

${user} sudo service docker restart 
# OR reboot physically
```

---

# Dockerize various things

- Dockerize various things: https://docs.docker.com/samples/
- Laravel:
	- Simple: https://github.com/Ruslan-Aliyev/job_test_laravel_mysql_fruit_order_dockerized
	- Full: https://github.com/Ruslan-Aliyev/laravel_dockerized
- WP: https://github.com/Ruslan-Aliyev/wordpress_dockerized
- Node: https://github.com/Ruslan-Aliyev/nodejs_dockerized
- Python 
	- FastAPI: https://github.com/Ruslan-Aliyev/job_test_python_fastapi_dockerized
	- Microservices: https://github.com/Ruslan-Aliyev/Microservices-2_Dockerized_Pythons
- Spring Boot: https://github.com/Ruslan-Aliyev/Spring-Boot-CRUD_Dockerized
- Simple Hello World: https://github.com/Ruslan-Aliyev/html_dockerized

## Dockerize Nginx

- https://codeburst.io/get-started-with-nginx-on-docker-907e5c0c9f3a 
- https://medium.com/myriatek/using-docker-to-run-a-simple-nginx-server-75a48d74500b 
- https://www.docker.com/blog/how-to-use-the-official-nginx-docker-image
- https://www.tutorialspoint.com/docker/building_web_server_docker_file.htm
- https://www.geeksforgeeks.org/how-to-build-a-web-server-docker-file
- https://medium.com/myriatek/using-docker-to-run-a-simple-nginx-server-75a48d74500b

## Test projects:

- https://writing.pupius.co.uk/apache-and-php-on-docker-44faef
- https://github.com/nishanttotla/DockerStaticSite
- https://semaphoreci.com/community/tutorials/dockerizing-a-php-application

---

# Tutorials

- https://youtube.com/playlist?list=PLCakfctNSHkGYdA82WDUKF3WGyONpGiEw
- https://www.youtube.com/playlist?list=PL16WqdAj66SBSLZ2-TrZ5q_39UhtKyL9U
- https://www.youtube.com/playlist?list=PLoYCgNOIyGAAzevEST2qm2Xbe3aeLFvLc
- Automation: https://www.youtube.com/playlist?list=PLhW3qG5bs-L99pQsZ74f-LC-tOEsBp2rK
- https://www.youtube.com/playlist?list=PLea0WJq13cnDsF4MrbNaw3b4jI0GT9yKt
	- http://wiki.zenoss.org/download/core/drich_slides/DockerSlides.pdf
- https://www.youtube.com/watch?v=T25Z4CUwYjE
- https://www.youtube.com/playlist?list=PLillGF-Rfqbb6vZqT-Lzi9Al_noaY5LAs
- https://www.youtube.com/watch?v=YFl2mCHdv24&list=PL_HVsP_TO8z7aey-lCMe64BIx3VEfvPdn
- https://rominirani.com/docker-tutorial-series-a7e6ff90a
- https://docs.docker.com/develop/develop-images/dockerfile_best-practices/
- https://www.youtube.com/watch?v=8gEs_zefNYA
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Virtual/docker/DockerSlides.pdf

# Official Sites

- https://get.docker.com
- https://docs.docker.com

# Cheatsheets

- https://www.linode.com/docs/applications/containers/docker-commands-quick-reference-cheat-sheet
- https://github.com/wsargent/docker-cheat-sheet#instructions
- https://kapeli.com/cheat_sheets/Dockerfile.docset/Contents/Resources/Documents/index
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Virtual/docker/docker_cheatsheet_1.pdf
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Virtual/docker/docker_cheatsheet_2.pdf

# Repository

- https://hub.docker.com

## DockerHub

- https://ropenscilabs.github.io/r-docker-tutorial/04-Dockerhub.html

## Push to DockerHub

- https://github.com/Ruslan-Aliyev/html_dockerized?tab=readme-ov-file#push-to-dockerhub

# Fiddles

- https://labs.play-with-docker.com

# Remove Images and Containers

```
# List all containers (only IDs)
docker ps -aq
# Stop all running containers
docker stop $(docker ps -aq)
# Remove all containers
docker rm $(docker ps -aq)
# Remove all images
docker rmi $(docker images -q)
```

---

# Common issues

- https://markpatton.cloud/2020/08/12/error-when-running-docker-on-windows-after-install-fixed
- https://devops.stackexchange.com/questions/9505/what-is-the-difference-between-php-cli-and-php-fpm-why-2-php-variants-and-why-c

## Root priviledge issue

- https://dzone.com/articles/docker-without-root-privileges * 
- https://www.redhat.com/en/blog/understanding-root-inside-and-outside-container *
- https://betterprogramming.pub/running-a-container-with-a-non-root-user-e35830d1f42a 
- https://medium.com/@mccode/processes-in-containers-should-not-run-as-root-2feae3f0df3b
- https://docs.docker.com/install/linux/linux-postinstall/#manage-docker-as-a-non-root-user
- https://betterprogramming.pub/running-a-container-with-a-non-root-user-e35830d1f42a
- https://medium.com/@mccode/processes-in-containers-should-not-run-as-root-2feae3f0df3b

---

# Swarms

1. https://www.youtube.com/watch?v=bU2NNFJ-UXA
2. https://www.youtube.com/watch?v=3-7gZS4ePak

- https://marekbosman.com/site/access-virtualbox-image-from-the-command-line  
- https://dev.to/gbenga700/deploying-a-web-application-on-docker-swarm-2l26 
- http://www.jadejaber.com/articles/hello-docker-with-swarm-mono-node
- https://www.sumologic.com/glossary/docker-swarm/
- https://vsupalov.com/difference-docker-compose-and-docker-stack
- https://docs.docker.com/engine/swarm
- https://github.com/swarmstack/swarmstack
- https://betterprogramming.pub/how-to-differentiate-between-docker-images-containers-stacks-machine-nodes-and-swarms-fd5f7e34eb9f
- https://www.youtube.com/watch?v=Tm0Q5zr3FL4
- https://www.youtube.com/watch?v=74p7csxKN8M
- https://www.youtube.com/watch?v=Yq-SQTESTJE
- https://stackoverflow.com/questions/44500394/docker-swarms-and-stacks-whats-the-difference/44500583#44500583

> Docker swarm is a Clustering and orchestration tool. It is used for scheduling containers across multiple nodes. You can combine multiple nodes as a cluster and then send "docker run" command to this cluster. Docker stack is a collection of services that make up an application in a specific environment. The extension of stack file is yaml (yml also).

To get started setting up VMs and a Swarm

- https://www.youtube.com/watch?v=FeJyAjDoLEw
- https://www.youtube.com/watch?v=FS-HJTM6Oec
- https://www.youtube.com/watch?v=GgDEwQXpZI8 So use Host Only Network
- https://www.youtube.com/watch?v=Tm0Q5zr3FL4
- https://docs.docker.com/engine/swarm/swarm-tutorial/create-swarm/

## Load Balancing

- https://www.quora.com/How-do-I-run-a-website-on-multiple-servers
- https://serverfault.com/questions/774512/how-to-host-a-single-website-on-multiple-servers

- https://www.youtube.com/watch?v=K0Ta65OqQkY
- https://www.youtube.com/watch?v=R39VRocQtrQ
- https://www.youtube.com/watch?v=pdBHsA2FG48
- https://upcloud.com/community/tutorials/load-balancing-docker-swarm-mode

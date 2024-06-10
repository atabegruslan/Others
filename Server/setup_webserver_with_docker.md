# Setup Web Server via Docker

- https://medium0.com/@vi1996ash/steps-to-build-apache-web-server-docker-image-1a2f21504a8e
- https://www.youtube.com/watch?v=7GTYB8RVYBc <sup>Very Good</sup>
	- https://www.the-digital-life.com/webserver-linux
	- https://hub.docker.com/r/linuxserver/swag
	- https://docs.linuxserver.io/general/swag
- https://www.youtube.com/watch?v=_trJf3GbZXg
- https://www.tecmint.com/install-apache-web-server-in-a-docker-container/amp/
- https://www.geeksforgeeks.org/setup-web-server-over-docker-container-in-linux/amp/
- https://www.tutorialspoint.com/docker/building_web_server_docker_file.htm

1. Install Docker and Docker-Compose: https://github.com/Ruslan-Aliyev/Docker#install
2. Check with `docker --version` and `docker-compose --version`
3. Create and give permissions for the needed directories
4. Make `docker-compose.yaml`. Easiest to copy it over. Note: https://adminhacks.com/scp-not-port-22.html EG: `scp -P {remote-port} {local-path}/docker-compose.yaml {remote-username}@{remote-host-domain}:{remote-path}/docker-compose.yaml`
5. `docker-compose up`

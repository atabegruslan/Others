# Laravel Homestead

## Tutorials

- https://www.youtube.com/playlist?list=PL41lfR-6DnOqzgYCAOIBTnMUFNdLtsKuW
- https://laravel.com/docs/8.x/homestead

1. Install Vagrant and Virtual Box

- https://www.vagrantup.com/downloads.html
	- https://www.vagrantup.com/docs/cli
- https://www.virtualbox.org/wiki/Downloads

2. In terminal:
```
vagrant box add laravel/homestead
git clone https://github.com/laravel/homestead.git ~/Homestead
cd Homestead
git checkout v11.2.2
bash init.sh
```

3. In `Homestead.yaml`
```
folders:
    - map: ~/code
      to: /home/vagrant/code

sites:
    - map: project.dev
      to: /home/vagrant/code/project/public

databases:
    - project
```

For many sites:

![](/Illustrations/Virtual/homestead_many_sites.PNG)

4. In terminal again:
```
vagrant up
vagrant ssh
composer global require laravel/installer
laravel new project
```

## DB:

- https://laravel.com/docs/8.x/homestead#connecting-to-databases
- https://www.youtube.com/watch?v=9-vHcy5esAo
- https://dbeaver.io/download/
- Defaults: 192.168.10.10:3306 homestead/secret

## Common issues

- Mapping port from Swoole out to Homestead: https://nickpoulos.medium.com/installing-swoole-on-laravel-homestead-ac79a804984a

## Commonly encountered problems:

- https://laracasts.com/discuss/channels/general-discussion/box-laravelhomestead-could-not-be-found-2?page=1#reply=640644
- Restarting Vagrant https://stackoverflow.com/questions/24274387/using-laravel-homestead-no-input-file-specified
- Composer problem https://stackoverflow.com/questions/36107400/composer-update-memory-limit#comment105321195_36107762

---

# More about Vagrant

- https://en.m.wikipedia.org/wiki/Vagrant_(software)
- https://www.quora.com/Whats-the-difference-between-a-VM-Docker-and-Vagrant/answer/Varun-Risbud?ch=10&oid=24924878&share=c0cdb983&srid=hJcklY&target_type=answer

# Laravel Log Tailing (Real-Time)

To monitor Laravel logs in real-time, you can use `tail -f`.

## Basic Command

```bash
tail -f storage/logs/laravel.log

# Datewise
tail -f storage/logs/laravel-$(date +%F).log

# checking
php artisan tail

#docker with tail

docker exec -it laravel-app-2 tail -f storage/logs/laravel.log


# 🐳 Docker + Laravel Commands Cheat Sheet

This cheat sheet covers **Docker basics**, **daily-use commands**, and **Laravel inside Docker** (logs, artisan, migrations, etc.).

---

## 🔥 Daily-Use Docker Commands (Quick Reference)

```bash
# List containers
docker ps                # running
docker ps -a             # all

# Start / Stop / Restart
docker start <container_id>
docker stop <container_id>
docker restart <container_id>

# Run a new container
docker run -d --name <container_name> -p 8080:80 <image_name>

# Logs
docker logs -f <container_id>

# Access container shell
docker exec -it <container_id> sh
# or
docker exec -it <container_id> bash

# Build image
docker build -t <image_name>:<tag> .

# Cleanup unused stuff
docker system prune -a


docker images                           # list images
docker pull <image_name>:<tag>          # pull image
docker build -t <image_name>:<tag> .    # build from Dockerfile
docker rmi <image_id>                   # remove image

docker ps                               # running containers
docker ps -a                            # all containers
docker start <container_id>             # start container
docker stop <container_id>              # stop container
docker restart <container_id>           # restart container
docker rm <container_id>                # remove container
docker run -d --name <name> -p 8080:80 <image>   # run container
docker logs <container_id>              # view logs
docker logs -f <container_id>           # follow logs (like tail -f)
docker exec -it <container_id> sh       # enter container (sh)
docker exec -it <container_id> bash     # enter container (bash)
docker exec -it <container_id> <cmd>    # run a command

docker volume ls                        # list volumes
docker volume rm <volume_name>          # remove volume

docker network ls                       # list networks
docker network create <name>            # create network
docker network connect <net> <ctr>      # connect container
docker network disconnect <net> <ctr>   # disconnect container

docker-compose up -d                    # start services
docker-compose down                     # stop services
docker-compose logs -f                  # follow logs
docker-compose up --build -d            # rebuild + start
docker-compose exec app bash            # open shell in "app" service

# Inside Docker container
docker exec -it <container_name> tail -f storage/logs/laravel.log
# If daily logs
docker exec -it <container_name> tail -f storage/logs/laravel-$(date +%F).log
# Always latest log
docker exec -it <container_name> sh -c "tail -f \$(ls -t storage/logs/laravel*.log | head -1)"
# With Docker Compose
docker-compose exec app tail -f storage/logs/laravel.log


# Run artisan inside container
docker exec -it <container_name> php artisan <command>

# Common examples:
docker exec -it <container_name> php artisan migrate
docker exec -it <container_name> php artisan db:seed
docker exec -it <container_name> php artisan cache:clear
docker exec -it <container_name> php artisan config:cache

docker exec -it <container_name> composer install
docker exec -it <container_name> composer update

docker exec -it <container_name> npm install
docker exec -it <container_name> npm run dev
docker exec -it <container_name> yarn dev

# Enter MySQL container
docker exec -it <mysql_container> mysql -u root -p
# Import a SQL file
docker exec -i <mysql_container> mysql -u root -p < db.sql

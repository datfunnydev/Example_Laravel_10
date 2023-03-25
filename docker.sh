docker-compose down
docker system prune -a
docker build ./docker
docker-compose up -d
#docker-compose exec webserver bash #connect webserver terminal
#docker exec -it mysql_80 mysql -uroot -p #connect database terminal
#docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql_80 #get ip database

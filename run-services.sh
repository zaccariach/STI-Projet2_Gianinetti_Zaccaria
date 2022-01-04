#!/bin/bash

# clean old env
docker stop sti_project
docker rm -f sti_project

# download image
docker run -ti -d -p 8090:80 --name sti_project --hostname sti arubinst/sti:project2018

#copy site and database folder into container
docker cp site/. sti_project:/usr/share/nginx/

# Need to change permissions, else database is only readonly 
docker exec -u root sti_project bash -c 'chmod 777 -R /usr/share/nginx/databases/'

#run web service
docker exec -u root sti_project service nginx start
#run php service
docker exec -u root sti_project service php5-fpm start
FROM debian:bullseye
ARG MAX_EXECUTION_TIME
ARG PROJECT_NAME

# Installation de Nginx
RUN apt-get update||true
RUN apt-get install -y nginx

# Configuration de Nginx
ADD nginx.conf /etc/nginx/
RUN sed "/fastcgi_read_timeout 60s;/c\  fastcgi_read_timeout ${MAX_EXECUTION_TIME}s;" -i /etc/nginx/nginx.conf
ADD project.conf /etc/nginx/sites-available/
RUN sed "/server_name symfony.dev;/c\  server_name ${PROJECT_NAME};" -i /etc/nginx/sites-available/project.conf
RUN echo "upstream php-upstream { server ${PROJECT_NAME}-php:9000; }" > /etc/nginx/conf.d/upstream.conf
RUN usermod -u 1000 www-data

# Configuration du virtualhost
RUN ln -s /etc/nginx/sites-available/project.conf /etc/nginx/sites-enabled/project
RUN rm /etc/nginx/sites-enabled/default

# Lancement de Nginx
CMD ["nginx"]

# Exposition des ports HTTP/HTTPS
EXPOSE 80
EXPOSE 443

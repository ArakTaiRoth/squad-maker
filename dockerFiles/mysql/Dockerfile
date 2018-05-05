FROM mysql:5.7

EXPOSE 3306

COPY ./my.cnf /etc/mysql/conf.d/my.cnf

ADD ./squadMaker.sql /docker-entrypoint-initdb.d

FROM centos:6.8

RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm \
    && rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm \
    && yum install -y php70w php70w-intl php70w-opcache php70w-mysql php70w-pecl-memcached \
    && yum install -y libevent libevent-devel php70w-mbstring mod_ssl openssl \
    && yum install -y httpd vixie-cron python-pip jq \
    && pip install awscli

ADD dockerFiles/php/conf/httpd.conf  /etc/httpd/conf/httpd.conf
ADD ./squadMaker /squadMaker

RUN chmod 755 -R /squadMaker/webroot/files/uploads \
    && chown -R apache:apache /squadMaker/webroot/files/uploads

WORKDIR /squadMaker

EXPOSE 443

ENTRYPOINT ["/bin/bash", "-c", "service crond start; httpd -D FOREGROUND"]

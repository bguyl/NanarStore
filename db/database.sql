create database if not exists nanarstore character set utf8 collate utf8_unicode_ci;
use nanarstore;

grant all privileges on nanarstore.* to 'nanarstore_user'@'localhost' identified by 'nanarstore_pass';
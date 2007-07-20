-- 19/07/2007
DELETE FROM topology WHERE topology_page = '401';
DELETE FROM topology WHERE topology_page = '40101';
DELETE FROM topology WHERE topology_page = '40102';

TRUNCATE TABLE `view_city`;
TRUNCATE TABLE `view_country`;
ALTER TABLE `view_city` DROP FOREIGN KEY `view_city_ibfk_1`;
ALTER TABLE `extended_host_information`  DROP FOREIGN KEY `extended_host_information_ibfk_2`;
ALTER TABLE `extended_host_information`  DROP FOREIGN KEY `extended_host_information_ibfk_3`;
ALTER TABLE `hostgroup`  DROP FOREIGN KEY `hostgroup_ibfk_1`;
ALTER TABLE `hostgroup`  DROP FOREIGN KEY `hostgroup_ibfk_2`;
ALTER TABLE `servicegroup`  DROP FOREIGN KEY `servicegroup_ibfk_1`;
ALTER TABLE `servicegroup`  DROP FOREIGN KEY `servicegroup_ibfk_2`;

ALTER TABLE `extended_host_information` DROP `country_id` , DROP `city_id` ;
ALTER TABLE `hostgroup` DROP `country_id` ,DROP `city_id` ;
ALTER TABLE `servicegroup` DROP `country_id` ,DROP `city_id` ;

DROP TABLE `view_city`;
DROP TABLE `view_country`;
DROP TABLE `view_map`;

DELETE FROM `topology_JS` WHERE `id_page` = 6;
DELETE FROM `topology_JS` WHERE `id_page` =  601;
DELETE FROM `topology_JS` WHERE `id_page` =  60101;
DELETE FROM `topology_JS` WHERE `id_page` =  60102;
DELETE FROM `topology_JS` WHERE `id_page` =  60103;

DROP TABLE 'view_city';
DROP TABLE 'view_country';
DROP TABLE 'view_map';

ALTER TABLE `giv_graphs_template`
  DROP `title`,
  DROP `img_format`,
  DROP `period`,
  DROP `step`,
  DROP `default_tpl2`;
  
ALTER TABLE `giv_components_template`
  DROP `ds_legend`,
  DROP `default_tpl2`;
  
ALTER TABLE `giv_graphs_template` ADD `split_component` ENUM("0", "1") NOT NULL DEFAULT '0' AFTER `stacked` ;
ALTER TABLE `giv_graphs_template` ADD `base` INT NULL DEFAULT '1000' AFTER `height` ;

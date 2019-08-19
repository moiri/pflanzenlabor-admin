ALTER TABLE `impressions_fields_type` ADD `id_impressions_content_type` INT UNSIGNED ZEROFILL NOT NULL AFTER `name`, ADD INDEX (`id_impressions_content_type`);
UPDATE `impressions_fields_type` SET `id_impressions_content_type` = '0000000003' WHERE `impressions_fields_type`.`id` = 0000000005;
UPDATE `impressions_fields_type` SET `id_impressions_content_type` = '0000000003' WHERE `impressions_fields_type`.`id` = 0000000006;
UPDATE `impressions_fields_type` SET `id_impressions_content_type` = '0000000004' WHERE `impressions_fields_type`.`id` = 0000000007;
UPDATE `impressions_fields_type` SET `id_impressions_content_type` = '0000000004' WHERE `impressions_fields_type`.`id` = 0000000008;
ALTER TABLE `impressions_fields_type` ADD  CONSTRAINT `fk_impressions_fields_type_id_impressions_content_type` FOREIGN KEY (`id_impressions_content_type`) REFERENCES `impressions_content_type`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

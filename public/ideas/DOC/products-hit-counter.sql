ALTER TABLE `products` ADD `hit_counter` INT  NULL  DEFAULT NULL  AFTER `product_availability`;
ALTER TABLE `products` CHANGE `hit_counter` `hit_counter` INT(7)  NULL  DEFAULT '0';
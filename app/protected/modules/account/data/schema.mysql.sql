CREATE TABLE `account_users` (
    `UserId` bigint(20) NOT NULL AUTO_INCREMENT,
    `AccountTypeId` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `account_users`
  ADD CONSTRAINT `user_account_id` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

CREATE TABLE `account_types` (
    `Id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `Type` varchar(150) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `Type` (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `account_types_limits` (
    `Id` bigint(20) unsigned NOT NULL,
    `AccountTypeId` bigint(20) unsigned NOT NULL,
    `LimitsKey` varchar(32) NOT NULL,
    `LimitsList` text,
    PRIMARY KEY (`Id`),
    UNIQUE KEY (`AccountTypeId`, `LimitsKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO account_types VALUES (1, 'admin'), (2, 'default'), (3, 'default_temp'), (4, 'paid');

INSERT INTO account_users VALUES (1, 1), (2, 2), (3, 3);

INSERT INTO account_types_limits VALUES (1, 1, 'Site', '[]'), (2, 2, 'Site', '[ {"0":"priority","1":"numerical","integerOnly":true,"min":100,"max":1000},{"0":"maxURLs","1":"numerical","integerOnly":true,"min":1,"max":200},{"0":"maxURLsFromPage","1":"numerical","integerOnly":true,"min":1,"max":50},{"0":"maxResources","1":"numerical","integerOnly":true,"min":1,"max":200},{"0":"maxErrors","1":"numerical","integerOnly":true,"min":1,"max":400},{"0":"maxResourceSize","1":"numerical","integerOnly":true,"min":1,"max":1000000},{"0":"processingDelay","1":"numerical","integerOnly":true,"min":500,"max":500},{"0":"requestDelay","1":"numerical","integerOnly":true,"min":500,"max":500}]'), (3, 3, 'Site', '[{"0":"priority","1":"numerical","integerOnly":true,"min":100,"max":1000},{"0":"maxURLs","1":"numerical","integerOnly":true,"min":1,"max":200},{"0":"maxURLsFromPage","1":"numerical","integerOnly":true,"min":1,"max":50},{"0":"maxResources","1":"numerical","integerOnly":true,"min":1,"max":200},{"0":"maxErrors","1":"numerical","integerOnly":true,"min":1,"max":400},{"0":"maxResourceSize","1":"numerical","integerOnly":true,"min":1,"max":1000000},{"0":"processingDelay","1":"numerical","integerOnly":true,"min":500,"max":500},{"0":"requestDelay","1":"numerical","integerOnly":true,"min":500,"max":500}]'), (4, 4, 'Site', '[{"0":"priority","1":"numerical","integerOnly":true,"min":100,"max":1000},{"0":"maxURLs","1":"numerical","integerOnly":true,"min":1,"max":100},{"0":"maxURLsFromPage","1":"numerical","integerOnly":true,"min":1,"max":100},{"0":"maxResources","1":"numerical","integerOnly":true,"min":1,"max":100},{"0":"maxErrors","1":"numerical","integerOnly":true,"min":1,"max":100},{"0":"maxResourceSize","1":"numerical","integerOnly":true,"min":1,"max":100},{"0":"processingDelay","1":"numerical","integerOnly":true,"min":1000,"max":10000},{"0":"requestDelay","1":"numerical","integerOnly":true,"min":500,"max":10000}]');
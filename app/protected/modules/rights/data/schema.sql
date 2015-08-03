drop table if exists AuthAssignment;
drop table if exists AuthItemChild;
drop table if exists Rights;
drop table if exists AuthItem;

create table AuthItem
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
);

create table AuthItemChild
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references AuthItem (name) on delete cascade on update cascade,
   foreign key (child) references AuthItem (name) on delete cascade on update cascade
);

CREATE TABLE `AuthAssignment` (
    `itemname` varchar(64) NOT NULL,
    `userid` bigint(20) NOT NULL,
    `bizrule` text,
    `data` text,
    PRIMARY KEY (`itemname`,`userid`),
    FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
);

create table Rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
);

drop table if exists users_rights_defaults;
CREATE TABLE `users_rights_defaults` (
  `Key` varchar(32) NOT NULL,
  `RightsList` text,
  PRIMARY KEY (`Key`)
);

drop table if exists users_sites_rights;
CREATE TABLE `users_sites_rights` (
    `Site_Id` varchar(32) NOT NULL,
    `User_Id` bigint(20) NOT NULL,
    `Rights` int(32) unsigned NOT NULL,
    PRIMARY KEY (`Site_Id`,`User_Id`),
  FOREIGN KEY (`User_Id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);
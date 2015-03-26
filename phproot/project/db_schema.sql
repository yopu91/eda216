-- Init the database with the correct schema.

set foreign_key_checks = false;

drop table if exists customer;
create table customer (
    name varchar(255) not null,
    address varchar(255) not null,
    primary key (name)
);

drop table if exists cookieType;
create table cookieType (
    name varchar(255) not null,
    primary key (name)
);

drop table if exists ingredientType;
create table ingredientType (
    name varchar(255) not null,
    primary key (name)
);

drop table if exists customerOrder;
create table customerOrder (
    number integer not null auto_increment,
    customerName varchar(255) not null,
    received datetime not null,
    delivery datetime not null,
    primary key (number),
    foreign key (customerName) references customer(name)
);

drop table if exists orderItem;
create table orderItem (
    orderNumber integer not null,
    cookieName varchar(255) not null,
    quantity integer not null,
    primary key (orderNumber, cookieName),
    foreign key (orderNumber) references customerOrder(number),
    foreign key (cookieName) references cookieType(name)
);

drop table if exists ingredient;
create table ingredient (
    cookieName varchar(255) not null,
    ingredientName varchar(255) not null,
    amount integer not null,
    primary key (cookieName, ingredientName),
    foreign key (cookieName) references cookieType(name),
    foreign key (ingredientName) references ingredientType(name)
);

drop table if exists ingredientDelivery;
create table ingredientDelivery (
    deliveryNumber integer not null auto_increment,
    ingredientName varchar(255) not null,
    amount integer not null,
    delivered datetime not null,
    primary key (deliveryNumber),
    foreign key (ingredientName) references ingredientType(name)
);

drop table if exists productionOrder;
create table productionOrder (
    cookieName varchar(255) not null,
    quantity integer not null,
    primary key (cookieName),
    foreign key (cookieName) references cookieType(name)
);

drop table if exists pallet;
create table pallet (
    barcode varchar(255) not null,
    cookieName varchar(255) not null,
    loadingNumber integer,
    produced datetime not null,
    blocked bool not null default false,
    primary key (barcode),
    foreign key (cookieName) references cookieType(name)
);

drop table if exists location;
create table location (
    name varchar(255) not null,
    primary key (name)
);

drop table if exists palletLocation;
create table palletLocation (
    palletCode varchar(255) not null,
    locationName varchar(255) not null,
    arrived datetime not null,
    foreign key (palletCode) references pallet(barcode),
    foreign key (locationName) references location(name)
);

drop table if exists sample;
create table sample (
    palletCode varchar(255) not null,
    faulty bool not null,
    tested datetime not null,
    primary key (palletCode),
    foreign key (palletCode) references pallet(barcode)
);

set foreign_key_checks = true;


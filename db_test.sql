-- Test data

set foreign_key_checks = false;

delete from customer;
insert into customer (name, address) values
('LED', 'E-huset'),
('Hilbert', 'Mattehuset');

delete from cookieType;
insert into cookieType (name) values
('Gingerbread'),
('Spiddekauga'),
('Shortbread');

delete from ingredientType;
insert into ingredientType (name) values
('Eggs'),
('Flour'),
('Ginger'),
('Baking soda');

delete from customerOrder;
insert into customerOrder (number, customerName, received, delivery) values
(1, 'LED', '2015-03-26', '2015-04-01'),
(2, 'Hilbert', '2015-03-26', '2015-04-01');

delete from orderItem;
insert into orderItem (orderNumber, cookieName, quantity) values
(1, 'Gingerbread', 5),
(1, 'Spiddekauga', 3),
(2, 'Shortbread', 2);

delete from ingredient;
insert into ingredient (cookieName, ingredientName, amount) values
('Gingerbread', 'Flour', 5),
('Gingerbread', 'Ginger', 1),
('Spiddekauga', 'Eggs', 4),
('Shortbread', 'Flour', 3),
('Shortbread', 'Baking soda', 1);

delete from ingredientDelivery;

delete from productionOrder;

delete from pallet;

delete from location;
insert into location (name) values
('Bakery 1'),
('Cold storage'),
('Test lab'),
('Loading bay');

delete from palletLocation;

delete from sample;

set foreign_key_checks = false;


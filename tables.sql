create table FramedContactForm
(
  contactID int auto_increment,
  name      varchar(50)                         not null,
  email     varchar(50)                         not null,
  message   varchar(500)                        not null,
  timestamp timestamp default CURRENT_TIMESTAMP not null,
  constraint contactID_UNIQUE
    unique (contactID)
)
  engine = InnoDB;

alter table FramedContactForm
  add primary key (contactID);

create table FramedProducts
(
  productID    int auto_increment
    primary key,
  name         varchar(50)  null,
  photographer varchar(50)  null,
  category     varchar(50)  null,
  color        varchar(50)  null,
  imageURL     varchar(100) null,
  description  varchar(500) null
)
  engine = InnoDB;

create table FramedUsers
(
  userID        int auto_increment
    primary key,
  firstName     varchar(20)                null,
  lastName      varchar(20)                null,
  username      varchar(20)                null,
  password      varchar(255)               null,
  email         varchar(50)                null,
  role          varchar(20) default 'User' not null,
  publicProfile tinyint(1)  default 0      not null
)
  engine = InnoDB;

create table FramedFavorites
(
  userID    int default 0 not null,
  productID int default 0 not null,
  primary key (userID, productID),
  constraint FramedFavorites_FramedProducts_productID_fk
    foreign key (productID) references FramedProducts (productID),
  constraint FramedFavorites_FramedUsers_userID_fk
    foreign key (userID) references FramedUsers (userID)
)
  engine = InnoDB;

create table FramedOrders
(
  orderID        int auto_increment,
  userID         int                                   not null,
  shippingMethod varchar(20)                           not null,
  name           varchar(50)                           not null,
  stAddress      varchar(50)                           not null,
  stAddress2     varchar(50)                           not null,
  city           varchar(50)                           not null,
  state          varchar(30)                           not null,
  zip            varchar(5)                            not null,
  phone          varchar(12)                           not null,
  timestamp      timestamp   default CURRENT_TIMESTAMP not null,
  status         varchar(30) default 'Processing'      null,
  constraint FramedOrders_orderID_uindex
    unique (orderID),
  constraint FramedOrders_FramedUsers_userID_fk
    foreign key (userID) references FramedUsers (userID)
)
  engine = InnoDB;

alter table FramedOrders
  add primary key (orderID);

create table FramedOrderItems
(
  orderID   int         null,
  productID int         null,
  frame     varchar(20) not null,
  constraint FramedOrderItems_FramedOrders_orderID_fk
    foreign key (orderID) references FramedOrders (orderID),
  constraint FramedOrderItems_FramedProducts_productID_fk
    foreign key (productID) references FramedProducts (productID)
)
  engine = InnoDB;

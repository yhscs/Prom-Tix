# Prom-Tix
A web app for students to choose their seats at prom.

The following MySQL queries will create the table necessary for this app.

Table for guests not attending the school
```SQL
CREATE TABLE `promGuests` (
  `ID` int(11) NOT NULL,
  `Table` int(11) NOT NULL,
  `Chair` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Shirt` varchar(3) NOT NULL
)
```

Table for tables and number of open seats at each table
```SQL
CREATE TABLE `promTables` (
  `Table` int(11) NOT NULL,
  `Open` int(11) NOT NULL
) 
```
Table for students who attend the school
```SQL
CREATE TABLE `promTix` (
  `Table` int(11) NOT NULL,
  `Chair` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Grade` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Payment` varchar(255) NOT NULL,
  `Guest` varchar(255) NOT NULL,
  `Payor` varchar(255) NOT NULL,
  `Shirt` varchar(3) NOT NULL,
  `GuestShirt` varchar(3) NOT NULL,
  `Ticket` int(11) NOT NULL
)
```

```SQL
ALTER TABLE `promGuests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `promTables`
  ADD PRIMARY KEY (`Table`);

ALTER TABLE `promTix`
  ADD PRIMARY KEY (`Table`,`Chair`);

ALTER TABLE `promGuests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
```

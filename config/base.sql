CREATE TABLE users (
  id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name TEXT UNIQUE NOT NULL,
  domain TEXT UNIQUE NOTL NULL,
  data TEXT
);


INSERT INTO users ("ZIOBRO","xd","22-22-2222")
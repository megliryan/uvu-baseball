USE mmhs_baseball;
CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(32),
  email VARCHAR(255),
  password_hash VARCHAR(255),
  is_admin BOOL
  );

SELECT * from users;

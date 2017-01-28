DROP TABLE payment;
DROP TABLE expense;
DROP TABLE employee;
DROP TABLE job;
DROP TABLE student;
DROP TABLE course;

CREATE TABLE course (
  id varchar(10) NOT NULL,
  course_name varchar(128) NOT NULL,
  tuition_fee double NOT NULL,
  archive boolean NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE student (
  id int NOT NULL,
  first_name varchar(128) NOT NULL,
  middle_name varchar(128),
  last_name varchar(128) NOT NULL,
  type varchar(8) NOT NULL,
  birthday date NOT NULL,
  gender varchar(6) NOT NULL,
  discount_given double,
  enrollment_date date NOT NULL,
  address text NOT NULL,
  course_id varchar(10) NOT NULL,
  email varchar(128),
  emergency_contact_no varchar(12) NOT NULL,
  emergency_contact_name varchar(128) NOT NULL,
  emergency_contact_relation varchar(128) NOT NULL,
  archive boolean NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (course_id) REFERENCES course(id)
);

CREATE TABLE job (
  id varchar(10) NOT NULL,
  title varchar(128) NOT NULL,
  rank int NOT NULL,
  salary double NOT NULL,
  archive boolean NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE employee (
  id int NOT NULL,
  first_name varchar(128) NOT NULL,
  middle_name varchar(128),
  last_name varchar(128) NOT NULL,
  birthday date NOT NULL,
  address text NOT NULL,
  job_id varchar(10) NOT NULL,
  email varchar(128) NOT NULL,
  contact_no varchar(12),
  gender varchar(6) NOT NULL,
  password text NOT NULL,
  date_employed date NOT NULL,
  salary double NOT NULL,
  authentication varchar(10) NOT NULL,
  archive boolean NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (job_id) REFERENCES job(id)
);

CREATE TABLE payment (
  id varchar(13) NOT NULL,
  date_recorded date NOT NULL,
  amount float NOT NULL,
  employee_id int NOT NULL,
  student_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (employee_id) REFERENCES employee(id),
  FOREIGN KEY (student_id) REFERENCES student(id)
);

CREATE TABLE expense (
  id varchar(13) NOT NULL,
  date_recorded date NOT NULL,
  amount float NOT NULL,
  receipt_no varchar(128) NOT NULL,
  details text NOT NULL,
  employee_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (employee_id) REFERENCES employee(id)
);

INSERT INTO job VALUES ("5886e1158baaf", "Academic Vice-President", 1, 99999, 0);
INSERT INTO employee VALUES (999999999, "Paul Angelo", "S", "Silvestre", '2017-01-01', 'None', '5886e1158baaf', 'test@somewhere.com', '639999999999', 'Male', '$2y$10$JIP2qbOhNpsexZprLWRi/uDtz7Ki.2tfpxkTWZIdUEeIHAF7jogay', '2016-01-01', 99999, 'admin', 0);
-- DevXcript Student Portal - Database (MySQL / MariaDB)
-- Import: phpMyAdmin > Import, or:  mysql -u root < database/schema.sql
CREATE DATABASE IF NOT EXISTS student_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_portal;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS timetable, datesheet, invoices, results, attendance, assessments, enrollments, courses, students, users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(100) NOT NULL,
  email         VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          ENUM('student','admin') NOT NULL DEFAULT 'student',
  created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE students (
  user_id       INT UNSIGNED PRIMARY KEY,
  roll_no       VARCHAR(30) NOT NULL UNIQUE,
  faculty       VARCHAR(150) NOT NULL DEFAULT 'Faculty of Information Technology and Computer Science',
  program       VARCHAR(100) NOT NULL DEFAULT 'BS Computer Science',
  total_credits SMALLINT UNSIGNED NOT NULL DEFAULT 133,
  CONSTRAINT fk_students_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE courses (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug        VARCHAR(60) NOT NULL UNIQUE,
  code        VARCHAR(20) NOT NULL UNIQUE,
  title       VARCHAR(150) NOT NULL,
  instructor  VARCHAR(100) NOT NULL,
  credits     DECIMAL(2,1) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE enrollments (
  id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id   INT UNSIGNED NOT NULL,
  course_id INT UNSIGNED NOT NULL,
  term      VARCHAR(30) NOT NULL,
  status    ENUM('active','withdraw') NOT NULL DEFAULT 'active',
  UNIQUE KEY uq_enroll (user_id, course_id, term),
  CONSTRAINT fk_enr_user   FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
  CONSTRAINT fk_enr_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE assessments (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  enrollment_id INT UNSIGNED NOT NULL,
  type          VARCHAR(60) NOT NULL,
  obtained      DECIMAL(5,2) NOT NULL,
  total         DECIMAL(5,2) NOT NULL,
  CONSTRAINT chk_marks CHECK (obtained >= 0 AND total > 0 AND obtained <= total),
  CONSTRAINT fk_asm_enr FOREIGN KEY (enrollment_id) REFERENCES enrollments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE attendance (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  enrollment_id INT UNSIGNED NOT NULL UNIQUE,
  total_classes SMALLINT UNSIGNED NOT NULL,
  present       SMALLINT UNSIGNED NOT NULL,
  CONSTRAINT chk_att CHECK (present <= total_classes),
  CONSTRAINT fk_att_enr FOREIGN KEY (enrollment_id) REFERENCES enrollments(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE results (
  id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id        INT UNSIGNED NOT NULL,
  term           VARCHAR(30) NOT NULL,
  term_no        TINYINT UNSIGNED NOT NULL,
  grading_points DECIMAL(7,2) NOT NULL,
  cumulative_gp  DECIMAL(7,2) NOT NULL,
  cr             TINYINT UNSIGNED NOT NULL,
  total_cr       SMALLINT UNSIGNED NOT NULL,
  sgpa           DECIMAL(3,2) NOT NULL,
  cgpa           DECIMAL(3,2) NOT NULL,
  UNIQUE KEY uq_result (user_id, term),
  CONSTRAINT fk_res_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE invoices (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id     INT UNSIGNED NOT NULL,
  term        VARCHAR(30) NOT NULL,
  semester    VARCHAR(20) NOT NULL,
  challan_id  VARCHAR(20) NOT NULL UNIQUE,
  scholarship TINYINT UNSIGNED NOT NULL DEFAULT 0,
  fee         INT UNSIGNED NOT NULL,
  fine        INT UNSIGNED NOT NULL DEFAULT 0,
  status      ENUM('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  CONSTRAINT fk_inv_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE datesheet (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  term       VARCHAR(30) NOT NULL,
  subject    VARCHAR(100) NOT NULL,
  instructor VARCHAR(100) NOT NULL,
  exam_date  DATE NOT NULL,
  start_time TIME NOT NULL,
  end_time   TIME NOT NULL,
  venue      VARCHAR(30) NOT NULL
) ENGINE=InnoDB;

-- day_of_week: 1=Mon ... 7=Sun
CREATE TABLE timetable (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  course_id   INT UNSIGNED NOT NULL,
  day_of_week TINYINT UNSIGNED NOT NULL,
  start_time  TIME NOT NULL,
  end_time    TIME NOT NULL,
  room        VARCHAR(30) NOT NULL,
  class_type  ENUM('Lecture','Lab') NOT NULL DEFAULT 'Lecture',
  CONSTRAINT fk_tt_course FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------- Sample data ----------------
-- Demo logins:  babar@devxcript.com / Student@123   |   admin@devxcript.com / Admin@123
INSERT INTO users (id,name,email,password_hash,role) VALUES
 (1,'Babar Azam','babar@devxcript.com','$2y$10$HObCGz8ZwyABFAZAxDAD/exPOiFylt9nxBfaO4ztyxLAiYkYS61Ky','student'),
 (2,'Admin User','admin@devxcript.com','$2y$10$HgZSIxYUZ306sol/33HF4ObzjbOgHt7ly/gP06fScCAfpfI0PURae','admin');

INSERT INTO students (user_id,roll_no) VALUES (1,'L1PCBCS56');

INSERT INTO courses (id,slug,code,title,instructor,credits) VALUES
 (1,'web-application','CSSE3143','Web Application Development','Asad Kamal',3.0),
 (2,'operating-system-lab','CSCS3551','Operating Systems - Lab','Qaisar Aslam',1.0),
 (3,'software-engineering','CSSE3113','Introduction to Software Engineering','Muhammad Basit Ali Gillani',3.0),
 (4,'operating-system','CSCS3553','Operating Systems','Dr Adnan Ghafoor',3.0);

INSERT INTO enrollments (id,user_id,course_id,term,status) VALUES
 (1,1,1,'Spring 2025','active'),(2,1,2,'Spring 2025','active'),
 (3,1,3,'Spring 2025','active'),(4,1,4,'Spring 2025','active');

INSERT INTO assessments (enrollment_id,type,obtained,total) VALUES
 (1,'Class Participation',9,10),(1,'Assignment',8,10),(1,'Quiz',19,20),(1,'Mids',17,20),(1,'Final',32,40),
 (2,'Lab Exercise',8,10),(2,'Assignment',7,10),(2,'Quiz',17,20),(2,'Midterm',14,20),(2,'Final',28,40),
 (3,'Lab Exercise',7,10),(3,'Assignment',6,10),(3,'Quiz',16,20),(3,'Midterm',15,20),(3,'Final',25,40),
 (4,'Class Participation',9,10),(4,'Assignment',8,10),(4,'Quiz',19,20),(4,'Mids',17,20),(4,'Final',32,40);

INSERT INTO attendance (enrollment_id,total_classes,present) VALUES (1,43,37),(2,20,18),(3,38,30),(4,42,34);

INSERT INTO results (user_id,term,term_no,grading_points,cumulative_gp,cr,total_cr,sgpa,cgpa) VALUES
 (1,'Spring 2023',1,63.34,63.34,19,19,3.33,3.33),
 (1,'Fall 2023',2,52.32,115.60,17,36,3.08,3.21),
 (1,'Spring 2024',3,59.33,174.90,16,52,3.71,3.37),
 (1,'Fall 2024',4,61.25,236.15,18,70,3.40,3.37),
 (1,'Spring 2025',5,67.80,303.95,20,90,3.39,3.38);

INSERT INTO invoices (user_id,term,semester,challan_id,scholarship,fee,fine,status) VALUES
 (1,'Spring 2024','4th','CH-001',50,50000,0,'unpaid'),
 (1,'Fall 2023','3rd','CH-002',30,70000,500,'paid'),
 (1,'Spring 2023','2nd','CH-003',20,80000,1000,'paid'),
 (1,'Fall 2022','1st','CH-004',10,90000,0,'paid'),
 (1,'Spring 2022','Foundation','CH-005',0,100000,2000,'paid');

INSERT INTO datesheet (term,subject,instructor,exam_date,start_time,end_time,venue) VALUES
 ('Spring 2025','OOP','Babar Azam','2024-07-13','12:00','14:00','A-008'),
 ('Spring 2025','COAL','Virat Kohli','2024-07-14','12:00','14:00','A-010'),
 ('Spring 2025','MVC','Haris Rauf','2024-07-15','10:00','12:00','B-108'),
 ('Spring 2025','ISL','Rizwan','2024-07-16','15:00','17:00','A-008'),
 ('Spring 2025','DS','Starc','2024-07-17','12:00','14:00','Cl-112');

INSERT INTO timetable (course_id,day_of_week,start_time,end_time,room,class_type)
SELECT t.cid, d.n, t.s, t.e, t.r, t.k
FROM (SELECT 1 n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) d
JOIN (SELECT 1 cid,'09:00' s,'10:30' e,'Lab 1' r,'Lab' k
      UNION SELECT 4,'11:00','12:30','Room 301','Lecture'
      UNION SELECT 3,'14:00','15:30','Room 205','Lecture') t;

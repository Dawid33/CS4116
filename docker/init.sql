-- cs4116.skills definition

CREATE TABLE `skills` (
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `skill_id` varchar(255) NOT NULL DEFAULT (uuid()),
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.users definition

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT (uuid()),
  `is_admin` tinyint(1) NOT NULL,
  `bio` text,
  `creation_date` timestamp NOT NULL DEFAULT (now()),
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.connections definition

CREATE TABLE `connections` (
  `user_id_first` varchar(255) NOT NULL,
  `user_id_second` varchar(255) NOT NULL,
  `conn_id` varchar(255) NOT NULL DEFAULT (uuid()),
  `connection_date` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`conn_id`),
  KEY `connections_FK` (`user_id_first`),
  KEY `connections_FK_1` (`user_id_second`),
  CONSTRAINT `connections_FK` FOREIGN KEY (`user_id_first`) REFERENCES `users` (`user_id`),
  CONSTRAINT `connections_FK_1` FOREIGN KEY (`user_id_second`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.qualifications definition

CREATE TABLE `qualifications` (
  `user_id` varchar(255) NOT NULL,
  `qualification_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT (uuid()),
  `qualification_title` varchar(100) NOT NULL,
  `qualification_description` text,
  `qualification_degree` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualification_year` time NOT NULL,
  PRIMARY KEY (`qualification_id`),
  KEY `qualifications_FK` (`user_id`),
  CONSTRAINT `qualifications_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.user_skills definition

CREATE TABLE `user_skills` (
  `user_id` varchar(255) NOT NULL,
  `skill_id` varchar(255) NOT NULL,
  KEY `user_skills_FK_1` (`skill_id`),
  KEY `user_skills_FK` (`user_id`),
  CONSTRAINT `user_skills_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_skills_FK_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.organisation definition

CREATE TABLE `organisation` (
  `user_id` varchar(255) NOT NULL,
  `org_id` varchar(255) NOT NULL DEFAULT (uuid()),
  `email` text,
  `address` text,
  `description` text,
  `name` text NOT NULL,
  PRIMARY KEY (`org_id`),
  KEY `organisation_FK` (`user_id`),
  CONSTRAINT `organisation_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.job_history definition

CREATE TABLE `job_history` (
  `user_id` varchar(255) NOT NULL,
  `duration` time NOT NULL,
  `description` text,
  `job_history_id` varchar(255) NOT NULL DEFAULT (uuid()),
  `title` text NOT NULL,
  `org_id` varchar(255) NOT NULL,
  PRIMARY KEY (`job_history_id`),
  KEY `job_history_FK` (`user_id`),
  KEY `job_history_FK_1` (`org_id`),
  CONSTRAINT `job_history_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `job_history_FK_1` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.vacancies definition

CREATE TABLE `vacancies` (
  `org_id` varchar(255) NOT NULL,
  `vacancy_id` varchar(255) NOT NULL DEFAULT (uuid()),
  `title` text NOT NULL,
  `description` text,
  `required_experience` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`vacancy_id`),
  KEY `vacancies_FK` (`org_id`),
  CONSTRAINT `vacancies_FK` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.vacancy_skills definition

CREATE TABLE `vacancy_skills` (
  `vacancy_id` varchar(255) NOT NULL,
  `skill_id` varchar(255) NOT NULL,
  KEY `vacancy_skills_FK` (`vacancy_id`),
  KEY `vacancy_skills_FK_1` (`skill_id`),
  CONSTRAINT `vacancy_skills_FK` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vacancy_skills_FK_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Test user dummy data

SET @test_user_id := uuid();
SET @test_org_id := uuid();
INSERT INTO users (user_id, email, password, first_name, last_name, is_admin) VALUES (@test_user_id, "test@example.com", "test", "test", "test", false);
INSERT INTO organisation (user_id, org_id, name, email) VALUES (@test_user_id, @test_org_id, "Test Company", "test@example.com");
INSERT INTO vacancies (org_id, status, title, description) VALUES (@test_org_id, true, "Senior Engineer's hair stylist", "Can't work if hair bad.");
INSERT INTO vacancies (org_id, status, title, description) VALUES (@test_org_id, true, "Coffee Brewer", "The Distinguished and honorable privelege of dispensing the lifeblood of the office to your colleagues.");
INSERT INTO vacancies (org_id, status, title, description) VALUES (@test_org_id, true, "Keyboard Licker", "Discretion is advised.");

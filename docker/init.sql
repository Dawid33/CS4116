CREATE SCHEMA app;

-- cs4116.users definition

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL,
  `bio` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.organisation definition

CREATE TABLE `organisation` (
  `password` varchar(100) NOT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.skills definition

CREATE TABLE `skills` (
  `user_id` bigint NOT NULL,
  `skill` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.experience definition

CREATE TABLE `experience` (
  `user_id` bigint NOT NULL,
  `location` varchar(100) NOT NULL,
  `duration` time NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.organisation_members definition

CREATE TABLE `organisation_members` (
  `user_id` bigint NOT NULL,
  `org_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.user_connections definition

CREATE TABLE `user_connections` (
  `user_id` bigint NOT NULL,
  `followed_user` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.vacancies definition

CREATE TABLE cs4116.vacancies (
	org_id BIGINT NOT NULL,
	vacancy_id BIGINT auto_increment NOT NULL,
	CONSTRAINT vacancies_PK PRIMARY KEY (vacancy_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

-- cs4116.vacancy_skills definition

CREATE TABLE `vacancy_skills` (
  `vancancy_id` bigint NOT NULL,
  `skill` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `duration` time NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- INSERT INTO app.users (first_name, , email, password) VALUES ('John', 'Doe', 'jdoe@example.com', 'jdoe');
-- INSERT INTO app.users (first_name, last_name, emlast_nameail, password) VALUES ('test', 'test', 'test@example.com', 'test');


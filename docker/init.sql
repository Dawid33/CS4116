-- cs4116.users definition

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_id` bigint NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.connections definition

CREATE TABLE `connections` (
  `user_id_first` bigint NOT NULL,
  `user_id_second` bigint NOT NULL,
  `conn_id` bigint NOT NULL,
  `connection_date` timestamp NOT NULL,
  PRIMARY KEY (`conn_id`),
  KEY `connections_FK` (`user_id_first`),
  KEY `connections_FK_1` (`user_id_second`),
  CONSTRAINT `connections_FK` FOREIGN KEY (`user_id_first`) REFERENCES `users` (`user_id`),
  CONSTRAINT `connections_FK_1` FOREIGN KEY (`user_id_second`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.experience definition

CREATE TABLE `experience` (
  `user_id` bigint NOT NULL,
  `location` varchar(100) NOT NULL,
  `duration` time NOT NULL,
  `description` text,
  `exp_id` bigint NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`exp_id`),
  KEY `experience_FK` (`user_id`),
  CONSTRAINT `experience_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.organisation definition

CREATE TABLE `organisation` (
  `password` varchar(100) NOT NULL,
  `org_id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` text,
  `phone_number` int NOT NULL,
  `user_id` bigint NOT NULL,
  PRIMARY KEY (`org_id`),
  KEY `organisation_FK` (`user_id`),
  CONSTRAINT `organisation_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.qualifications definition

CREATE TABLE `qualifications` (
  `user_id` bigint NOT NULL,
  `qualification_id` bigint NOT NULL,
  `qualification_title` varchar(100) NOT NULL,
  `qualification_description` text,
  `qualification_level` varchar(100) NOT NULL,
  `qualification_year` time NOT NULL,
  PRIMARY KEY (`qualification_id`),
  KEY `qualifications_FK` (`user_id`),
  CONSTRAINT `qualifications_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.skills definition

CREATE TABLE `skills` (
  `user_id` bigint NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `skill_id` bigint NOT NULL,
  PRIMARY KEY (`skill_id`),
  KEY `skills_FK` (`user_id`),
  CONSTRAINT `skills_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.user_skills definition

CREATE TABLE `user_skills` (
  `user_skill_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `skill_id` bigint NOT NULL,
  PRIMARY KEY (`user_skill_id`),
  KEY `user_skills_FK` (`user_id`),
  KEY `user_skills_FK_1` (`skill_id`),
  CONSTRAINT `user_skills_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `user_skills_FK_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.vacancies definition

CREATE TABLE `vacancies` (
  `org_id` bigint NOT NULL,
  `vacancy_id` bigint NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `required_experience` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`vacancy_id`),
  KEY `vacancies_FK` (`org_id`),
  CONSTRAINT `vacancies_FK` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.vacancy_skills definition

CREATE TABLE `vacancy_skills` (
  `vacancy_id` bigint NOT NULL,
  `skill_id` bigint NOT NULL,
  `vacancy_skills_id` bigint NOT NULL,
  PRIMARY KEY (`vacancy_skills_id`),
  KEY `vacancy_skills_FK` (`skill_id`),
  KEY `vacancy_skills_FK_1` (`vacancy_id`),
  CONSTRAINT `vacancy_skills_FK` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`),
  CONSTRAINT `vacancy_skills_FK_1` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.forum definition

CREATE TABLE `forum` (
  `forum_post_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`forum_post_id`),
  KEY `forum_FK` (`user_id`),
  CONSTRAINT `forum_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- cs4116.watchlist definition

CREATE TABLE `watchlist` (
  `watchlist_item_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `vacancy_id` bigint NOT NULL,
  PRIMARY KEY (`wathlist_item_id`),
  KEY `watchlist_FK` (`user_id`),
  KEY `watchlist_FK_1` (`vacancy_id`),
  CONSTRAINT `watchlist_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `watchlist_FK_1` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
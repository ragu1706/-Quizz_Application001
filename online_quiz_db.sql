-- Online Quiz System schema (MySQL 8+ / MariaDB 10.4+)
CREATE DATABASE IF NOT EXISTS online_quiz_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE online_quiz_db;

CREATE TABLE IF NOT EXISTS tbl_quiz (
  tbl_quiz_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  quiz_question TEXT NOT NULL,
  option_a TEXT NOT NULL,
  option_b TEXT NOT NULL,
  option_c TEXT NOT NULL,
  option_d TEXT NOT NULL,
  correct_answer CHAR(1) NOT NULL,
  PRIMARY KEY (tbl_quiz_id),
  CONSTRAINT chk_correct_answer CHECK (correct_answer IN ('A','B','C','D'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_result (
  tbl_result_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  quiz_taker VARCHAR(120) NOT NULL,
  year_section VARCHAR(80) NOT NULL,
  total_score INT UNSIGNED NOT NULL,
  date_taken TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (tbl_result_id),
  INDEX idx_result_date (date_taken)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample questions are inserted only when the table is empty.
INSERT INTO tbl_quiz (quiz_question, option_a, option_b, option_c, option_d, correct_answer)
SELECT 'What does HTML stand for?', 'HyperText Markup Language', 'High Transfer Machine Language', 'Home Tool Markup Language', 'Hyperlink Text Management Language', 'A'
WHERE NOT EXISTS (SELECT 1 FROM tbl_quiz);

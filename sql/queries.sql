INSERT INTO user (login, email, password_hash) VALUES 
(1212132, "oui1@gmail.com", 934552426),
(1212165, "oui2@gmail.com", 934552426),
(1216543, "oui3@gmail.com", 934552426),
(1217862, "oui4@gmail.com", 934552426),
(1213752, "oui5@gmail.com", 934552426);

INSERT INTO project (name, user_id) VALUES 
("project 1", 1),
("project 2", 1),
("project 3", 1),
("project 4", 1),
("project 5", 1);

INSERT INTO task (name, is_completed, deadline, user_id, project_id) VALUES 
("task 1", true, "2022.12.31", 1, 1),
("task 2", true, "2022.12.31", 1, 1),
("task 3", true, "2022.12.31", 1, 1),
("task 4", true, "2022.12.31", 1, 1),
("task 5", true, "2022.12.31", 1, 1);

INSERT INTO task_file (path, task_id) VALUES 
("1.jpeg", 1),
("2.jpeg", 1),
("3.jpeg", 1),
("4.jpeg", 1),
("5.jpeg", 1);
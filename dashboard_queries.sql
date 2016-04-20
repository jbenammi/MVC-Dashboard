SELECT * FROM users;

SELECT * FROM users WHERE id = 1;

INSERT INTO users(first_name, last_name, email, password, admin_rights, created_on, updated_on)
VALUES('Gitai', 'Ben-Ammi', 'gitaiba@gmail.com', '123456789', FALSE, now(), now());

SELECT concat(first_name, " ", last_name) as full_name, first_name, last_name, admin_rights, id, created_on, description FROM users where email = 'jbenammi@gmail.com' AND password = '123456789';

DELETE FROM users WHERE id = 5;

INSERT INTO messages(message, created_on, updated_on, users_id, wall_id) VALUES('Hey there, just wanted to say hello and see how you are doing', now(), now(), 1, 5);

SELECT messages.users_id as author_id, users.first_name, messages.id as message_id, messages.message, users_comments.id as user_comment_id, users_comments.users_id as message_owner_id FROM users
JOIN users_comments
ON users_comments.users_id = users.id
JOIN messages
ON messages.id = users_commmessagesents.messages_id;

SELECT * FROM messages;
-- query for getting messages --
SELECT messages.id, messages.message, messages.created_on, messages.wall_id, concat(users.first_name, " ", users.last_name) as author FROM messages JOIN users ON users.id = messages.users_id WHERE messages.wall_id = 4 ORDER BY created_on desc;


SELECT concat(first_name, " ", last_name) as full_name, first_name, last_name, id, created_on, email, description FROM users where id = 4;

SELECT * FROM comments;
-- query for getting comments on a specific message --
SELECT messages.id as message_id, comments.comment, comments.created_on, concat(users.first_name, " ", users.last_name) as author
FROM messages 
JOIN comments
ON comments.messages_id = messages.id 
JOIN users
ON comments.users_id = users.id
WHERE messages.id = 8;


-- query for inserting comments into the table --
INSERT INTO comments(comment, created_on, updated_on, messages_id, users_id) VALUES('I dont know whats going on now', now(), now(), 8, 2);

#!/bin/bash
chcp 65001

sqlite3 movies_rating.db < db_init.sql

echo "1. Найти все комедии, выпущенные после 2000 года, которые понравились мужчинам (оценка не ниже 4.5). Для каждого фильма в этом списке вывести название, год выпуска и количество таких оценок."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "SELECT movies.title, movies.year, COUNT(ratings.rating) AS count_ratings FROM movies, ratings, users WHERE (movies.genres LIKE '%%Comedy%%' AND movies.year>2000 AND movies.id = ratings.movie_id AND ratings.rating>=4.5 AND ratings.user_id=users.id AND users.gender = 'male') GROUP BY ratings.movie_id ORDER BY movies.year, movies.title;"
echo " "

echo "2. Провести анализ занятий (профессий) пользователей - вывести количество пользователей для каждого рода занятий. Найти самую распространенную и самую редкую профессию посетитетей сайта."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "CREATE VIEW users_occupation AS SELECT users.occupation, COUNT(users.id) AS count_users FROM users GROUP BY users.occupation;"
sqlite3 movies_rating.db -box -echo "SELECT occupation, count_users FROM users_occupation WHERE count_users = (SELECT MAX(count_users) FROM users_occupation);"
sqlite3 movies_rating.db -box -echo "SELECT occupation, count_users FROM users_occupation WHERE count_users = (SELECT MIN(count_users) FROM users_occupation);"
sqlite3 movies_rating.db -box -echo "DROP VIEW IF EXISTS users_occupation;"
echo " "

echo "3. Найти все пары пользователей, оценивших один и тот же фильм. Устранить дубликаты, проверить отсутствие пар с самим собой. Для каждой пары должны быть указаны имена пользователей и название фильма, который они оценили."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "SELECT c.name AS User1, d.name AS User2, movies.title FROM ratings b, ratings a INNER JOIN movies ON a.movie_id = movies.id INNER JOIN users c ON c.id=a.user_id INNER JOIN users d ON d.id=b.user_id WHERE a.movie_id=b.movie_id AND c.id<d.id ORDER BY movies.title, User1, User2 LIMIT 195;"
echo " "

echo "4. Найти 10 самых свежих оценок от разных пользователей, вывести названия фильмов, имена пользователей, оценку, дату отзыва в формате ГГГГ-ММ-ДД."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "CREATE VIEW latest_ratings AS SELECT ratings.movie_id, ratings.user_id, ratings.rating, MAX(ratings.timestamp) AS latest_date FROM ratings GROUP BY ratings.user_id ORDER BY ratings.timestamp DESC;"
sqlite3 movies_rating.db -box -echo "SELECT movies.title, users.name, latest_ratings.rating, date(latest_ratings.latest_date, 'unixepoch') AS date FROM movies, users, latest_ratings WHERE latest_ratings.movie_id = movies.id AND users.id=latest_ratings.user_id LIMIT 10;"
sqlite3 movies_rating.db -box -echo "DROP VIEW IF EXISTS latest_ratings;"
echo " "

echo "5. Вывести в одном списке все фильмы с максимальным средним рейтингом и все фильмы с минимальным средним рейтингом. Общий список отсортировать по году выпуска и названию фильма. В зависимости от рейтинга в колонке "Рекомендуем" для фильмов должно быть написано "Да" или "Нет"."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "CREATE VIEW average_ratings AS SELECT movies.title AS Title, movies.year AS Year, average_rating FROM movies INNER JOIN (SELECT ratings.movie_id, AVG(ratings.rating) AS average_rating FROM ratings GROUP BY ratings.movie_id) ratings ON ratings.movie_id=movies.id;"
sqlite3 movies_rating.db -box -echo "SELECT Title, Year, average_rating, CASE WHEN max_rating = average_rating then 'Yes' WHEN min_rating = average_rating THEN 'No' END 'Recommendation' FROM (SELECT *, MAX(average_rating) OVER() AS max_rating, MIN(average_rating) OVER() AS min_rating FROM average_ratings) WHERE average_rating = max_rating OR average_rating = min_rating ORDER BY Year, Title;"
sqlite3 movies_rating.db -box -echo "DROP VIEW IF EXISTS average_ratings;"
echo " "

echo "6. Вычислить количество оценок и среднюю оценку, которую дали фильмам пользователи-женщины в период с 2010 по 2012 год."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "SELECT COUNT(ratings.id) AS count_ratings, AVG(ratings.rating) AS average_rating FROM ratings, users WHERE ratings.user_id = users.id AND users.gender = 'female' AND (date(ratings.timestamp,'unixepoch') LIKE '2010%%' OR date(ratings.timestamp,'unixepoch') LIKE '2011%%' OR date(ratings.timestamp,'unixepoch') LIKE '2012%%');"
echo " "

echo "7. Составить список фильмов с указанием их средней оценки и места в рейтинге по средней оценке. Полученный список отсортировать по году выпуска и названиям фильмов. В списке оставить первые 20 записей."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "CREATE VIEW movies_ordered_by_rating AS SELECT movies.title AS Title, movies.year AS Year, Average_rating FROM movies INNER JOIN (SELECT ratings.movie_id, AVG(ratings.rating) AS Average_rating FROM ratings GROUP BY ratings.movie_id) ratings ON ratings.movie_id = movies.id;"
sqlite3 movies_rating.db -box -echo "SELECT Title, Year, Average_rating, Place FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY Average_rating DESC) AS Place FROM movies_ordered_by_rating) ORDER BY Year, Title LIMIT 20;"
sqlite3 movies_rating.db -box -echo "DROP VIEW IF EXISTS movies_ordered_by_rating;"
echo " "

echo "8. Определить самый распространенный жанр фильма и количество фильмов в этом жанре."
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "CREATE VIEW the_most_widespread_genres AS WITH genres_movies(id, genre, substring) AS (SELECT id, NULL, genres FROM movies UNION ALL SELECT id, CASE WHEN instr(substring,'|') = 0 THEN substring ELSE substr(substring, 1, instr(substring,'|')-1) END, CASE WHEN instr(substring,'|')=0 THEN NULL ELSE substr(substring, instr(substring,'|')+1) END FROM genres_movies WHERE substring IS NOT NULL ORDER BY id) SELECT genre AS Genre, count(id) AS Number_of_movies FROM genres_movies WHERE genre IS NOT NULL GROUP BY genre;"
sqlite3 movies_rating.db -box -echo "SELECT Genre AS The_most_widespread_genre, MAX(Number_of_movies) AS Count_of_movies FROM the_most_widespread_genres;"
sqlite3 movies_rating.db -box -echo "DROP VIEW IF EXISTS the_most_widespread_genres;"
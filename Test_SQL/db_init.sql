PRAGMA foreign_keys=ON;
.open marks.db
DROP TABLE IF EXISTS attendance;
DROP TABLE IF EXISTS progress_303;
DROP TABLE IF EXISTS progress_402;
DROP TABLE IF EXISTS students_303;
DROP TABLE IF EXISTS students_402;
DROP TABLE IF EXISTS labs_303;
DROP TABLE IF EXISTS labs_402;

CREATE TABLE IF NOT EXISTS attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, timestamp TEXT, group INTEGER, FIO TEXT);
CREATE TABLE students_303 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, FIO TEXT);
CREATE TABLE students_402 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, FIO TEXT, lab_var TEXT, ind_graphic TEXT);
CREATE TABLE labs_303 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lab_num INTEGER, lab_max INTEGER, control_date TEXT);
CREATE TABLE labs_402 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lab_num INTEGER, lab_max INTEGER, control_date TEXT);
CREATE TABLE IF NOT EXISTS progress_303 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lab_percents TEXT, date_submit TEXT);
CREATE TABLE IF NOT EXISTS progress_402 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lab_percents TEXT, date_submit TEXT);

file.write("ALTER TABLE progress_303 ADD COLUMN student_id INTEGER REFERENCES students_303 (id) ON DELETE RESTRICT ON UPDATE CASCADE;\n")
file.write("ALTER TABLE progress_303 ADD COLUMN lab_id INTEGER REFERENCES labs_303 (id) ON DELETE RESTRICT ON UPDATE CASCADE;\n")
file.write("ALTER TABLE progress_402 ADD COLUMN student_id INTEGER REFERENCES students_402 (id) ON DELETE RESTRICT ON UPDATE CASCADE;\n")
file.write("ALTER TABLE progress_402 ADD COLUMN lab_id INTEGER REFERENCES labs_402 (id) ON DELETE RESTRICT ON UPDATE CASCADE;\n")

INSERT INTO attendance (timestamp, group, FIO)
VALUES
("01.03.2021 9:00", 402, "Седики Худжа Юсуф"),
("05.03.2021 18:01", 402, "Парамонов Олег Николаевич"),
("05.03.2021 18:04", 402, "Булатова Г.Р."),
("05.03.2021 18:04", 402, "Антонов К. Ю"),
("05.03.2021 18:04", 402, "Александров К.В"),
("05.03.2021 18:06", 402, "Сазонов Д. А."),
("05.03.2021 18:07", 402, "Арянов В.А."),
("05.03.2021 18:07", 402, "Седики Худжа Юсуф"),
("05.03.2021 18:10", 402, "Кудашкин А.Е."),
("05.03.2021 18:16", 402, "Гераськин В. М."),
("05.03.2021 18:39", 402, "Тростин С.А."),
("05.03.2021 19:02", 402, "Балашов В.В."),
("06.03.2021 13:09", 402, "Сазонов Д. А."),
("06.03.2021 13:11", 402, "Арянов В.А."),
("06.03.2021 13:19", 402, "Александров К. В."),
("06.03.2021 14:23", 402, "Седики Худжа Юсуф"),
("06.03.2021 15:33", 402, "Плаксин Д.В,"),
("06.03.2021 20:06", 402, "Макшев Н.И."),
("12.03.2021 17:59", 402, "Александров К.В."),
("12.03.2021 17:59", 402, "Парамонов Олег Николаевич"),
("12.03.2021 18:00", 402, "Булатова Г.Р."),
("12.03.2021 18:01", 402, "Плаксин Д.В."),
("12.03.2021 18:01", 402, "Кудашкин А.Е."),
("12.03.2021 18:04", 402, "Седики Худжа Юсуф"),
("12.03.2021 18:04", 402, "Арянов В.А."),
("12.03.2021 18:04", 402, "Макшев Н.И."),
("12.03.2021 18:04", 402, "Гурьков Н.Д."),
("12.03.2021 18:07", 402, "Балашов В. В."),
("12.03.2021 19:48", 402, "Матвеев М.Д."),
("13.03.2021 13:04", 402, "Булатова Г.Р."),
("13.03.2021 13:06", 402, "Кудашкин А.Е."),
("13.03.2021 13:07", 402, "Балашов В. В."),
("13.03.2021 13:21", 402, "Гераськин В. М."),
("13.03.2021 13:24", 402, "Парамонов Олег Николаевич"),
("13.03.2021 13:29", 402, "Шабарин И. А.");
INSERT INTO students_303 (FIO)
VALUES
("Алексеев Алексей"),
("Ашрятова Римма"),
("Борисов Александр"),
("Гарин Максим"),
("Головатюк Анастасия"),
("Горбунов Андрей"),
("Гуськов Артем"),
("Дворянинова Дарья"),
("Еделева Юлия"),
("Зевайкин Андрей"),
("Исоков Асадбек"),
("Казакова Ирина"),
("Квашнин Кирилл"),
("Кирдюшкин Данила"),
("Козина Светлана"),
("Козлова Екатерина"),
("Котков Сергей"),
("Ландышев Александр"),
("Логинов Виталий"),
("Малов Кирилл"),
("Манин Данила"),
("Маслова Елена"),
("Паршин Артем"),
("Пузин Владислав"),
("Сайфетдинов Салават"),
("Симатов Вадим");
INSERT INTO students_402 (FIO)
VALUES
("Александров К.В.",1,"yes"),
("Антонов К.Ю.",1,"yes"),
("Арянов В.А.",1,"yes"),
("Ахунзада Г.А.",1,"yes"),
("Балашов В.В.",1,"no"),
("Бикмаев Р.Р.",1,"no"),
("Булатова Г.Р.",2,"no"),
("Гераськин В.М.",2,"no"),
("Гурьков Н.Д.",2,"no"),
("Дурнаев Н.С.",2,"no"),
("Егоров О.А.",2,"yes"),
("Кокулов А.Ф.",3,"no"),
("Кудашкин А.Е.",3,"no"),
("Лихорадов И.И.",3,"no"),
("Логинов А.Д.",3,"no"),
("Ломайкин А.С.",3,"no"),
("Макушев В.А.",4,"no"),
("Макшев Н.И.",4,"no"),
("Матвеев М.Д.",4,"no"),
("Парамонов О.Н.",4,"yes"),
("Плаксин Д.В.",5,"no"),
("Сазонов А.В.",5,"no"),
("Седики Х.Ю.",5,"no"),
("Сюсин А.В.",5,"no"),
("Тростин С.А.",5,"yes"),
("Шабарин И.А.",5,"yes");

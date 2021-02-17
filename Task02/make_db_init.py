def special_replace(s):
    modified_str = s[1:-1].replace('"', "*")
    modified_str2 = modified_str.replace("'","*")
    return modified_str2


file = open("db_init.sql","w")
file_movies = open("movies.csv","r")
file_ratings = open("ratings.csv","r")
file_tags = open("tags.csv","r")
file_users = open("users.txt","r")


file.write("DROP TABLE IF EXISTS movies;\n")
file.write("DROP TABLE IF EXISTS ratings;\n")
file.write("DROP TABLE IF EXISTS tags;\n")
file.write("DROP TABLE IF EXISTS users;\n")


file.write("CREATE TABLE IF NOT EXISTS movies (id INTEGER PRIMARY KEY, title TEXT, year TEXT, genres TEXT);\n")
file.write("CREATE TABLE IF NOT EXISTS ratings (id INTEGER PRIMARY KEY, user_id INTEGER, movie_id INTEGER, rating REAL, timestamp INTEGER);\n")
file.write("CREATE TABLE IF NOT EXISTS tags (id INTEGER PRIMARY KEY, user_id INTEGER, movie_id INTEGER, tag TEXT, timestamp INTEGER);\n")
file.write("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT, email TEXT, gender TEXT, register_date TEXT, occupation TEXT);\n")


# create table 'movies'
flag = False
file.write('INSERT INTO movies (id, title, year, genres)\nVALUES\n')
file_movies.readline()

x = file_movies.readline()
x_list = x.split(",")
if (len(x_list) <= 3):
    x_list_year = x_list[1].split("(")
    if (x_list_year[0].find('"') != -1):
        x_list_new = special_replace(x_list_year[0])
        if (x_list[-2].find("(") != -1):
            file.write('(' + x_list[0] + ', "' + x_list_new + '", ' + x_list_year[-1][0:4] + ', "' + x_list[-1][
                                                                                                     0:-1] + '")')
        else:
            file.write('(' + x_list[0] + ', "' + x_list_new + '", ' + str(0) + ', "' + x_list[-1][0:-1] + '")')
        flag = True

else:
    x_list_1 = x.split('"')
    x_list_year = x_list_1[1].split("(")

if (flag!=True):
    if (x_list[-2].find("(") != -1):
        file.write(
            '(' + x_list[0] + ', "' + x_list_year[0] + '", ' + x_list_year[-1][0:4] + ', "' + x_list[-1][0:-1] + '")')

    else:
        file.write('(' + x_list[0] + ', "' + x_list_year[0] + '", ' + str(0) + ', "' + x_list[-1][0:-1] + '")')


for x in file_movies:
    x_list = x.split(",")
    if (len(x_list)<=3):
        x_list_year = x_list[1].split("(")
        if (x_list_year[0].find('"') != -1):
            x_list_new = special_replace(x_list_year[0])
            if (x_list[-2].find("(") != -1):
                file.write(',\n('+x_list[0] + ', "' + x_list_new + '", ' + x_list_year[-1][0:4] + ', "' + x_list[-1][0:-1] + '")')
                continue
            else:
                file.write(',\n(' + x_list[0] + ', "' + x_list_new + '", ' + str(0) + ', "' + x_list[-1][0:-1] + '")')
                continue

    else:
        x_list_1 = x.split('"')
        x_list_year = x_list_1[1].split("(")

    if (x_list[-2].find("(") != -1):
        file.write(',\n(' + x_list[0] + ', "' + x_list_year[0] + '", ' + x_list_year[-1][0:4] + ', "' + x_list[-1][0:-1] + '")')
        continue
    else:
        file.write(',\n(' + x_list[0] + ', "' + x_list_year[0] + '", ' + str(0) + ', "' + x_list[-1][0:-1] + '")')
        continue

# Запись в конец последней строки файла ;
file.write(";\n")

file_movies.close()


# create table 'ratings'
file.write("INSERT INTO ratings (id, user_id, movie_id, rating, timestamp)\nVALUES\n")
file_ratings.readline()

index = 1

x=file_ratings.readline()
x_list = x.split(",")
file.write("("+str(index)+", " + x_list[0] + ", " + x_list[1] + ", " + x_list[2] + ", " + x_list[3][0:-1] + ")")
index += 1

for x in file_ratings:
    x_list = x.split(",")
    file.write(",\n("+str(index)+", "+x_list[0]+", "+x_list[1]+", "+x_list[2]+", "+x_list[3][0:-1]+ ")")
    index += 1

# Запись в конец последней строки файла ;
file.write(";\n")

file_ratings.close()



# create table 'tags'
file.write("INSERT INTO tags (id, user_id, movie_id, tag, timestamp)\nVALUES\n")
file_tags.readline()

index = 1

x=file_tags.readline()
x_list = x.split(",")

if (x_list[2].find('"')!=-1):
    x_list_new = special_replace(x_list[2])
    file.write('(' + str(index) + ", " + x_list[0] + ", " + x_list[1] + ', "' + x_list_new + '", ' + x_list[3][0:-1] + ')')
else:
    file.write('('+str(index)+", "+x_list[0]+", "+x_list[1]+', "'+x_list[2]+'", '+x_list[3][0:-1]+ ')')
index+=1


for x in file_tags:
    x_list = x.split(",")
    if (x_list[2].find('"') != -1):
        x_list_new = special_replace(x_list[2])
        file.write(',\n(' + str(index) + ", " + x_list[0] + ", " + x_list[1] + ', "' + x_list_new + '", ' + x_list[3][0:-1] + ')')
    else:
        file.write(',\n(' + str(index) + ", " + x_list[0] + ", " + x_list[1] + ', "' + x_list[2] + '", ' + x_list[3][0:-1] + ')')
    index+=1

# Запись в конец последней строки файла ;
file.write(";\n")

file_tags.close()


# create table 'users'
file.write('INSERT INTO users (id, name, email, gender, register_date, occupation)\nVALUES\n')
x=file_users.readline()
x_list = x.split("|")
file.write('(' + x_list[0] + ', "' + x_list[1] + '", "' + x_list[2] + '", "' + x_list[3] + '", "' + x_list[4] + '", "' + x_list[5][0:-1] + '")')

for x in file_users:
    x_list = x.split("|")
    file.write(',\n('+x_list[0]+', "'+x_list[1]+'", "'+x_list[2]+'", "'+x_list[3]+'", "'+x_list[4]+'", "'+x_list[5][0:-1]+ '")')


# Запись в конец последней строки файла ;
file.write(";\n")

file_users.close()



file.close()
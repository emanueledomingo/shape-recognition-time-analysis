# database connection and data retrival function
def database_init():
    global dataframe
    # Database connection
    connection = pymysql.connect(host='localhost',
                                 port=3306,
                                 user='root',
                                 password='',
                                 db='multisensory')
    try:
        with connection.cursor() as cursor:
            # mysql query to get data from the database
            sql = "SELECT TIME_TO_SEC(Tempo)/60,Livello,Colore,Eta,Genere, Esperimento.ID_Soggetto FROM Esperimento 
            JOIN Soggetto ON Esperimento.ID_Soggetto = Soggetto.ID_Soggetto WHERE 1"
            cursor.execute(sql)
            result = cursor.fetchall()
            # copy the data from result in my list
            for row in result:
                dataset.append(row)
            # creating the dataframe
            dataframe = pd.DataFrame(result, columns=["time", "level", "color",
                                                      "age", "gender", "subject"])
            # conversion from class Decimal to int64
            dataframe["time"] = pd.to_numeric(dataframe["time"])
    finally:
        connection.close()

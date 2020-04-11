# Mysql library for mysql database connection
import pymysql.cursors

# Plot library
import matplotlib.pyplot as plot

# Statistics libraries
from statsmodels.genmod.families import Poisson
from scipy.stats import iqr
from statistics import median
from statsmodels.genmod.generalized_estimating_equations import GEE
from statsmodels.genmod.cov_struct import Independence

# Pandas for dataframe managment
import pandas as pd

# Global viariables, the first is containing the whole dataset.
# The second is a 'view', used for the glm
dataset = list()
dataframe = None


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
            sql = "SELECT TIME_TO_SEC(Tempo)/60,Livello,Colore,Eta,Genere, Esperimento.ID_Soggetto FROM Esperimento JOIN Soggetto ON Esperimento.ID_Soggetto = Soggetto.ID_Soggetto WHERE 1"
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


# function for plotting the data.
# @param color_name: the name of the category that you want to plot
def boxplot(color_name):
    # setting the category to filter the data
    if color_name == 'black':
        color = 0
        name = "neri"
    elif color_name == 'gray':
        color = 1
        name = "scala di grigi"
        color_name = "grey_scale"
    elif (color_name == 'color'):
        color = 2
        name = "scala di colori"
        color_name = "red$blue$green$yellow"

    # list of the esperiment values
    """
        the data structure has a 3-level strucutre:
        we have 10 levels (45,50,55,...,90)
        each level has 3 different types (black, grey_scale or color_scale)
        each tuple level-type has n observations
    """
    levels_times = list()
    # list of statistic indicators
    """
        the data structure has a 3-level strucutre:
        we have 10 levels (45,50,55,...,90)
        each level has 3 different types (black, grey_scale or color_scale)
        each tuple level-type has n observations
    """
    levels_means = list()

    # creation of the data structure
    for i in range(0, 10):
        levels_times.append(list())
        levels_means.append(list())
        for j in range(0, 3):
            levels_times[i].append(list())
            levels_means[i].append(list())

    # copy the dataset into the formatted data structure
    for row in dataset:
        # tricky way to get and index in [0, 10) from the number of the shapes [45, 90]
        mod = int(row[1]) % 45
        i = int(mod - (4 * (mod / 5)))
        if row[2] in color_name:
            levels_times[i][color].append(float(row[0]))

    # calculating the statistical indicators
    for i in range(0, 10):
        for j in range(0, 3):
            if len(levels_times[i][j]) >= 2:
                levels_means[i][j].append(median(levels_times[i][j]))
                levels_means[i][j].append(iqr(levels_times[i][j], interpolation='midpoint'))
            else:
                print("Error: too few observations")

    # creating the data for the plot function
    total_data = list()
    for i in range(0, 10):
        data = list()
        data.append((levels_means[i][color][1]))
        data.append((levels_means[i][color][0]))
        data.append(30)
        data.append(0)
        total_data.append(data)

    # creating the labels of the plot
    """
        labels = list()
        for i in range(0, 50, 5):
            labels.append(45+i)
    """
    #using list comprehension
    labels = [45+i for i in range(0, 50, 5)]

    # creating the plot
    fig, ax = plot.subplots()
    ax.set_xlabel('Numero figure')
    ax.set_ylabel('Tempo di riconoscimento in secondi')
    ax.boxplot(total_data, labels=labels)
    ax.set_title("Mediane per livello, "+name)

    # showing the plot
    plot.show()


# function for calculate the generalized linear model
def glm():
    # print a brief summary of the dataframe
    print(dataframe.head())

    # Poisson distributed data is intrinsically integer-valued, since we have to count data.
    fam = Poisson()
    # No correlation between the observations
    ind = Independence()

    # Y(x0,x1,x2,x3) = B0 + B1X0 + B2X1 + B3X2 + B4X3 + B5X4
    # Calculate the model
    model = GEE.from_formula("time ~ age + level + color + gender", "subject",
                             dataframe, cov_struct=ind, family=fam)
    result = model.fit()

    # print the result
    print(result.summary())


def main():
    database_init()
    boxplot('color')  # black, gray, color
    glm()


if __name__ == '__main__':
    main()

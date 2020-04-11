## Script analysis
 All the data present in the database will be analized via python script.

 There will be two different analysis:
 * Median boxplot
 * Generalized Linear Model (GLM)


 #### BoxPlot
 We represent the whole dataset into 3 plots containing the median and the interquartile range of the times for every level (each level corresponds to a different numbers of shapes displayed)

 The first step is fetching data from the dataset
```python
 # copy the dataset into the formatted data structure
   for row in dataset:
       # tricky way to get and index in [0, 10) from the number of the shapes [45, 90]
       mod = int(row[1]) - 45
       i = int(mod - (4 * (mod / 5)))
       if row[2] in color_name:
           print(row)
           levels_times[i][color].append(float(row[0]))
           print(levels_times[i][color])
```
Then we have to calculate median and interquartile range for every level
```python
   # calculating the statistical indicators
   for i in range(0, 10):
       if len(levels_times[i][color]) >= 2:
           levels_means[i][color].append(median(levels_times[i][color]))
           levels_means[i][color].append(iqr(levels_times[i][color], interpolation='midpoint'))
       else:
           levels_means[i][color].append(1)
           levels_means[i][color].append(1)
           print("Error: too few observations")
```
Then we build the lists for [matplotlib's](https://www.matplotlib.org) boxplot function
```python
   # creating the data for the plot function
   total_data = list()
   for i in range(0, 10):
       data = list()
       data.append((levels_means[i][color][1]))
       data.append((levels_means[i][color][0]))
       data.append(30)
       data.append(0)
       total_data.append(data)
```
Finally we can plot the results
```python
   # creating the labels of the plot using list comprehension
   labels = [45+i for i in range(0, 50, 5)]

   # creating the plot
   fig, ax = plot.subplots()
   ax.set_xlabel('Numero figure')
   ax.set_ylabel('Tempo di riconoscimento in secondi')
   ax.boxplot(total_data, labels=labels)
   ax.set_title("Mediane per livello, "+name)

   # showing the plot
   plot.show()
```
 #### GLM
 The goal of the project is to find (if there's) a correlation between some factors like age, gender, age, number of the shapes and the time for the recognison of a particular shape in a set.

 In a wide range of statiscal tools, we use a glm with a particular distribution (Poisson)
 > Why? See the paper -> [Link to paper](http://progettomultisensory.altervista.org/pages/paper.pdf)

 To do this we say thanks to [Statsmodel](https://www.statsmodels.org/)

 ```python
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
 ```

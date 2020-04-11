## MySQL Database

For every level we will save the results in a simple remote database.

We have just two tables:
```sql
CREATE TABLE `Esperimento` (
  `Tipo` text NOT NULL,
  `Livello` text NOT NULL,
  `Tempo` time NOT NULL,
  `Forma` text NOT NULL,
  `ID_Soggetto` int(11) NOT NULL,
  `ID_Esperimento` int(11) NOT NULL AUTO_INCREMENT,
  `Colore` text NOT NULL,
  PRIMARY KEY (`ID_Esperimento`)
)
```
```sql
CREATE TABLE `Soggetto` (
  `Genere` text,
  `Eta` int(11) DEFAULT NULL,
  `Daltonismo` text,
  `ID_Soggetto` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_Soggetto`)
)
```

After the completion of a level, through this query we upload the result
```sql
INSERT INTO `my_progettomultisensory`.`Esperimento` (`Tipo`, `Livello`, `Tempo`, `Forma`, `ID_Soggetto`, `Colore`)
VALUES ('***', '***', '***', '*', ***, '***')
```
The form of the 'Esperimento' table will be:

|ID_Esperimento|Livello|   Tempo  |Forma|ID_Soggetto|Tipo     |    Colore  |
|:------------:|:-----:|:--------:|:---:|:---------:|:-------:|:----------:|
|      141     |  80   | 00:54:08 |  28 |     10    | Nessuno |     black  |
|      204     |  60   | 00:54:05 |  29 |     19    | Nessuno | grey_scale |
|      144     |  45   | 00:53:07 |  48 |     11    | Nessuno |     green  |
|      90      |  70   | 00:43:07 |  5  |     3     | Nessuno | grey_scale |
|      408     |  70   | 00:42:06 |  30 |     51    | Nessuno |     red    |
|      ...     | ...   |   ...    | ... |    ...    |   ...   |    ...     |

--
-- Table structure for table `artist`
--
CREATE TABLE `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `artist`
--
INSERT INTO `artist` VALUES (1,'Bing Crosby'),(2,'Bill Haley & His Comets'),(3,'Elvis Presley'),(4,'The Beatles'),(5,'Queen'),(6,'Culture Club'),(7,'ABBA'),(8,'The Jackson 5');

--
-- Table structure for table `song`
--
CREATE TABLE `song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `song`
--
INSERT INTO `song` VALUES (1,'Fernando',7,257),(2,'Hound Dog',3,136),(3,'White Christmas',1,186),(4,'I Want to Hold Your Hand',4,148),(5,'Waterloo',7,169),(6,'Rock Around the Clock',2,134),(7,'Blue Suede Shoes',3,118),(8,'She Loves You',4,142),(9,'Bohemian Rhapsody',5,356),(10,'Are You Lonesome Tonight?',3,189),(11,'Hey Jude',4,431),(12,'Another One Bites the Dust',5,216);

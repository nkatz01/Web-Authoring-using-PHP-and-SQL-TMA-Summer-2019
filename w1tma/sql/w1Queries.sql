--
--Note, only the first query has been directly 	queried/executed through myDB class, the others are just for reference; to succinctly reflect the origin and the processing of the rest of the content, displayed on W1 Music pages, although they can be implemented in the same way as the first, by using myDB to create a new query object.
--

--
-- Query for Song page table
--

SELECT  s.title ,  group_concat( a.name SEPARATOR ',') as name,  s.duration  
FROM  artist a , song s
where a.id = s.artist_id 
group by  s.title, a.name,  s.duration
order by a.name, s.title asc;
--
-- Query for summary on Song page
--

SELECT  count(s.id) as 'Song Total'
FROM  song s;

--
-- Query for Artist page table
--


SELECT a.name as 'Artist', count(a.name) as 'Number of Songs'
FROM  artist a , song s
where a.id = s.artist_id 
group by (a.name)
order by a.name asc;

--
-- Query for summary Artist page
--
SELECT  count(distinct a.id)  as 'summary'
FROM  artist a, song s
where a.id = s.artist_id;
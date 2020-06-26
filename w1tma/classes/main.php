<?php
$songTemp       = 'templates/songs.html';
$songTblHdrTemp = 'templates/songTableHeader.html';
$tblFooterTemp  = 'templates/tableFooter.html';
$artTblHdrTemp  = 'templates/artistTableHeader.html';
$artistTemp     = 'templates/artist.html';

function my_autoloader($class)
{
    include 'classes/' . $class . '.php';
}
spl_autoload_register('my_autoloader');

$db  = new myDB($config, $lang);
$sql = "SELECT  s.title ,  group_concat( a.name SEPARATOR ',') as name,  s.duration  
FROM  artist a , song s
where a.id = s.artist_id 
group by  s.title, a.name,  s.duration
order by a.name, s.title asc";

if ($db->isConnecActive() == true) {
    
    $results_success = $db->runQuery($sql); //statement performs query and populates myDB instance's variable $objects, with retrieved results
    
    if ($results_success === true) {
        $songsContent  = file_get_contents($songTblHdrTemp); //insert headings in table template, appropriate for displaying results about songs.
        $songsContent  = replaceTemplate($songsContent, array(
            'heading_a',
            'heading_b',
            'heading_c'
        ), array(
            $lang['song_col1'],
            $lang['song_col2'],
            $lang['song_col3']
        ));
        $objects_array = $db->getObjects(); //retrieve all objects (i.e. rows) retrieved from database.
        
        $objectFields = $db->getFields(); //get fields/column names for (class of) objects obtained by query.
        
        foreach ($objects_array as $obj) { //for each object retrieved, create a (more specialized) object (in this case 'song') with its field values, as data of the new object's properties.
            $songs[] = new song($obj->title, $obj->duration, explode(',', $obj->name)); //if more than one artist, explode them into the artistArr property of the song object.
            
        }
        
        $tpl            = file_get_contents($songTemp);
        $allArtists_arr = array();
        foreach ($songs as $key => $song) {
            $rows_arr = $song->getAllProperties();
            $songsContent .= replaceTemplate($tpl, $objectFields, $rows_arr); //for each created song object, send an array of fields, and an array of values to replaceTemplate(), to receive a populated row, to append to the table that will be displayed to the user.
            $allArtists_arr = array_merge($allArtists_arr, $song->getArtist()); //for each song object, retrieve its artist(s) and merge them all into one array.
        }
        
        
        
        $artistContent = file_get_contents($artTblHdrTemp); //insert headings in table template, appropriate for displaying results about artists.
        $artistContent = replaceTemplate($artistContent, array(
            'heading_a',
            'heading_b'
        ), array(
            $lang['art_col1'],
            $lang['art_col2']
        ));
        $tpl           = file_get_contents($artistTemp);
        
        $uniqueArtists = removeDupes($allArtists_arr); //remove all duplicates of the array of all artists and get an associative array with the index names as the (unique) artist and the content of their index, the number of duplicates that 'allArtists_arr' initially had, to indicate the number of songs, associated with each.
        
        foreach ($uniqueArtists as $key => $val) { //populate the table of information about artists.
            $artistContent .= replaceTemplate($tpl, array(
                $lang['name'],
                $lang['num_songs']
            ), array(
                htmlentities($key),
                $val
            ));
        }
        
        $tpl = file_get_contents($tblFooterTemp);
        $artistContent .= replaceTemplate($tpl, array( //populate the summary for the table of information about artists.
            'heading_a',
            'heading_b',
            $lang['summary_column1'],
            $lang['summary_column2']
        ), array(
            $lang['headr_artTtl'],
            $lang['headr_songTtl'],
            count($uniqueArtists),
            array_sum($uniqueArtists)
        ));
        
        $songsContent .= replaceTemplate($tpl, array( //populate the summary for the table of information about songs.
            'heading_a',
            'heading_b',
            $lang['summary_column1'],
            $lang['summary_column2']
        ), array(
            $lang['headr_songTtl'],
            $lang['headr_artTtl'],
            song::getNumOfSongs(),
            count($uniqueArtists)
        ));
        
        
        
        
    }
    
    else {
        $content .= $db->getQueryFdbk();
    }
}

else {
    $content .= $db->getStatusMsg();
}
 $db->close();

?>
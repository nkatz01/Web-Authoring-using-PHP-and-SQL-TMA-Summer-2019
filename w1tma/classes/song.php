<?php

require_once 'includes/functions.php';
/**
 * Class song represents a class of objects, each representing a song with information about it, such as its title, duration and artist(s - if more than one). 
 *
 */
class song
{
    /**
     * @param $title holds the title of the song.
     * @param $duration holds the duration of a song as a string, in number of seconds.
     * @param $artistArr holds the artist(s) associated with this instance of song.
     * @param $noOfsongs holds the number of objects instantiated of class song.
     */
    
    private $title;
    private $duration;
    private $artistArr = array();
    private static $noOfsongs;
    
    /**
     * Constructor of song, sets the instance variables and bumps up static, class variable -> $noOfsongs with one.
     */
    public function __construct($title, $duration, $artistArr)
    {
        $this->title     = $title;
        $this->duration  = $duration;
        $this->artistArr = $artistArr;
        self::$noOfsongs++;
    }
    
    /**
     * 
     * @return all variables' data of this instance of song, formatted, by calling first formatSongDetails().
     */
    public function getAllProperties()
    {
        return $this->formatSongDetails();
    }
    
    /**
     * @return the number of instances created of class song.
     *
     */
    
    public static function getNumOfSongs()
    {
        return htmlentities(isSettoVal(self::$noOfsongs));
        
    }
    
    /**
     * @return the artist(s) of this instance of song.
     *
     */
    public function getArtist()
    {
        return $this->artistArr;
    }
    
    /**
     * Method formats each instance variable (after checking that it's not null) and stores the result in local variables. It then returns them in an array, to the caller.
     * @return $row, array of formatted  content of instance variables.
     *
     */
    protected function formatSongDetails()
    {
        
        $title            = htmlentities(isSettoVal($this->title));
        $artistsFormatted = htmlentities(isSettoVal(formatList($this->artistArr)));
        if (isSettoVal($this->duration)) {
            $durationFormatted = htmlentities($this->formatTime($this->duration));
        } else {
            $durationFormatted = htmlentities(isSettoVal($this->duration));
        }
        
        $row = array(
            $title,
            $artistsFormatted,
            $durationFormatted
        );
        
        return $row;
        
    }
    
    /**
     * @param $time as string in seconds.
     * @return $time_string, formatted to mm:ss.
     *
     */
    protected function formatTime($time)
    {
        
        $time_string = gmdate('i:s', $time);
        return $time_string;
    }
    
    
}



?>




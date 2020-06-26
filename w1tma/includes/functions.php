<?php

/**
 * @param $arrayOfValues to be extracted and formatted as a string.
 * @return a string with all the values separated by commas (if more than one) and/or 'and' before the last value.
 *
 */
function formatList($arrayOfValues)
{
    $list       = '';
    $endReached = false;
    if (count($arrayOfValues) == 1) { //if only one value
        return $arrayOfValues[0];
    } else if (count($arrayOfValues) == 2) { //if 2 values, return: value1 and value2
        return $arrayOfValues[0] . ' and ' . $arrayOfValues[1];
    }
    
    foreach ($arrayOfValues as $key => $names) { //if >2 values, return: value1, value2 and value3
        
        if ($key == (count($arrayOfValues) - 2)) {
            $endReached = true;
        }
        if (!$endReached) {
            $list .= $names . ', ';
        } else {
            if ($key == (count($arrayOfValues) - 2)) {
                $list .= $arrayOfValues[$key] . ' and ' . $arrayOfValues[$key + 1];
            }
        }
        
    }
    return $list;
}

/**
 * @param, $value to be tested whether it contains any content.
 * @return $value if it's set to anything, else returns one blank space.
 *
 */
function isSettoVal($value)
{
    if (isset($value)) {
        return $value;
    } else {
        return ' ';
    }
}

/**
 * 
 * @param $temp, template to be populated, $objectFields, the name of the fields of the values in $rows_arr.
 * @return a template populated with the values in $rows_arr, assuming these placeholders are found in the template. If they aren't, an empty string is placed there instead.
 */



function replaceTemplate($temp, $objectFields, $rows_arr)
{
    for ($i = 0; $i < count($objectFields); $i++) {
        
        $keys[$i]   = '[+' . $objectFields[$i] . '+]';
        $values[$i] = $rows_arr[$i];
        
    }
    $temp  = str_replace($keys, $values, $temp);
    $regex = '/\[\+.*?\+\]/';
    return preg_replace($regex, '', $temp);
    
    
}

/**
 * 
 * @param array with possible duplicates. Unsets each duplicate if finds and resets the indices of the array.
 * @return an associative array with the unique values as the indices' names and their content as the occurrence of how many times they were found in the array, during processing.
 */
function removeDupes($arrayWithDupes)
{
    for ($i = 0; $i < count($arrayWithDupes); $i++) {
        $numOfOccur = 1;
        for ($j = $i; $j < count($arrayWithDupes); $j++) {
            if ($arrayWithDupes[$i] == $arrayWithDupes[$j] and $j != $i) {
                
                unset($arrayWithDupes[$j]);
                $arrayWithDupes = array_values($arrayWithDupes);
                $numOfOccur++;
                $j--;
            }
            
            
        }
        $occure_for_value[$arrayWithDupes[$i]] = $numOfOccur;
        
        
    }
    return $occure_for_value;
}




?>


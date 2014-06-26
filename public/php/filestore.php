<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') 
    {
        // Sets $this->filename
    }

    /**
     * Returns array of lines in $this->filename
     */
    private function read_lines()
    {
        if (is_writable($filename)) 
        {
            $handle = fopen($filename, 'w');
            foreach($array as $items)
            {
                fwrite($handle, PHP_EOL . $items);
            }
            fclose($handle);
        }
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function write_lines($array)
    {
        $contents = [];
        if (is_readable($filename) && filesize($filename) > 0)
        {
            $handle = fopen($filename, 'r');
            $bytes = filesize($filename);
            $contents = trim(fread($handle, $bytes));
            fclose($handle);
            $contents = explode("\n", $contents);
            save_file($filename, $contents);
        }
        return $contents;
    }

    

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv()
    {
       
    }

    // /**
    //  * Writes contents of $array to csv $this->filename
    //  */
    function write_csv($array)
    {
   
    }
}

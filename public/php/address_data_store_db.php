<?
//some fixed values for our address book

require_once('php/filestore.php');


class AddressDataStore extends Filestore{

    //declare class attributes
    public $filename = '';
    // public $addresses_array = [];
    public $is_csv;

    //construct
    public function __construct($filename = 'address_book.csv') {
        $this->filename = $filename;
        if (substr($this->filename, -3) == 'csv') {
            $this->is_csv = TRUE;
        } else {
            $this->is_csv = FALSE;
        }
    }

    // read method that checks if the csv is readable, 
    // then calls private methods based on the extension.
    public function read() {
        if($this->is_csv == TRUE) {
            return $this->read_address_book();
        } else {
            return $this->read_lines();
        }
    }

    // write method that checks if the csv is writeable, 
    // then calls private methods based on the extension.
    public function write() {
        if($this->is_csv == TRUE) {
            $this->write_address_book();
        } else {
            $this->write_lines();
        }
    }

    //method to read from address book
    private function read_address_book() {
        //open the file for reading
        $read = fopen($this->filename, 'r');
        //while not at the end of file, add each contact to the array
        while(!feof($read)) {
            $contact = fgetcsv($read);
            //only if it is an array
            if(is_array($contact)) {
                $this->addresses_array[] = $contact;
            }
        }
        //close the handle
        fclose($read);
    }
    //method to write to address book
    private function write_address_book() {
        //open the file for writing
        $write = fopen($this->filename, 'w');
        //write contact to the file
        foreach ($this->addresses_array as $address) {
            fputcsv($write, $address);
        }
        //close the handle
        fclose($write);
    }
}

class filestoreDB {

public function dbConnect() {
    // Get new instance of PDO object
    $dbc = new PDO('mysql:host=127.0.0.1;dbname=address_book', 'daniel', 'letmein');

    // Tell PDO to throw exceptions on error
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

public function getOffset() {

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    return ($page - 1) * 10;
}

public function getList($dbc) {

    $page = $this->getOffset();

    $stmt = $dbc->prepare('SELECT n.name_id, n.first_name, n.last_name, a.address, a.city, a.state, a.zip 
        FROM names n
        JOIN addresses a 
        ON n.name_id = a.address_id LIMIT :LIMIT 
        OFFSET :OFFSET');

    $stmt->bindValue(':LIMIT', 10, PDO::PARAM_INT);
    $stmt->bindValue(':OFFSET', $page, PDO::PARAM_INT);
    $stmt->execute();
    $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $stmt;
}

}

?>
<?php


class FileUpload {
    
    public $tmp_file;
    public $target_file;
    public $upload_dir;
    
    public $image_fieldname;
    public $message;
    public $error;
    
    function __construct($tmp_file,$target_file,$upload_dir,$image_fieldname){
        $this->tmp_file = $tmp_file;
	$this->target_file = basename($target_file);
	$this->upload_dir = $upload_dir;
	$this->image_fieldname = $image_fieldname;
    }
    
    public $upload_errors = array(
	// http://www.php.net/manual/en/features.file-upload.errors.php
	UPLOAD_ERR_OK 				=> "No errors.",
	UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
        UPLOAD_ERR_NO_FILE 		=> "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
        );
    
    
    public function move_file() {
        
	// You will probably want to first use file_exists() to make sure
	// there isn't already a file by the same name.
	
	// move_uploaded_file will return false if $tmp_file is not a valid upload file 
	// or if it cannot be moved for any other reason
	if(move_uploaded_file($this->tmp_file, $this->upload_dir."/".$this->target_file)) {
		$this->message = "File uploaded successfully.";
		return $this->message;
	} else {
		$this->error = $_FILES[$this->image_fieldname]['error'];
		$this->message = $this->upload_errors[$this->error];
		return $this->message;
	}
    
    }
    
}


?>
<?php

    function validateDescription($description) {
        $description = trim($description);

        // Check if description is not empty
        if (empty($description)) {
            return "Description cannot be empty.";
        }
        // Check if description contains only English, Arabic text, numbers, and hyphens  
        // '/^[\p{L}\p{N}\p{Arabic}0-9\- ]+$/u'
        if (!preg_match('/^[\p{L}\p{N}\p{Arabic}0-9\!\-?\-؟.":,، ]+$/u', $description)) {
            return "Description can only contain English and Arabic letters, numbers, and hyphens.";
        }
        // Check if description length is within limits
        $minLength = 5; // Minimum length of description
        $maxLength = 10000; // Maximum length of description
        $descriptionLength = mb_strlen($description, 'UTF-8');
        if ($descriptionLength < $minLength || $descriptionLength > $maxLength) {
            return "Description must be between $minLength and $maxLength characters.";
        }
        // If description passes all validations, return true
        return true;
    }





    function validateTitle($title) {
        $title = trim($title);
        // Check if title is not empty
        if (empty($title)) {
            return "title cannot be empty.";
        }
        // Check if title contains only English, Arabic text, numbers, and hyphens
        if (!preg_match('/^[\p{L}\p{N}\p{Arabic}0-9\!\-?\-؟.":,، ]+$/u', $title)) {
            return "title can only contain English and Arabic letters, numbers, and hyphens.";
        }
        // Check if title length is within limits
        $minLength = 5; // Minimum length of title
        $maxLength = 10000; // Maximum length of title
        $titleLength = mb_strlen($title, 'UTF-8');
        if ($titleLength < $minLength || $titleLength > $maxLength) {
            return "title must be between $minLength and $maxLength characters.";
        }
        // If title passes all validations, return true
        return true;
    }







    //return only string
    function validateAndUploadImage($file) {
        //for error message
        $array = array();
        // Check if the file was uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
    
            // Check if the file is an image
            if (exif_imagetype($file_tmp) !== false) {
                //  5 MB
                if ($file['size'] <= 5 * 1024 * 1024) {
                    // Process the file further (e.g., move it to a permanent location)
                    $upload_dir = 'uploads/';
                    $un = uniqid().$file['name'];
                    $upload_path = $upload_dir . $un;
                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        return $un;
                    } else {
                        $array[] =  'Error: Failed to move the uploaded file.';
                        
                    }
                } else {
                    $array[] = 'Error: File size exceeds the limit.';
                    
                }
            } else {
                $array[] = 'Error: File is not an image.';
                
            }
        } else {
            $array[] = 'Error: ' . $file['error'];
            
        }

        if(!empty($array)){
            return $array;
        }
    }



    function validateInt($id){
        if(filter_var($id,FILTER_VALIDATE_INT)){
            return true;
        }else{
            return false;
        }
    }


    
?>
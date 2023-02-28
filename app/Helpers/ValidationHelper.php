<?php namespace App\Helpers;

class ValidationHelper {
    
    public static function displayErrors($validation) {
        if ($validation->getNumErrors() === 0) {
            return '';
        }
        
        $errors = '<div class="alert alert-danger"><ul>';
        foreach ($validation->getErrors() as $error) {
            $errors .= '<li>' . $error . '</li>';
        }
        $errors .= '</ul></div>';
        
        return $errors;
    }
    
}
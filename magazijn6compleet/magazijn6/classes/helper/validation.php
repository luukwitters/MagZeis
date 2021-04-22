<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 19-4-2021
 * Time: 19:35
 */

class Validation {

    /**
     * Checking if a string is valid by checking it length and if its empty
     *
     * @param $input string The input string
     *
     * @param $minLength int The minimal length of the string
     *
     * @param $maxLength int The maximal length of the string
     *
     * @return bool If the string is valid
     */
    public function validateString ($input, $minLength, $maxLength) {
        // Checking if one of the validation functions return false
        if ($this->validateEmpty($input) && $this->validateLength($input, $minLength, $maxLength)) {
            // All validations passed
            return true;
        } else {
            // 1 or more validations failed
            return false;
        }
    }

    /**
     * Checking if a int is valid by checking it length and if its empty
     *
     * @param $input int The input int
     *
     * @param $minLength int The minimal length of the int
     *
     * @param $maxLength int The maximal length of the int
     *
     * @return bool If the int is valid
     */
    public function validateInt ($input, $minLength, $maxLength) : bool {
        // Checking if one of the validation functions return false
        if ($this->validateEmpty($input) && $this->validateLength($input, $minLength, $maxLength)) {
            // All validations passed
            return true;
        } else {
            // 1 or more validations failed
            return false;
        }
    }

    /**Checking if a email is valid
     *
     * @param $email string the email
     *
     * @return bool if the email is valid
     */
    public function validateEmail ($email) : bool {
        // Checking mail is correct and between the required lengths
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $this->validateLength($email, 5, 100)) {
            // All validation failed
            return true;
        } else {
            // One or more validations failed
            return false;
        }
    }

    /**
     * Validate input by checking if it is empty
     *
     * @param $input mixed the input of the other functions
     *
     * @return bool if the input is empty
     */
    private function validateEmpty ($input) : bool {
        if ($input == '' || $input = null) {
            // Input is empty
            return false;
        } else {
            // Input is filled
            return true;
        }
    }

    /**
     * Checking the length of the input
     *
     * @param $input mixed the input of the other function
     *
     * @param $minLength int the minimal length of the input
     *
     * @param $maxLength int the maximal length of the input
     *
     * @return bool if the input is within the set range of characters
     */
    private function validateLength ($input, $minLength, $maxLength) : bool {
        if (strlen($input) < $minLength || strlen($input) > $maxLength) {
            // Input is not between the min and max length
            return false;
        } else {
            // Input is between the min an max length
            return true;
        }
    }
}
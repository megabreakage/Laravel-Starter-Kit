<?php

use App\Jobs\SendSMS;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Generates Unique UUID
 * @return string
 */
function generate_identifier(): string
{
    return Str::uuid()->toString();
}

/**
 * Generate Initials from a string
 * @return string
 */
function generate_initials($string): string
{
    // Explode the string by space
    $words = explode(' ', $string);

    // Initialize an empty string for the result
    $result = '';

    // Loop through each word
    foreach ($words as $word) {
        // Get the first character of each word and make it uppercase
        $result .= strtoupper(substr($word, 0, 1));
    }

    return $result;
}

/**
 * Process an Array with strings and returns the two letters per string.
 * @param $string
 * @return array
 */
function processStrings(array $strings): array 
{
    $newArray = [];

    foreach ($strings as $string) {
        $words = explode(' ', $string);
        $firstCharacters = '';

        if (count($words) === 1) {
            // If the string has only one word, get the first two characters
            $firstCharacters = strtoupper(substr($string, 0, 2));
        } elseif (count($words) === 2) {
            // If the string has two words, get the first character of each word
            foreach ($words as $word) { 
                $firstCharacters .= strtoupper(substr($word, 0, 1));
            }
        }

        // Add the concatenated characters to the new array
        $newArray[] = ['name'=> $string, 'shortCode' => $firstCharacters];
    }

    return $newArray;
}

/**
 * Generates OTPs
 * @return string $OTP
 */

function generate_otp(): string
{
    $OTP = "000000";
    if (env('APP_ENV') == "production") $OTP = (string) rand(100000, 999999);

    return $OTP;
}

/**
 * Resets user passwords
 * @param string $email
 * @return bool
 */

function reset_passwords($email): bool
{
    $user = User::where("email", $email)->first();
    $user->password = Hash::make("secretpassword");
    if ($user->save()){
        Log::info("User PASSWORD-RESET >> Success. ID: ".$user->id);
        return true;
    }

    Log::info("User PASSWORD-RESET >> Failed. ID: ".$user->id);
    return false;
}

/**
 * Gets the name of a controller
 * @param string $string
 * @return string
 */

function getControllerName($string)
{
    $pices = explode('\\', $string);
    $pices1 = explode('@', end($pices));
    $controller_name = current($pices1);
    return ucfirst(str_replace('Controller', '', $controller_name));
}

/**
 * Gets the difference between two dates
 * @param string $start_date
 * @param string $end_date
 * @param bool $inclusive
 * @return int @days 
 */

function get_date_difference($start_date, $end_date, $inclusive = false): int
{
    $earlier = new DateTime(date('Y-m-d', strtotime($start_date)));
    $later = new DateTime(date('Y-m-d', strtotime($end_date)));
    $days = $later->diff($earlier)->format("%a");

    return ($inclusive) ? ++$days : $days;
}

/**
 * Formats Phone number to a user friendly format_phone_number
 * @param string $phoneNumber
 * @return $phoneNumber
 */
function format_phone_number($phoneNumber): int
{
    if (strlen($phoneNumber) > 12 and strpos($phoneNumber, 'dup') !== false){
        $phoneNumber = substr($phoneNumber, 0, 12);
    }
    if (strlen($phoneNumber) == 9) $phoneNumber = str_pad($phoneNumber, 10, "0", STR_PAD_LEFT);
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 9);
        $areaCode = substr($phoneNumber, -9, 3);
        $nextThree = substr($phoneNumber, -6, 3);
        $lastFour = substr($phoneNumber, -3, 3);

        $phoneNumber = '+' . $countryCode . ' ' . $areaCode . ' ' . $nextThree . ' ' . $lastFour;
    } else if (strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 1);
        $nextThree = substr($phoneNumber, 1, 3);
        $lastFour = substr($phoneNumber, 4, 3);
        $lastFive = substr($phoneNumber, 7, 3);

        $phoneNumber = $areaCode . $nextThree . ' ' . $lastFour . ' ' . $lastFive;
    } else if (strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree . '-' . $lastFour;
    }
    return $phoneNumber;
}

/**
 * Removes unwanted words and letters from user search words
 * @param string $searchKeyWords
 * @return string $keywords
 */
function clean_search($searchKeyWords): string
{
    $raw_string = $searchKeyWords;
    $omit_words = array('a', 'an', 'the', 'on', 'for', 'in', 'this', 'that', 'to', 'from', 'and', 'or');
    $keywords = array_filter(explode(" ", str_replace(array(";", ",", "!", ":", "[", "]", ")", "(", ".", "'", "'", "%", "^"), "", $raw_string)));
    $keywords = array_diff($keywords, $omit_words);

    return $keywords;
}

/**
 * Converts bytes to 'KB', 'MB', 'GB', 'TB'
 * @param int $bytes
 * @param int $precision
 * @return string
 */
function formatBytes(int $bytes, int $precision = 2): string
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    //     $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}

/**
 * @param string $phone_number, 
 * @param string $message 
 * @return void
 */

function send_sms($phone_number, $message): void
{
    SendSMS::dispatch($phone_number, $message, NULL, NULL);
}


/**
 * Check if string matches md5 password format
 * @param string $md5
 * @return bool
 */
function check_md5_passwords(string $md5 =''): bool
{
    return preg_match('/^[a-f0-9]{32}$/', $md5);
}

/**
 * Hide middle characters in a phone number
 *
 * @param string $number
 * @return string
 */
function mask_phone_number($number): string
{
    $middle_string ="";
    $length = strlen($number);
    if( $length < 3 ){
        return $length == 1 ? "*" : "*". substr($number,  - 1);
    }
    else{
        $part_size = floor( $length / 3 ) ;
        $middle_part_size = $length - ( $part_size * 2 );
        for( $i=0; $i < $middle_part_size ; $i ++ ){
            $middle_string .= "*";
        }
        return  substr($number, 0, $part_size ) . $middle_string  . substr($number,  - $part_size );
    }
}

/**
 * Hide characters in an email
 *
 * @param string $email
 * @return string
 */
function mask_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
}

/**
 * Generate greetings based on time
 * @return string
 */

function greetings(): string
{

    if(date("H") < 12){

      return "Good Morning";

    } elseif(date("H") > 11 && date("H") < 18){

      return "Good Afternoon";

    } elseif(date("H") > 17){

      return "Good Evening";

    }

 }
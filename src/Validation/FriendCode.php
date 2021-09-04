<?php

namespace SeedCloud\Validation;

class FriendCode
{
    private static function CalculateChecksum($principalId)
    {
        return floor(intval(substr(sha1(pack('V', $principalId)), 0, 2), 16) / 2);
    }

    /*private static function IsInValidPrincipalRange($principal)
    {
        return ($principal > 130543475 && $principal <= 149643182) ||
            ($principal >= 1798000000 && $principal <= 1875939608);
    }*/
    public static function IsProbablyCopied($friendCode) {
        if(in_array($friendCode, array(
            '113541082053', // valid
            '281029350533', // RANDAL
            '190853507948', // ASP  
            '504323700474', // BLECK
            '044826694144', // STHETIX          
            '242389963248', // P3NCE            
            '285283849153', // P3NCE            
            '435668835763', // P3NCE            
            '345470646642', // BLAINE LOCKLAIR  
            '139284223032', //  BLAINE LOCKLAIR 
            '332569869337', // NINTENDOBREW     
            '422783820021', // KELONIO 3DS      
            '238097183111', // LOPEZ TUTORIALES 
            '109249029780', // LOPEZ TUTORIALES 
            '517271779247', // LOPEZ TUTORIALES 
            '220920415112', // LOPEZ TUTORIALES 
            '384125672247', // THEWIZWIKI       
            '143609644804', // THEWIZWIKI       
            '354064119835', // THEWIZWIKI       
            '547304741531', // DARKFELIN         
            '233801992881' // LINK GAMEPLAY     
        ), true))
        {
            return true;
        }
        return false;
    }
    public static function IsValid($friendCode)
    {
        $friendCode = preg_replace("/[^0-9]/", "", $friendCode);
        if (strlen($friendCode) > 12) {
            return false;
        }
        //Friendcode as 64bit little endian raw
        $rawFriendcodePayload = pack("P", intval($friendCode));
        list($principalId, $checksum) = array_values(unpack("V2", $rawFriendcodePayload));

        return self::CalculateChecksum($principalId) == $checksum;
    }
}

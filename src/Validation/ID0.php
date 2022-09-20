<?php

namespace SeedCloud\Validation;

class ID0
{
    public static function IsValid($id0)
    {
        //This checks if it could be an id1, if it is an id1 its very likely that the user copied the wrong foldername
        return preg_match('/^(?![0-9a-fA-F]{4}(01|00)[0-9a-fA-F]{18}00[0-9a-fA-F]{6})[0-9a-fA-F]{32}$/', $id0);
    }
    public static function IsExample($id0) {
        if(in_array($id0, array(
            '6bbcf7ddf638801fc90a4d2955da6efd'     
        ), true))
        {
            return true;
        }
        return false;
    }
}

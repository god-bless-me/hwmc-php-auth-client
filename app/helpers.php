<?php

function api_abort($code,$message)
{
    throw new \App\Exceptions\ApiException($code,$message);
}
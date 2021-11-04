<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('total'))
{
function total($table,$where=null)
{
    $ci=& get_instance();
    $total=$ci->m->total($table,$where);
    return $total;

}


}


if (!function_exists('countItems'))
{

    function countItems($table,$where=null)
    {
        $ci=& get_instance();
        $r=$ci->m->countItems($table,$where);
        return $r;

    }


}

if (!function_exists('countItemsByDate'))
{

    function countItemsByDate($table,$where=null,$date=null)
    {
        $ci=& get_instance();
        $r=$ci->m->countItemsByDate($table,$where,$date);
        return $r;

    }


}

if (!function_exists('countItemsByDatenStatus'))
{

    function countItemsByDatenStatus($table,$where=null,$date=null,$statuscheck=null)
    {
        $ci=& get_instance();
        $r=$ci->m->countItemsByDatenStatus($table,$where,$date,$statuscheck);
        return $r;

    }


}

if (!function_exists('countItemsByStatus'))
{

    function countItemsByStatus($table,$where=null,$statuscheck=null)
    {
        $ci=& get_instance();
        $r=$ci->m->countItemsByStatus($table,$where,$statuscheck);
        return $r;

    }


}


if (!function_exists('array_column'))
{

    function array_column($array, $key) {
        $column = array();
        foreach($array as $origKey => $value) {
            if (isset($value[$key])) {
                $column[$origKey] = $value[$key];
            }            
        }
        return $column;
    }
    

}


if (!function_exists('userData'))
{

    function userData()
    {
        $userSession=@$this->session->userdata('userSession');
        $ci=& get_instance();
        $data['userFavoriteStores']=$ci->m->getAllJoins('stores','customers_favorite_stores','storeId','fk_store_id',null,null,null,['storeStatus'=>1,'fk_customer_id'=>$userSession['userId']],null,null,'storeId','DESC');
        $data['userSavedCoupons']=$ci->m->getAllJoins('coupons','customers_saved_coupons','couponId','fk_coupon_id',null,null,null,['couponStatus'=>1,'fk_customer_id'=>$userSession['userId']],null,null,'couponId','DESC');
        return $data;

    }


}

if (!function_exists('sumItems'))
{

    function sumItems($table,$field,$where=null)
    {
        $ci=& get_instance();
        $r=$ci->m->sumItems($table,$field,$where);
        return $r;

    }


}
if (!function_exists('getFields'))
{

    function getFields($table,$fields,$where,$single=null)
    {
        $ci=& get_instance();
        return $ci->m->getFields($table,$fields,$where,$single);

    }


}
if (!function_exists('getIp'))
{

    function getIp()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;

    }


}



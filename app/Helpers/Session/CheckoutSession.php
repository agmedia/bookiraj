<?php

namespace App\Helpers\Session;

class CheckoutSession
{

    /**
     * @var string
     */
    private static $session_string = 'checkout';

    /*******************************************************************************
    *                                Copyright : AGmedia                           *
    *                              email: filip@agmedia.hr                         *
    *******************************************************************************/

    /**
     * SHIPPING ADDRESS DATA
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getAddress()
    {
        return session(static::$session_string . '.address');
    }


    /**
     * @return bool
     */
    public static function hasAddress()
    {
        return session()->has(static::$session_string . '.address');
    }


    /**
     * @param array $value
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function setAddress(array $value)
    {
        return session([static::$session_string . '.address' => $value]);
    }

    /*******************************************************************************
    *                                Copyright : AGmedia                           *
    *                              email: filip@agmedia.hr                         *
    *******************************************************************************/

    /**
     * SHIPPING
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getShipping()
    {
        return session(static::$session_string . '.shipping');
    }


    /**
     * @return bool
     */
    public static function hasShipping()
    {
        return session()->has(static::$session_string . '.shipping');
    }


    /**
     * @param array|string $value
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function setShipping($value)
    {
        return session([static::$session_string . '.shipping' => $value]);
    }

    /*******************************************************************************
    *                                Copyright : AGmedia                           *
    *                              email: filip@agmedia.hr                         *
    *******************************************************************************/

    /**
     * PAYMENT
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getPayment()
    {
        return session(static::$session_string . '.payment');
    }


    /**
     * @return bool
     */
    public static function hasPayment()
    {
        return session()->has(static::$session_string . '.payment');
    }


    /**
     * @param array|string $value
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function setPayment($value)
    {
        return session([static::$session_string . '.payment' => $value]);
    }

    /*******************************************************************************
     *                                Copyright : AGmedia                           *
     *                              email: filip@agmedia.hr                         *
     *******************************************************************************/

    /**
     * STEPS
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getStep()
    {
        return session(static::$session_string . '.step');
    }


    /**
     * @return bool
     */
    public static function hasStep()
    {
        return session()->has(static::$session_string . '.step');
    }


    /**
     * @param array|string $value
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function setStep($value)
    {
        return session([static::$session_string . '.step' => $value]);
    }
}
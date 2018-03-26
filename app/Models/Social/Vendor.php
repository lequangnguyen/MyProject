<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Vendor extends Model
{
    protected $connection = 'social';
    protected $table = 'vendor';
    public $timestamps = false;

    protected $fillable = [
        'gln_code', 'internal_code', 'name',
        'address', 'phone', 'email', 'website',
        'country','other','verification','prefix'

    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function setNameAttribute($value)
    {
        $data = [
            'content' => $value,
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request(
                'POST',
                config('remote.server') . '/encrypt',
                [
                    'form_params' => $data,
                ]
            );
            $res = $res->getBody();
        } catch (RequestException $e) {
            $res = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            $res = $e->getMessage();
        }

        $this->attributes['name'] = $res;
    }

    public function getNameAttribute($value)
    {
        $data = [
            'content' => $value,
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request(
                'POST',
                'http://localhost:1337/decrypt',
                [
                    'form_params' => $data,
                ]
            );
            $res = $res->getBody();
        } catch (RequestException $e) {
            $res = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            $res = $e->getMessage();
        }

        return $res;
    }

    public function setAddressAttribute($value)
    {
        $data = [
            'content' => $value,
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request(
                'POST',
                config('remote.server') . '/encrypt',
                [
                    'form_params' => $data,
                ]
            );
            $res = $res->getBody();
        } catch (RequestException $e) {
            $res = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            $res = $e->getMessage();
        }

        $this->attributes['address'] = $res;
    }

    public function getAddressAttribute($value)
    {
        $data = [
            'content' => $value,
        ];

        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request(
                'POST',
                'http://localhost:1337/decrypt',
                [
                    'form_params' => $data,
                ]
            );
            $res = $res->getBody();
        } catch (RequestException $e) {
            $res = $e->getResponse()->getBody();
        } catch (\Exception $e) {
            $res = $e->getMessage();
        }

        return $res;
    }


}

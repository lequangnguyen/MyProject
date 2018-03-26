<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Agency extends Model
{
    protected $connection = 'social';

    protected $table = 'agency';
    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'name', 'address', 'logo',
        'status', 'phone','site', 'email','location','other'

    ];

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

    /**
     * Get all of the tags for the post.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'agency_product', 'agency_id', 'product_id');
    }


}

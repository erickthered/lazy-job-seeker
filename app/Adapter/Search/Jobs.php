<?php

namespace App\Adapter\Search;

use App\Interfaces\Search\Request\AdapterInterface;
use Illuminate\Http\Request;

class Jobs implements AdapterInterface
{
    /**
     * Adapted Request
     *
     * @var array
     */
    protected $array = [];

    /**
     * Request that needs to be adapted
     *
     * @var Illuminate\Http\Request
     */
    protected $request = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->array = $this->init();
    }

    public static function adapt(Request $request)
    {
        $adapter = new Jobs($request);
        $adapter->parseJobType();
        $adapter->parseRemote();
        $adapter->parseSkills();

        return $adapter->array;
    }

    protected function parseJobType()
    {
        if ($this->request->type) {
            array_push($this->array['and'], [
                'type' => [
                    'code' => $this->request->type
                ]
            ]);
        }
    }

    protected function parseRemote()
    {
        if ($this->request->remote) {
            array_push($this->array['and'], [
                'remote' => [
                    'term' => true
                ]
            ]);
        }
    }

    protected function parseSkills()
    {
        if ($this->request->skills) {
            foreach ($this->request->skills as $skill) {
                array_push($this->array['and'], [
                    'skill' => [
                        'term' => $skill,
                        'experience' => 'potential-to-develop'
                    ]
                ]);
            }
        }
    }

    protected function init()
    {
        return [
            'and' => [
                [
                    'status' => [
                        'code' => 'open'
                    ]
                ]
            ]
        ];
    }
}

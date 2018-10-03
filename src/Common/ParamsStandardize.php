<?php

namespace NFePHP\eSocial\Common;

/**
 * Class of standardization of the data structure according to the scheme.
 * This is necessary to guarantee the recovery of all possible fields by
 * the constructor even if there is no data
 *
 * @category  library
 * @package   NFePHP\eSocial
 * @copyright NFePHP Copyright (c) 2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-esocial for the canonical source repository
 */

use stdClass;

class ParamsStandardize
{
    /**
     * @var stdClass
     */
    protected $schema;
    /**
     * @var array
     */
    protected $keys;

    /**
     * Constructor
     * @param \stdClass $schema
     */
    public function __construct(\stdClass $schema)
    {
        $this->schema = $schema;
        $this->keys = $this->getKeys($schema);
    }

    /**
     * Read all primary keys fields from data
     * @param  \stdClass $schema
     * @return array
     */
    protected function getKeys(\stdClass $schema)
    {
        return array_keys(
            (array) $this->get(
                $schema,
                'properties',
                new \stdClass()
            )
        );
    }

    /**
     * Recover primary fields
     * @param  \stdClass $obj
     * @param  string $prop
     * @param  \stdClass $default
     * @return \stdClass
     */
    protected function get(\stdClass $obj, $prop, \stdClass $default = null)
    {
        return isset($obj->{$prop}) ? $obj->{$prop} : $default;
    }

    /**
     * Read all fields from data and put in standard structure
     * @param  \stdClass $data
     * @return \stdClass
     */
    public function stdData(\stdClass $data)
    {
        $clone = new \stdClass();
        $this->getProperties($this->schema, $data, $clone, $this->keys, '');
        return $clone;
    }

    /**
     * Build standard structure from schema and load data fields, if exists
     * @param \stdClass $schema
     * @param \stdClass $data
     * @param \stdClass $clone
     * @param array $keys
     * @param string $ref
     */
    protected function getProperties(
        \stdClass $schema,
        \stdClass $data,
        \stdClass &$clone,
        $keys,
        $ref = ''
    ) {
        if ($schema->type == 'object') {
            $required = true;
            if (isset($schema->required)) {
                $required = $schema->required;
            }
            $exist = true;
            foreach ($schema->properties as $name => $prop) {
                if (in_array($name, $keys)) {
                    $ref = '';
                }
                if ($prop->type == 'object') {
                    if (!empty($ref)) {
                        $ref .= ":$name";
                    } else {
                        $ref = $name;
                    }
                    $this->getProperties($prop, $data, $clone, $keys, $ref);
                } else {
                    $comm = "\$clone->";
                    $orig = "\$data->";
                    if (!empty($ref)) {
                        $part = explode(':', $ref);
                        $num  = count($part);
                        foreach ($part as $p) {
                            $comm .= "$p->";
                            $orig .= "$p->";
                        }
                        $exist = false;
                        $test  = "\$exist = (!empty(".substr($orig, 0, strlen($orig) - 2).")) ? true : false;";
                        eval($test);
                    }
                    $orig .= $name;
                    $resp = null;
                    eval("\$resp = $orig;");
                    if (!empty($resp) || $resp === 0) {
                        $comm .= $name.'= $resp';
                    } else {
                        $comm .= "$name = null";
                    }
                    if ($required || $exist) {
                        eval("$comm;");
                    }
                }
            }
        }
    }
}

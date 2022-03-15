<?php

namespace MailQ\Entities;

use Nette\SmartObject;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Nette\Utils\Strings;

class BaseEntity {

    use SmartObject;

    const INVERT_NAMES = true;
    /**
     * @var ArrayHash
     */
    private $attributeNames;

    /**
     * Create new entity from array or string which is JSON
     * @param string|array $data
     * @param bool $inverse
     * @throws \Nette\Utils\JsonException
     */
    public function __construct($data = null, $inverse = false)
    {
        if (!is_null($data)) {
            if (is_string($data)) {
                $data = Json::decode($data);
            }
            $this->initMapping($inverse ? 'out' : 'in');
            foreach ($data as $key => $value) {
                if ($value instanceof \stdClass) {
                    $value = (array) $value;
                }
                $reflection = new \ReflectionClass($this);
                if ($this->attributeNames->offsetExists($key)) {
                    $propertyName = $this->attributeNames->offsetGet($key);
                    if ($reflection->hasProperty($propertyName)) {
                        $property = $reflection->getProperty($propertyName);
                        $type = $this->getValueFromAnnotation($property, 'var');
                        if (Strings::endsWith($type, 'Entity') || Strings::endsWith($type, 'Entity[]')) {
                            $className = Strings::replace($type, '~\\[\\]~i');
                            $classWithNamespace = sprintf("\\%s\\%s", $reflection->getNamespaceName(), $className);
                            if (is_array($value) && $this->hasAnnotation($property, 'collection')) {
                                $arrayData = [];
                                foreach ($value as $valueData) {
                                    $arrayData[] = new $classWithNamespace($valueData, $inverse);
                                }
                                $this->$propertyName = $arrayData;
                            } else {
                                $this->$propertyName = new $classWithNamespace($value);
                            }
                        } else {
                            $this->$propertyName = $value;
                        }
                    }
                }
            }
        }
    }

    /**
     * Creates ArrayHash where key is in annotation name
     * and value is property name
     * It is used to find property name by in annotation value
     * @param $mapping
     */
    private function initMapping($mapping) {
        $this->attributeNames = new ArrayHash();
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            if ($this->hasAnnotation($property, $mapping)) {
                $annotation = $this->getValueFromAnnotation($property, $mapping);
                if (!empty($annotation)) {
                    $this->attributeNames[$annotation] = $property->getName();
                } else {
                    $this->attributeNames[$property->getName()] = $property->getName();
                }
            }
        }
    }

    public function toArray($inverse = false) {
        $data = [];
        $mapping = $inverse ? 'in' : 'out';
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();
        foreach ($properties as $key => $property) {
            if ($this->hasAnnotation($property, $mapping)) {
                $propertyName = $property->getName();
                $annotation = $this->getValueFromAnnotation($property, $mapping);
                if (!empty($annotation)) {
                    $outputName = $annotation;
                } else {
                    $outputName = $property->getName();
                }
                $value = $this->$propertyName;
                if (is_array($value) && $this->hasAnnotation($property, 'collection')) {
                    $array = [];
                    foreach ($value as $item) {
                        if ($item instanceof BaseEntity) {
                            $array[] = $item->toArray($inverse);
                        }
                    }
                    $data[$outputName] = $array;
                } else if ($value instanceof BaseEntity) {
                    $data[$outputName] = $value->toArray($inverse);
                } else if ($value !== NULL) {
                    $data[$outputName] = $value;
                }
            }
        }
        if (count($data) == 0) {
            return (object) $data;
        } else {
            return $data;
        }
    }

    protected function hasAnnotation(\ReflectionProperty $property, string $annotation): bool
    {
        $docs = $property->getDocComment();

        $value = preg_match("/@$annotation/", $docs);

        return !!$value;
    }

    protected function getValueFromAnnotation(\ReflectionProperty $property, string $annotation): ?string
    {
        $docs = $property->getDocComment();

        if (!$this->hasAnnotation($property, $annotation)) {
            return null;
        }

        $pattern = "/@$annotation?(\s+)?([a-z|A-Z|\[|\]]+)/";

        $matches = Strings::match($docs, $pattern);

        $value = array_shift($matches);

        $value = str_replace("@$annotation", "", $value);

        return trim($value);
    }
}

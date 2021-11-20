<?php

namespace App\Service;

/**
 * Class Xml
 * @package App\Service
 */
final class Xml
{
    /**
     * @var ?\SimpleXMLElement
     */
    private $xml;

    /**
     * Receive the path of the XML and create the XML object.
     *
     * @return void
     */
    public function __construct(string $xmlPath)
    {
        $this->xml = $this->readXml($xmlPath);
    }

    /**
     * Receive path of XML and read it generating a SimpleXMLElement object.
     * In case of problem, it throws error.
     *
     * @return \SimpleXMLElement
     */
    private function readXml(string $xmlPath): \SimpleXMLElement
    {
        if (!is_file($xmlPath)) {
            throw new \Exception("File '{$xmlPath}' not found", 100);
        } elseif (!in_array(mime_content_type($xmlPath), ['application/xml', 'text/plain'])) {
            throw new \Exception("File must be XML", 100);
        }

        try {
            $simpleXmlObj = simplexml_load_string(file_get_contents($xmlPath));
            if (is_object($simpleXmlObj)) {
                return $simpleXmlObj;
            } else {
                throw new \Exception("Not possible to read the file '{$xmlPath}'", 100);
            }
        } catch (\Exception $e) {
            throw new \Exception('Oops... Something went wrong. Probably an invalid file!', 10);
        }
    }

    /**
     * Read item per item of the XML generating an array which the key is uniqueID
     * and the content is the property type.
     *
     * @return array
     */
    public function getArray(): array
    {
        $realStateProperties = [];
        foreach($this->xml as $propertyType => $xmlItem) {
            if (isset($xmlItem->uniqueID)) {
                $realStateProperties[(string)$xmlItem->uniqueID] = $propertyType;
            } else {
                throw new \Exception('Invalid XML pattern, uniqueID not found in at least one item', 10);
            }
        }

        return $realStateProperties;
    }
}

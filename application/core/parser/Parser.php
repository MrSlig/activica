<?php

namespace Activica\YMLParser;

use Activica\YMLParser\Exception\YMLException;
use Activica\YMLParser\Factory\Factory;

class Parser
{
    protected $xmlReader;
    protected $factory;

    private $path = [];

    public function __construct(Factory $factory = null)
    {
        if (null == $factory) {
            $factory = new Factory();
        }

        $this->xmlReader = new \XMLReader();
        $this->factory = $factory;
    }

    public function parse($file)
    {
        $this->path = [];

        $this->xmlReader->open($file);
        $result = $this->read();
        $this->xmlReader->close();

        return $result;
    }

    protected function read()
    {
        $xml = $this->xmlReader;
        $shopXML = '';
        if (!$this->moveToShop()) {
            throw new YMLException('Invalid YML file');
        }

        if (!$this->stepIn()) {
            throw new YMLException('Invalid YML file');
        }

        $storage = new Storage();

        do {
            if ('yml_catalog/shop/offers' == $this->getPath()) {
                if ($this->stepIn()) {
                    do {
                        $storage->addOfferXML($xml->readOuterXml());
                    } while ($this->moveToNextSibling());
                }
            } else {
                $shopXML .= $xml->readOuterXml();
            }
        } while ($this->moveToNextSibling());

        $shopXML = '<shop>' . $shopXML . '</shop>';

        $storage->setShopXML($shopXML);

        return new Builder($this->factory, $storage);
    }



    private function moveToShop()
    {
        $xml = $this->xmlReader;

        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::END_ELEMENT) {
                array_pop($this->path);
                continue;
            }


            if ($xml->nodeType !== \XMLReader::ELEMENT || $xml->isEmptyElement) {
                continue;
            }

            array_push($this->path, $xml->name);

            if ('yml_catalog/shop' === $this->getPath()) {
                return true;
            }
        }

        return false;
    }

    private function getPath()
    {
        return implode('/', $this->path);
    }

    private function stepIn()
    {
        $xml = $this->xmlReader;
        if ($xml->isEmptyElement) {
            return false;
        }
        while ($xml->read()) {
            if (\XMLReader::ELEMENT == $xml->nodeType) {
                array_push($this->path, $xml->name);
                return true;
            }
            if (\XMLReader::END_ELEMENT == $xml->nodeType) {
                array_pop($this->path);
                return false;
            }
        }
        return false;
    }

    private function moveToNextSibling()
    {
        $xml = $this->xmlReader;
        array_pop($this->path);
        while ($xml->next()) {
            if (\XMLReader::ELEMENT == $xml->nodeType) {
                array_push($this->path, $xml->name);
                return true;
            }

            if (\XMLReader::END_ELEMENT == $xml->nodeType) {
                return false;
            }
        }
        return false;
    }
}

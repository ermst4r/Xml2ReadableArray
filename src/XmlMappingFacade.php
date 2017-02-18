<?php
/**
 *  This file is part of Ermmedia.nl
 *
 *     Dfbuilder is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     Ermmedia is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with Ermmedia.  If not, see <http://www.gnu.org/licenses/>
 */

namespace ermst4r;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;

class XmlMappingFacade {

    protected $stream;
    protected $parser;
    protected $streamer;
    protected $root_node;

    /**
     * @return mixed
     */
    public function getRootNode()
    {
        return $this->root_node;
    }

    /**
     * @param mixed $root_node
     */
    public function setRootNode($root_node)
    {
        $this->root_node = $root_node;
    }


    /**
     * Construct the files
     * XmlFacade constructor.
     * @param $file_name
     */
    public function __construct($file_name)
    {
        $this->stream = new Stream\File($file_name, 1024);
        $this->parser = new Parser\StringWalker();
        $this->streamer = new XmlStringStreamer($this->parser, $this->stream);
    }


    /**
     * Show us the xml mapping
     * @return array
     */
    public function showXmlMapping()
    {
        $xml_mapping = $this->getXmlRow();
        $root_node = $this->getRootNode();
        $get_leafs = Xml2Array::leafs($xml_mapping,$root_node);
        return $get_leafs;
    }


    /**
     * Stream the xml row line by line
     * @return mixed
     */
    public function getXmlRow($page= 0)
    {
        $xmlArray = null;
        $root_node = '';
        $counter = 0 ;
        while ($node = $this->streamer->getNode()) {
            $lf = $this->loadSimpleXmlString($node);
            $root_node = $lf->getName();
            $xmlArray = Xml2Array::parse($lf);
            $counter ++;

            if($counter == $page && $page > 0) {
                break;
            }
        }
        $this->setRootNode($root_node);

        return $xmlArray[$root_node];

    }

    /**
     * @return mixed
     */
    public function getStream()
    {
        return $this->stream;
    }


    /**
     * @param $node
     * @return \SimpleXMLElement
     */

    protected function loadSimpleXmlString($node)
    {
        return  simplexml_load_string(utf8_encode($node));
    }




    /**
     * @return mixed
     */
    public function getParser()
    {
        return $this->parser;
    }



    /**
     * @return mixed
     */
    public function getStreamer()
    {
        return $this->streamer;
    }




}
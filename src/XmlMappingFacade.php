<?php



namespace XmlMappingFacade;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream;
use Prewk\XmlStringStreamer\Parser;

class XmlMappingFacade {

    private $stream;
    private $parser;
    private $streamer;
    private $root_node;

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
    public function getXmlRow()
    {
        $xmlArray = null;
        $root_node = '';
        while ($node = $this->streamer->getNode()) {
            $lf = simplexml_load_string(utf8_encode($node));
            $root_node = $lf->getName();
            $xmlArray = Xml2Array::parse($lf);
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
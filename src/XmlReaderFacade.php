<?php
namespace ermst4r;

class XmlReaderFacade extends XmlMappingFacade
{
    /**
     * XmlReaderFacade constructor.
     * @param $file_name
     */
    public function __construct($file_name)
    {
        parent::__construct($file_name);
    }


    /**
     * @param $mapping
     * @return array
     */
    public function mappingToTransformableArray($mapping)
    {
        $mapping_to_array = explode('.',$mapping);
        $returnArray = [];
        if(count($mapping_to_array) >0 ) {
            foreach(array_values($mapping_to_array) as $per_value) {
                $returnArray[] = $per_value;
            }

        }
        return array_values($returnArray);



    }


    /**
     * When we parse the xml node, we stream it.
     * @return bool|string
     */
    public function streamingNode()
    {
        return $this->streamer->getNode();
    }






    /**
     * Convert an xml array to values what is useful :-)
     * @param $plain_mapped
     * @param $xml_data
     * @return array
     */
    public function XmlArrayToValuesFacade($plain_mapped,$xml_data)
    {

        $xml_data = Xml2Array::parse($this->loadSimpleXmlString($xml_data));
        $save = [];
        foreach($plain_mapped as $plain_mapped_key => $plain_mapped_value) {
            $mapping = self::mappingToTransformableArray($plain_mapped_key);
            $tmp_xml_data = $xml_data;

            foreach($mapping as $m) {
                // double check if no errs
                if(!isset($tmp_xml_data[$m])) {
                    continue;
                }
                $tmp_xml_data = $tmp_xml_data[$m];
            }
            // don't show us array values, only workable values
            // change to  $save[key($plain_mapped_value)] = $tmp_xml_data; if you want to use arrays
            if(!is_array($tmp_xml_data)) {
                $save[key($plain_mapped_value)] = $tmp_xml_data;
            }
        }

        return $save;
    }





}
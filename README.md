# Xml2ReadableArray
Convert xml to an array string (node1.node2.node3), so you can retrieve them via an multidimensional array by splitting the string.

**Usage**

Lets say you want to parse an xml file without worrying about parsing. You can use this facade convert the following xml string to a array string

`<root>
    <node> </node>
     <node1> </node1>
      <node2 id="1337"> </node2>
       </root>`
       
       
The string above will be converted to:

1.root.node

2.root.node1

3.root.node2

4.root.node.id

Later in your project you can call the elements via an array notation






Example

Open the xml file
1. $XmlFacade = new XmlMappingFacade('xml_file');
2. Lets convert it to an string (root.node etc.) print_r($XmlFacade->showXmlMapping());


                
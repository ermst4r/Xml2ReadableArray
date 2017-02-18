# Parse XML files the easy way :)
Convert xml to an array string and parse the nodes without any effort.

**Real life scenario**

You have an xml file, but you don't want to write a parser for every xml file. What can you do? Install this package :)



**Example**


We want to parse this XML file.

```xml
<?xml version="1.0" encoding="utf-8"?>
<root>
    <items>


    <node>I am</node>
    <node1>a</node1>
    <node2 id="1337">1337 h4xor</node2>
    </items>
</root>
```
       
  
       

       
**1. Open the xml file**
```php
$n = new \Ermst4r\Xml\XmlReaderFacade('feed.xml');
```


**2. Show the mapping for this xml file**

We can now view the xml nodes in string format. If you run this code:

```php
print_r($n->showXmlMapping());
```
We see something like this:

```php
Array ( [0] => items.node [1] => items.node1 [2] => items.node2 [3] => items.node2.id )
```

**3. Parsing** 

Now if we loop through the xml nodes, we can parse the items. Lets say i  only want  node2 and the id of node2... We simply pass an array of the array node names. See example below.

PS. Remember, we can get the items from the showXmlMapping() method ;-)...

```php
while($node = $n->streamingNode()) {

    var_dump($n->XmlArrayToValuesFacade(['items.node2','items.node2.id'],$node));
    
}
```

And voila we get the value of the xml. (only items which are !is_array() will be parsed)

Of if you want to parse all the items you can do this:

```php
while($node = $n->streamingNode()) {

    var_dump($n->XmlArrayToValuesFacade($n->showXmlMapping(),$node));
    
}
```



**4. Advanced** 

We can even parse complicated xml files with nested nodes and attributes.. The principle stays the same like step 1,2,3.




**Credits** 

I hope this package can help you with parsing xml files. This package is also used in my opensource project http://www.dfbuilder.com 
Dfbuilder is a opensource tool what export files to different formats. 

With love...

Erwin Nandpersad

http://www.ermmedia.nl
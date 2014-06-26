<?php

use \Rockit\Event;

class XMLExport {

    public static function events($from, $to) {
        $filename = "events.xml";
        $xEvents = new SimpleXMLElement('<events></events>');

        $events = Event::whereNotNull("published_at")->where('start_date_hour', '>=', $from)->where('start_date_hour', '<=', $to)->orderBy('start_date_hour')->get();
        foreach($events as $event)
        
        /*
         * <events>
         *      <event id="">
         *          <eventtype>
         *          <date>
         *          <doors>
         *          <artist id="" is_support="" order="">
         *              <name>
         *              <genre>
         *              <short_des>
         *              <complete_des>
         *              <lineup>Composition direct
         *              <link>
         *              <link>
         *              <tickets>Composition direct
         * 
         *          <artist id="" is_support="" order="">
         *          <prix> 
         *          <representant id="">
         *      
         *          
         *          
         *
         */
        
        $penny = $xml->addChild('penny');
        $penny->addChild('one', 'Hello');
        
        
        
        
        
        
        //// Prepare clean document to download and download
        
        // Create a new DOMDocument object to save in readable format
        $doc = new DOMDocument('1.0', 'UTF-8');
        // add spaces, new lines and make the XML more readable format
        $doc->formatOutput = true;
        // Get a DOMElement object from a SimpleXMLElement object
        $domnode = dom_import_simplexml($xml);
        $domnode->preserveWhiteSpace = false;
        // Import node into current document
        $domnode = $doc->importNode($domnode, true);
        // Add new child at the end of the children
        $domnode = $doc->appendChild($domnode);
        // Dump the internal XML tree back into a string
        $saveXml = $doc->saveXML();
        
        // Set header to output data
        header('HTTP/1.1 200 OK');
        header("Pragma: no-cache");
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Content-type', 'text/xml');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo $saveXml;
        
//        
//        
//        
//        $header = [
//            'Content-Type' => 'application/xml',
//            'Content-Disposition' => 'attachment;Filename=events.xml',
//        ];
//        $xml->asXML("testxml.xml");
//        return Response::make($xml->asXML(), 200, $header);
    }

}

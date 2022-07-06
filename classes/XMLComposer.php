<?php

class XMLComposer
{
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    private function iterate(&$arr, $xml)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                xmlwriter_start_element($xml, $key);
                $this->iterate($value, $xml);
                xmlwriter_end_element($xml);
            } else {
                xmlwriter_start_element($xml, $key);
                xmlwriter_text($xml, $value);
                xmlwriter_end_element($xml);
            }
        }
    }

    public function compose()
    {
        $result = xmlwriter_open_memory();
        xmlwriter_set_indent($result, 1);
        xmlwriter_set_indent_string($result, '    ');
        xmlwriter_start_document($result, '1.0', 'UTF-8');

        $this->iterate($this->input, $result);

        return xmlwriter_output_memory($result);
    }
}
<?php

namespace JPC\Configuration\Core;

use Symfony\Component\Yaml\Yaml as YamlParser;
use JPC\Configuration\Core\AbstractConfiguration;

class Yaml extends AbstractConfiguration {

    function __construct($yamlFilePath, $firstConfigLevel = null) {
        if (is_file($yamlFilePath)) {
            $yaml = YamlParser::parse(file_get_contents($yamlFilePath));
        } else {
            trigger_error("Unable to load the YAML config : $yamlFilePath is not a file...", E_ERROR);
            return;
        }

        if (isset($firstConfigLevel) && isset($yaml[$firstConfigLevel])) {
            $this->config = $yaml[$firstConfigLevel];
        } else if(isset($firstConfigLevel) && !isset($yaml[$firstConfigLevel])){
            trigger_error("Unable to set the first config level to '$firstConfigLevel' because it not exisit in '$yamlFilePath'", E_NOTICE);
        } else {
            $this->config = $yaml;
        }
    }
}

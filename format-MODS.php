<?php

// purpose:
// - load each MODS file
// - remove excess whitespace
// - remove empty elements
//
// run:
// php /path/to/format-MODS.php /path/to/source/directory

// check for directory arguments and set variables
if (isset($argv[1])) {
  if (file_exists($argv[1])) {
    $path_source = rtrim($argv[1], DIRECTORY_SEPARATOR);
  }
  else {
    exit("\n🚫  \e[1;91mSTOP!\e[0m The supplied source directory does not exist.\n\n");
  }
}
else {
  exit("\n🚫  \e[1;91mSTOP!\e[0m The source directory must be supplied.\nExample: php /path/to/format-MODS.php /path/to/source/directory\n\n");
}

// create destination directory
if (!is_dir(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'MODS_formatted')) {
  if (!mkdir(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'MODS_formatted', 0777, TRUE)) {
    exit("\n🚫  \e[1;91mSTOP!\e[0m Failed to create " . __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'MODS_formatted' . " directory.\n\n");
  }
}

// see: http://php.net/manual/en/class.directoryiterator.php
$dirItem = new DirectoryIterator($path_source);
foreach ($dirItem as $fileInfo) {
  if ((!$fileInfo->isDot()) && ($fileInfo->getExtension() == 'xml')) {

    echo $fileInfo->getFilename() . "\n";

    $doc = new DOMDocument;
    $doc->preserveWhiteSpace = false;
    $doc->load($fileInfo->getPathname());

    $xpath = new DOMXPath($doc);

    foreach($xpath->query('//*[not(normalize-space())]') as $node) {
      $node->parentNode->removeChild($node);
    }

    $doc->formatOutput = true;
    $doc->save($path_destination . DIRECTORY_SEPARATOR . $fileInfo->getFilename());

  }
}

<?php

$json = json_decode(file_get_contents('index.json'), true);

function getValue($tree, $path) {
    $pathArray = explode('.', $path);
    $property = array_shift($pathArray);

    if (count($pathArray) === 0) {
        return $tree[$property];
    }
    return getValue($tree[$property], implode('.', $pathArray));
}

echo getValue($json, 'root.property.subproperty.subsubproperty.mich');

?>
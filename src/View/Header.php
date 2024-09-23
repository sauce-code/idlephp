<?php

namespace Idle\View;

use DiDom\Element;

class Header extends AbstractElementBuilder
{

    public function create(array $values, string $page): Element
    {
        $header = new Element("header");

        $table = new Element("table");
        $table->setAttribute("id", "res");

        $tr = new Element("tr");

        $th = new Element("th");
        $th->setValue($this->names["resources"]["resource"]);
        $tr->appendChild($th);

        $th = new Element("th");
        $th->setValue($this->names["resources"]["value"]);
        $tr->appendChild($th);

        $th = new Element("th");
        $th->setValue($this->names["resources"]["income"]);
        $tr->appendChild($th);

        $table->appendChild($tr);

        $resources = array("lumber", "stone");
        foreach ($resources as $resource) {
            $tr = new Element("tr");

            $th = new Element("th");
            $th->setValue($this->names["resources"][$resource]);
            $tr->appendChild($th);

            $th = new Element("th");
            $th->setValue($values["res"][$resource]);
            $th->setAttribute("id", "value-" .$resource);
            $tr->appendChild($th);

            $th = new Element("th");
            $th->setValue($values["income"][$resource]);
            $th->setAttribute("id", "income-" . $resource);
            $tr->appendChild($th);

            $table->appendChild($tr);
        }

        $header->appendChild($table);
        return $header;
    }
}

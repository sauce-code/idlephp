<?php

namespace Idle\View;

use DiDom\Element;

class Main extends AbstractElementBuilder
{

    public function create(array $values, string $page): Element
    {
        return match ($page) {
            "overview" => $this->overview(),
            "buildings" => $this->buildings($values)
        };
    }

    private function overview(): Element
    {
        $main = new Element("main");
        $element = new Element("div", "main-overview");
        $element->setAttribute("id", "main-overview");
        $main->appendChild($element);
        return $main;
    }

    private function buildings(array $values): Element
    {
        $main = new Element("main");

        $table = new Element("table");
        $table->setAttribute("id", "buildings");

        $th = new Element("tr");
        $th->setAttribute("class", "building");

        $name = new Element("th", $this->names["elements"]["name"]);
        $name->setAttribute("class", "building-name");
        $th->appendChild($name);

        $level = new Element("th", $this->names["elements"]["level"]);
        $level->setAttribute("class", "building-level");
        $th->appendChild($level);

        $cost = new Element("th", $this->names["elements"]["cost"]);
        $cost->setAttribute("class", "building-cost");
        $th->appendChild($cost);

        $up = new Element("th");
        $up->setAttribute("class", "building-up");
        $th->appendChild($up);

        $table->appendChild($th);

        $buildings = array("lumberjack", "stonemason");
        foreach ($buildings as $building) {
            $tr = new Element("tr");
            $tr->setAttribute("class", "building");

            $name = new Element("td", $this->names["buildings"][$building]);
            $name->setAttribute("class", "building-name");
            $tr->appendChild($name);

            $level = new Element("td", $values[$building]["level"]);
            $level->setAttribute("class", "building-level");
            $tr->appendChild($level);

            $cost = new Element("td", $values[$building]["cost"]["lumber"] . "L " .
                $values[$building]["cost"]["stone"] . "S");
            $cost->setAttribute("class", "building-cost");
            $tr->appendChild($cost);

            $td = new Element("td");
            $button = new Element("a", "upgrade");
            $button->setAttribute("class", "upgrade-button");
            $button->setAttribute("href", "?page=buildings&up=" . $building);
            $td->appendChild($button);
            $tr->appendChild($td);

            $table->appendChild($tr);
        }
        $main->appendChild($table);
        return $main;
    }
}

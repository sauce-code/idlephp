<?php

namespace Idle\View;

use DiDom\Document;
use DiDom\Element;
use Idle\Logic\Logic;

class View
{
    private readonly Logic $logic;

    private readonly array $names;

    public function __construct(Logic $logic, array $names)
    {
        $this->logic = $logic;
        $this->names = $names;
    }

    public function create(?string $page): string
    {
        if ($page == null) {
            $page = "overview";
        }

        $values = $this->logic->get();

        $doc = new Document("template.html", true);
        $doc->first("#res-value-lumber")->setValue($values["res"]["lumber"]);
        $doc->first("#res-value-stone")->setValue($values["res"]["stone"]);

        $main = $doc->first("main");
        $main->replace(match ($page) {
            "overview" => $this->overview(),
            "buildings" => $this->buildings($values)
        });
        return $doc->html();
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

        $div = new Element("div");
        $div->setAttribute("id", "building");

        $name = new Element("div", $this->names["elements"]["name"]);
        $name->setAttribute("id", "building-name");
        $div->appendChild($name);

        $level = new Element("div", $this->names["elements"]["level"]);
        $level->setAttribute("id", "building-level");
        $div->appendChild($level);

        $cost = new Element("div", $this->names["elements"]["cost"]);
        $cost->setAttribute("id", "building-cost");
        $div->appendChild($cost);

        $up = new Element("div");
        $up->setAttribute("id", "building-up");
        $div->appendChild($up);

        $main->appendChild($div);

        $buildings = array("lumberjack", "stonemason");
        foreach ($buildings as $building) {
            $div = new Element("div");
            $div->setAttribute("class", "building");

            $name = new Element("div", $this->names["buildings"][$building]);
            $name->setAttribute("class", "building-name");
            $div->appendChild($name);

            $level = new Element("div", $values[$building]["level"]);
            $level->setAttribute("class", "building-level");
            $div->appendChild($level);

            $cost = new Element("div", $values[$building]["cost"]["lumber"] . "L " .
                $values[$building]["cost"]["stone"] . "S");
            $cost->setAttribute("class", "building-cost");
            $div->appendChild($cost);

            $up = new Element("div");
            $up->setAttribute("id", "building-up");
            $button = new Element("a", "upgrade");
            $button->setAttribute("type", "nav-button");
            $button->setAttribute("href", "?page=buildings&up=" . $building);
            $up->appendChild($button);
            $div->appendChild($up);

            $main->appendChild($div);
        }
        return $main;
    }

}

<?php

namespace Idle\View;

use DOMDocument;
use DOMNode;
use Idle\Logic\Logic;
use InvalidArgumentException;

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

        $doc = new DOMDocument();
        $doc->loadHTMLFile("template.html");

        $doc->getElementById("res-value-lumber")->nodeValue = $values["res"]["lumber"];
        $doc->getElementById("res-value-stone")->nodeValue = $values["res"]["stone"];

        $main = $doc->getElementById("main");
        switch ($page) {
            case "overview":
                $child = $doc->createElement("div");
                $child->setAttribute("id", "main-overview");
                $child->nodeValue = "main-overview";
                $main->appendChild($child);
                break;
            case "buildings":
                $child = $doc->createElement("div");
                $child->setAttribute("id", "building");

                $name = $doc->createElement("div");
                $name->setAttribute("id", "building-name");
                $name->nodeValue = $this->names["elements"]["name"];
                $child->appendChild($name);

                $level = $doc->createElement("div");
                $level->setAttribute("id", "building-level");
                $level->nodeValue = $this->names["elements"]["level"];
                $child->appendChild($level);

                $cost = $doc->createElement("div");
                $cost->setAttribute("id", "building-cost");
                $cost->nodeValue = $this->names["elements"]["cost"];
                $child->appendChild($cost);

                $up = $doc->createElement("div");
                $up->setAttribute("id", "building-up");
                $child->appendChild($up);

                $main->appendChild($child);

                $buildings = array("lumberjack", "stonemason");
                foreach ($buildings as $building) {
                    $child = $doc->createElement("div");
                    $child->setAttribute("class", "building");

                    $name = $doc->createElement("div");
                    $name->setAttribute("class", "building-name");
                    $name->nodeValue = $this->names["buildings"][$building];
                    $child->appendChild($name);

                    $level = $doc->createElement("div");
                    $level->setAttribute("class", "building-level");
                    $level->nodeValue = $values[$building]["level"];
                    $child->appendChild($level);

                    $cost = $doc->createElement("div");
                    $cost->setAttribute("class", "building-cost");
                    $cost->nodeValue = $values[$building]["cost"]["lumber"] . "L " .
                        $values[$building]["cost"]["stone"] . "S";
                    $child->appendChild($cost);

                    $up = $doc->createElement("div");
                    $up->setAttribute("id", "building-up");
                    $button = $doc->createElement("a");
                    $button->setAttribute("type", "nav-button");
                    $button->setAttribute("href", "?page=buildings&up=" . $building);
                    $button->nodeValue = "upgrade";
                    $up->appendChild($button);
                    $child->appendChild($up);

                    $main->appendChild($child);
                }

                break;
            default:
                throw new InvalidArgumentException();
        }


        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        return $doc->saveHTML();
    }
}
